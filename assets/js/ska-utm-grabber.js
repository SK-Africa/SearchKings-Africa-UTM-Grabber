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

  const storedParams = new URLSearchParams(sessionStorage.getItem('utmParams'));

  if (storedParams.toString()) {
    // Update sudonim-link if it exists
    updateSudonimLink(storedParams);

    // Update all links with the specified class
    updateClassLinks(storedParams);

    // Add UTM parameters to all forms
    addUtmToForms(storedParams);

    // Determine channel and source, and add to forms
    const channelInfo = determineChannelAndSource(storedParams);
    addChannelInfoToForms(channelInfo);
  } else {
    // If no stored params, set channel to Organic and source to Direct
    addChannelInfoToForms({ channel: 'Organic', source: 'Direct' });
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
      let input = form.querySelector(
        `input[name="form_fields[${param}]"], input[name="${param}"]`,
      );
      // Log to if UMT are being capture and Forms Fields are being
      // console.log('UTM Params:', params.toString());
      // console.log('Form Fields Found:', input ? 'Yes' : 'No');
      if (input) {
        input.value = params.get(param) || '';
      }
    });
  });
}

function determineChannelAndSource(params) {
  let channel = 'Organic';
  let source = 'Direct';

  // Check if there are any search params
  if (params.toString()) {
    // Check for utm_source
    const utmSource = params.get('utm_source');
    if (utmSource) {
      source = utmSource;

      // Determine channel based on utm_source
      if (utmSource.toLowerCase().includes('google')) {
        channel = 'Paid Search';
      } else if (utmSource.toLowerCase().includes('facebook')) {
        channel = 'Social';
      } else if (utmSource.toLowerCase().includes('email')) {
        channel = 'Email';
      } else {
        channel = 'Other';
      }
    }

    // Check for utm_medium
    const utmMedium = params.get('utm_medium');
    if (utmMedium) {
      if (
        utmMedium.toLowerCase().includes('cpc') ||
        utmMedium.toLowerCase().includes('ppc')
      ) {
        channel = 'Paid Search';
      } else if (utmMedium.toLowerCase().includes('social')) {
        channel = 'Social';
      } else if (utmMedium.toLowerCase().includes('email')) {
        channel = 'Email';
      }
    }

    // Check for gclid (Google Click ID)
    if (params.get('gclid')) {
      channel = 'Paid Search';
      source = source || 'Google';
    }

    // Check for utm_campaign
    const utmCampaign = params.get('utm_campaign');
    if (utmCampaign) {
      // You can add additional logic here if needed
    }

    // Check for utm_term
    const utmTerm = params.get('utm_term');
    if (utmTerm) {
      // You can add additional logic here if needed
    }

    // Check for utm_content
    const utmContent = params.get('utm_content');
    if (utmContent) {
      // You can add additional logic here if needed
    }
  }

  return { channel, source };
}

function addChannelInfoToForms(channelInfo) {
  const forms = document.querySelectorAll('form');
  forms.forEach((form) => {
    let channelInput = form.querySelector(
      'input[name="form_fields[channel]"], input[name="channel"]',
    );
    let sourceInput = form.querySelector(
      'input[name="form_fields[source]"], input[name="source"]',
    );

    if (channelInput) {
      channelInput.value = channelInfo.channel;
    }
    if (sourceInput) {
      sourceInput.value = channelInfo.source;
    }
  });
}

document.addEventListener('DOMContentLoaded', function () {
  const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      if (mutation.type === 'childList') {
        const forms = mutation.target.querySelectorAll('form');
        if (forms.length > 0) {
          processUrl();
        }
      }
    });
  });

  observer.observe(document.body, { childList: true, subtree: true });
});
