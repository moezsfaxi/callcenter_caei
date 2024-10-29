    // Wait for the DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Get the search input element
        const searchInput = document.getElementById('filteringbyname');
        
        // Add input event listener for real-time filtering
        searchInput.addEventListener('input', function(e) {
            // Get the search query and convert to lowercase for case-insensitive search
            const searchQuery = e.target.value.toLowerCase();
            
            // Get all table rows except the header
            const tableRows = document.querySelectorAll('tbody tr');
            
            // Loop through each row
            tableRows.forEach(row => {
                // Get the prospect name cell (first column)
                const prospectName = row.querySelector('td:first-child').textContent.toLowerCase();
                
                // Show/hide row based on whether the name contains the search query
                if (prospectName.includes(searchQuery)) {
                    row.style.display = '';  // Show the row
                } else {
                    row.style.display = 'none';  // Hide the row
                }
            });
        });
    });