<?php
class SKA_UTM_Grabber_Updater {
    private $file;
    private $plugin;
    private $basename;
    private $active;
    private $username;
    private $repository;
    private $authorize_token;
    private $github_response;

    public function __construct($file) {
        $this->file = $file;
        add_action('admin_init', array($this, 'set_plugin_properties'));
        return $this;
    }

    public function set_plugin_properties() {
        $this->plugin = get_plugin_data($this->file);
        $this->basename = plugin_basename($this->file);
        $this->active = is_plugin_active($this->basename);
    }

    public function set_update_server($update_server_url) {
        $this->update_server_url = $update_server_url;
    }

    private function get_repository_info() {
        if (is_null($this->github_response)) {
            $request_uri = $this->update_server_url;
            $response = wp_remote_get($request_uri);

            if (is_wp_error($response)) {
                return false;
            }

            $this->github_response = json_decode(wp_remote_retrieve_body($response));
        }
        return $this->github_response;
    }

    public function initialize() {
        add_filter('pre_set_site_transient_update_plugins', array($this, 'modify_transient'), 10, 1);
        add_filter('plugins_api', array($this, 'plugin_popup'), 10, 3);
        add_filter('upgrader_post_install', array($this, 'after_install'), 10, 3);
    }

    public function modify_transient($transient) {
        if (property_exists($transient, 'checked')) {
            if ($checked = $transient->checked) {
                $this->get_repository_info();
                $out_of_date = version_compare($this->github_response->version, $checked[$this->basename], 'gt');
                if ($out_of_date) {
                    $new_files = $this->github_response->download_url;
                    $slug = current(explode('/', $this->basename));
                    $plugin = array(
                        'url' => $this->plugin["PluginURI"],
                        'slug' => $slug,
                        'package' => $new_files,
                        'new_version' => $this->github_response->version
                    );
                    $transient->response[$this->basename] = (object) $plugin;
                }
            }
        }
        return $transient;
    }

    public function plugin_popup($result, $action, $args) {
        if ($action !== 'plugin_information') {
            return false;
        }
        if (!empty($args->slug)) {
            if ($args->slug == current(explode('/' , $this->basename))) {
                $this->get_repository_info();
                $plugin = array(
                    'name'              => $this->plugin["Name"],
                    'slug'              => $this->basename,
                    'version'           => $this->github_response->version,
                    'author'            => $this->plugin["AuthorName"],
                    'author_profile'    => $this->plugin["AuthorURI"],
                    'last_updated'      => $this->github_response->last_updated,
                    'homepage'          => $this->plugin["PluginURI"],
                    'short_description' => $this->plugin["Description"],
                    'sections'          => array(
                        'Description'   => $this->plugin["Description"],
                        'Updates'       => $this->github_response->sections->changelog,
                    ),
                    'download_link'     => $this->github_response->download_url
                );
                return (object) $plugin;
            }
        }
        return $result;
    }

    public function after_install($response, $hook_extra, $result) {
        global $wp_filesystem;
        $install_directory = plugin_dir_path($this->file);
        $wp_filesystem->move($result['destination'], $install_directory);
        $result['destination'] = $install_directory;
        if ($this->active) {
            activate_plugin($this->basename);
        }
        return $result;
    }
}
