<div class="topheader">
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="col">
                        <div class="logo_left">
                            <a href="/"><img src="{{ asset('images/logo.png') }}" alt="logo"></a>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                        <div class="col">
                            <form id="indexForm" class="d-flex search-container" role="search">
                                @csrf
                                <input id="searchInput" class="form-control me-2" type="search" aria-label="Search">
                                <div class="search_icon">
                                    <img src="{{ asset('images/search-icon.png') }}" alt="">
                                </div>
                            </form>

                        </div>
                        <div class="col">
                            <div class="right_btn">
                                <button class="btn">Sign in</button>
                                <button class="btn_red">Sign Up</button>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<div class="header_filter">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="search_checkbox">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="all" value="all">
                        <label class="form-check-label" for="all">All</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="movies" value="movies">
                        <label class="form-check-label" for="movies">Movies</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="web_series" value="web_series">
                        <label class="form-check-label" for="web_series">Web series</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="books" value="books">
                        <label class="form-check-label" for="books">Books</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="rest form-check-input" type="checkbox" id="restaurants" value="restaurants">
                        <label class="form-check-label" for="restaurants">Restaurants</label>
                        <img src="{{ asset('images/icon.png') }}" alt="Star Icon" class="checkbox-image"
                            id="checkboxImage">
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="news" value="news">
                        <label class="form-check-label" for="news">News</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <section class="filter_list">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card shadow-0 border rounded-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="img_round">
                                    <a href="restaurants">
                                        <img src="{{ asset('images/movie1.png') }}" class="w-100" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <h5>Harry Potter: The Complete Collection (1-7)</h5>

                                <div class="mb-2 auther">
                                    <span>Auther - J.K. Rowling</span>
                                </div>
                                <div class="mb-2 text-gray">
                                    <span>Childern Fiction.</span>
                                    <span>1 Jan, 1993</span>
                                </div>
                                <div class="mb-3 text-gray">
                                    <span>The first Harry Potter book, Harry Potter and the Philosopher’s Stone, was
                                        published by Bloomsbury in 1997
                                        to immediate popular and critical acclaim. Six further best-selling books, three
                                        companion books,
                                        a playscript and two screenplays have since followed.</span>
                                </div>
                                <div class="text-starts">
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span style="color: #000000"><span class="start_bold">Ranga</span> and 327 <span
                                            class="start_bold">other</span> people Recz it!</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('restaurants');
        const image = document.getElementById('checkboxImage');

        checkbox.addEventListener('change', function() {
            if (this.checked) {
                image.style.display = 'inline';
            } else {
                image.style.display = 'none';
            }
        });
    });
</script> --}}

{{-- <script>
    document.addEventListener('DOMContentLoaded', () => {

        function getQueryParams() {
            const params = {};
            const queryString = window.location.search.substring(1);
            const regex = /([^&=]+)=([^&]*)/g;
            let m;
            while (m = regex.exec(queryString)) {
                params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
            }
            return params;
        }

        const params = getQueryParams();
        const searchQuery = params['search_query'];

        if (searchQuery) {
            document.getElementById('searchInput').value = searchQuery;
        }
    });
</script> --}}


{{-- <script>
    $(document).ready(function() {

        $('#searchInput').on('input', function() {
            var searchText = $(this).val().trim();

            if (searchText.length > 0) {

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var token = localStorage.getItem('api_token');

                $.ajax({
                    url: "{{ route('search-list-process') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken, // Include CSRF token in headers
                        'Authorization': 'Bearer ' + token
                    },
                    data: {
                        search_query: searchText
                    },
                    success: function(response) {

                        console.log(response);
                    },
                    error: function(xhr, status, error) {

                        console.error(error);
                    }
                });
            } else {
                console.log('Empty search input');
            }
        });
    });
</script> --}}
