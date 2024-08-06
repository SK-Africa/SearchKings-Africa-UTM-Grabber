document.addEventListener('DOMContentLoaded', function () {
  function processUrl() {
    const urlParams = new URLSearchParams(window.location.search);
    const utmParams = utmGrabberData.utmParams;
    let hasUtmParams = false;

    // Check if any UTM parameter exists in the URL
    utmParams.forEach((param) => {
      if (urlParams.has(param)) {
        hasUtmParams = true;
      }
    });

    if (hasUtmParams) {
      // Store UTM parameters in sessionStorage
      sessionStorage.setItem('utmParams', window.location.search);
    }

    const storedParams = new URLSearchParams(
      sessionStorage.getItem('utmParams'),
    );

    if (storedParams.toString()) {
      // Update sudonim-link if it exists
      updateSudonimLink(storedParams);

      // Update all links with the specified class
      updateClassLinks(storedParams);

      // Add UTM parameters to all forms
      addUtmToForms(storedParams);
    }
  }

  function updateSudonimLink(params) {
    const sudonimATag = document.getElementById('sudonim-link');
    if (sudonimATag) {
      const newBaseUrl = utmGrabberData.baseUrl;
      let newUrl = new URL(newBaseUrl);
      params.forEach((value, key) => {
        newUrl.searchParams.append(key, value);
      });
      sudonimATag.href = newUrl.toString();
    }
  }

  function updateClassLinks(params) {
    const linkClass = utmGrabberData.linkClass;
    const links = document.querySelectorAll(`.${linkClass}`);
    links.forEach((link) => {
      let newUrl = new URL(link.href);
      params.forEach((value, key) => {
        newUrl.searchParams.append(key, value);
      });
      link.href = newUrl.toString();
    });
  }

  function addUtmToForms(params) {
    const forms = document.querySelectorAll('form');
    forms.forEach((form) => {
      utmGrabberData.utmParams.forEach((param) => {
        let input = form.querySelector(`input[name="${param}"]`);
        if (input) {
          input.value = params.get(param) || '';
        }
      });
    });
  }

  processUrl();
});