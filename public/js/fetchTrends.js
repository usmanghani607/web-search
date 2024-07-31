
$(document).ready(function() {
    var apiToken = localStorage.getItem('api_token');

    // console.log('Retrieved token:', apiToken);

    if (!apiToken) {
        console.error('API token not found in localStorage.');
        return;
    }

    $.ajax({
        url: 'https://api-dev.therecz.com/api/post/get-trends.php',
        method: 'POST',
        headers: {
            'Authorization': 'Bearer ' + apiToken,
            'Content-Type': 'application/json'
        },
        crossDomain: true,
        success: function(response) {
            // console.log('API Response:', response);

            if (response.success) {
                var trends = response.result;
                var container = $('#trending-container');
                container.empty();

                trends.forEach(function(trend) {
                    var trendHtml = `
                        <div class="trending_item">
                            <div class="search_icon">
                                <img src="` + trend.socialImg + `" alt="Profile Image">
                            </div>
                            <span>` + trend.title + `</span>
                            <div class="arrow">
                                <img src="{{ asset('images/arrow.png') }}" alt="Arrow">
                            </div>
                        </div>
                    `;
                    container.append(trendHtml);
                });
            } else {
                console.error('Error fetching trends:', response.message);
            }
        },
        error: function(xhr) {
            console.error('Error fetching trends:', xhr.responseText);
        }
    });
});

