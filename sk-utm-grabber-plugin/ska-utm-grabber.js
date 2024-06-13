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
                if (sudonimATag) sudonimATag.href = newUrl;
            } else {
                newUrl = newBaseUrl + storedQueryString;
                if (sudonimATag) sudonimATag.href = newUrl;
            }
        }

        // Update all links with the specified class
        const linkClass = utmGrabberData.linkClass;
        const links = document.querySelectorAll(`.${linkClass}`);
        if (!storedQueryString) return;
        links.forEach(link => {
            let newUrl = utmGrabberData.baseUrl;
            if (newUrl.includes('?')) {
                const modifiedQueryString = storedQueryString.replace('?', '&');
                newUrl += modifiedQueryString;
                link.href = newUrl;
            } else {
                newUrl += modifiedQueryString;
                link.href = newUrl;
            }
        });
    }

    processUrl();
});