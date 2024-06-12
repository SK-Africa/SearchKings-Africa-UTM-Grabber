document.addEventListener('DOMContentLoaded', function () {
  function processUrl() {
      // Check if the URL contains UTM parameters
      if (!window.location.href.includes('utm')) return;

      const originalUrl = window.location.href;
      const originalUrlObject = new URL(originalUrl);
      const queryString = originalUrlObject.search;

      // Get the anchor tag element by its ID
      const sudonimATag = document.getElementById('sudonim-link');
      const newBaseUrl = utmGrabberData.baseUrl;

      // Append UTM parameters to the new base URL
      let newUrl;
      if (newBaseUrl.includes('?')) {
          const modifiedQueryString = queryString.replace('?', '&');
          newUrl = newBaseUrl + modifiedQueryString;
          sudonimATag.href = newUrl;
      } else {
          newUrl = newBaseUrl + queryString;
          sudonimATag.href = newUrl;
      }
  }

  processUrl();
});