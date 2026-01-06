document.addEventListener('DOMContentLoaded', function () {
    // Shared function to load content
    window.loadAjaxContent = function (url) {
        const tableContainer = document.getElementById('table-container');
        if (!tableContainer) return;

        // Show loading state
        tableContainer.style.opacity = '0.5';
        tableContainer.style.pointerEvents = 'none';

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.text();
            })
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.getElementById('table-container');

                if (newContent) {
                    tableContainer.innerHTML = newContent.innerHTML;

                    // Re-init simple-datatables if used (Mazer template often uses it)
                    // But in this project, it seems we are using standard bootstrap tables 
                    // and some specific scripts for delete forms.

                    // If there are specific scripts needed after load, they should be handled here.
                }

                tableContainer.style.opacity = '1';
                tableContainer.style.pointerEvents = 'auto';

                window.history.pushState({ url: url }, '', url);
            })
            .catch(error => {
                console.error('Error loading content:', error);
                tableContainer.style.opacity = '1';
                tableContainer.style.pointerEvents = 'auto';
                // Fallback to full page reload if AJAX fails
                window.location.href = url;
            });
    };

    // Handle form submissions
    document.addEventListener('submit', function (e) {
        const form = e.target.closest('.ajax-form');
        if (form && form.method.toLowerCase() === 'get') {
            e.preventDefault();
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);
            const url = form.action.split('?')[0] + '?' + params.toString();
            window.loadAjaxContent(url);
        }
    });

    // Handle pagination links
    document.addEventListener('click', function (e) {
        const link = e.target.closest('#table-container .pagination a');
        if (link) {
            e.preventDefault();
            window.loadAjaxContent(link.href);
        }
    });

    // Handle auto-submit on change
    document.addEventListener('change', function (e) {
        const form = e.target.closest('.ajax-form');
        if (form && (e.target.tagName === 'SELECT' || e.target.type === 'checkbox' || e.target.type === 'radio')) {
            // Trigger submit event
            if (typeof form.requestSubmit === 'function') {
                form.requestSubmit();
            } else {
                form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
            }
        }
    });

    // Handle browser back/forward buttons
    window.addEventListener('popstate', function (e) {
        if (e.state && e.state.url) {
            window.loadAjaxContent(e.state.url);
        } else {
            window.loadAjaxContent(window.location.href);
        }
    });
});
