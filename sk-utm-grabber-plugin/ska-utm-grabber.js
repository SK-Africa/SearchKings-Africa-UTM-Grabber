document.addEventListener('DOMContentLoaded', function () {
    function processUrl() {
        const originalUrl = window.location.href;
        const originalUrlObject = new URL(originalUrl);
        const queryString = originalUrlObject.search;
  
        // Check if the URL contains UTM parameters
        if (queryString.includes('utm')) {
            // Store the UTM parameters in sessionStorage
            sessionStorage.setItem('utmParams', queryString);
        }
  
        // Retrieve the UTM parameters from sessionStorage
        const storedQueryString = sessionStorage.getItem('utmParams');
  
        if (storedQueryString) {
            // Get the anchor tag element by its ID
            const sudonimATag = document.getElementById('sudonim-link');
            const newBaseUrl = utmGrabberData.baseUrl;
  
            // Append UTM parameters to the new base URL
            let newUrl;
            if (newBaseUrl.includes('?')) {
                const modifiedQueryString = storedQueryString.replace('?', '&');
                newUrl = newBaseUrl + modifiedQueryString;
                sudonimATag.href = newUrl;
            } else {
                newUrl = newBaseUrl + storedQueryString;
                sudonimATag.href = newUrl;
            }
        }
    }
  
    processUrl();
  });