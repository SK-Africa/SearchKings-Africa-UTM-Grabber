<?php
// Check user capabilities
if ( ! current_user_can( 'manage_options' ) ) {
    return;
}

// Show error/update messages
settings_errors( 'utmGrabber_messages' );
?>
<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form action="options.php" method="post">
        <?php
        settings_fields( 'utmGrabber' );
        do_settings_sections( 'utmGrabber' );
        submit_button( 'Save Settings' );
        ?>
    </form>

    <hr>

    <h2>User Guide</h2>
    <div class="utm-grabber-guide">
        <h3>How to Use SearchKings Africa UTM Grabber</h3>
        
        <h4>1. WhatsApp Button</h4>
        <p>To add the WhatsApp button to your site:</p>
        <ul>
            <li>Set the "Show WhatsApp Icon" option to "Yes" above.</li>
            <li>Use the shortcode <code>[ska_utm_grabber_anchor]</code> in your posts, pages, or widgets where you want the button to appear.</li>
        </ul>

        <h4>2. Dynamic Link Updating</h4>
        <p>To automatically update links with UTM parameters:</p>
        <ul>
            <li>Add the class <code>sudonim-link</code> to any link you want to be dynamically updated.</li>
            <li>Example: <code>&lt;a href="https://example.com" class="sudonim-link"&gt;Click here&lt;/a&gt;</code></li>
        </ul>

        <h4>3. Form Field Population</h4>
        <p>The plugin automatically populates form fields with UTM data. Add these hidden fields to your forms:</p>
        <ul>
            <li><code>utm_source</code>, <code>utm_medium</code>, <code>utm_campaign</code>, <code>utm_term</code>, <code>utm_content</code></li>
            <li><code>device</code>, <code>keyword</code>, <code>network</code>, <code>placement</code>, <code>adposition</code></li>
            <li><code>gad_source</code>, <code>gclid</code>, <code>channel</code>, <code>source</code></li>
        </ul>
        <p>Example for a standard form:</p>
        <pre>
&lt;form&gt;
    &lt;input type="hidden" name="utm_source" value=""&gt;
    &lt;input type="hidden" name="utm_medium" value=""&gt;
    &lt;!-- Add other UTM fields similarly --&gt;
    &lt;input type="hidden" name="channel" value=""&gt;
    &lt;input type="hidden" name="source" value=""&gt;
&lt;/form&gt;
        </pre>
        <p>For Elementor forms, add hidden fields with the same names.</p>

        <h4>4. Traffic Source Detection</h4>
        <p>The plugin automatically detects and populates the following information:</p>
        <ul>
            <li><strong>Channel:</strong> Paid Search, Organic, Social, Email, or Other</li>
            <li><strong>Source:</strong> Google, Bing, Yahoo, or other sources as detected</li>
        </ul>
        <p>This information is added to the <code>channel</code> and <code>source</code> form fields when present.</p>
    </div>
</div>

<style>
    .utm-grabber-guide {
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .utm-grabber-guide h3 {
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }
    .utm-grabber-guide h4 {
        margin-top: 20px;
    }
    .utm-grabber-guide code {
        background: #f4f4f4;
        padding: 2px 5px;
        border-radius: 3px;
    }
    .utm-grabber-guide pre {
        background: #f4f4f4;
        padding: 10px;
        border-radius: 3px;
        overflow-x: auto;
    }
</style>
<?php