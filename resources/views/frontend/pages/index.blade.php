@extends('layouts.index_frontend')

@section('content')
    <section class="index_wp">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="login_profile">
                        <i class="fa-solid fa-user"></i>
                        <span>Hello</span>
                        <i onclick="toggleDropdown()" class="fa-solid fa-caret-down dropbtn"></i>
                        <div class="dropdown">
                            <div id="myDropdown" class="dropdown-content">
                              <a href="#" onclick="logout()">Logout</a>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="index_wrap">
                        <div class="logo_main text-center">
                            <img src="{{ asset('images/main_logo.png') }}" alt="">
                        </div>
                        <div class="search_wrap">
                            <form id="indexForm" action="/search-list" class="d-flex search-input" role="search"
                                method="GET">
                                <input id="searchQueryInput" class="form-control" name="search_query">
                                <div class="search_icon">
                                    {{-- <img onclick="$('#indexForm').submit()" src="{{ asset('images/search-icon.png') }}" alt=""> --}}
                                    <img onclick="document.getElementById('indexForm').submit()"
                                        src="{{ asset('images/search-icon.png') }}" alt="">
                                </div>
                            </form>
                        </div>
                        <div class="trend_heading">
                            <h4>Trending Search</h4>
                        </div>
                        <div class="trending_wrap">
                            <div class="search_icon">
                                <img src="{{ asset('images/search-icon.png') }}" alt="">
                            </div>
                            <span>Harry Potter</span>
                            <div class="arrow">
                                <img src="{{ asset('images/arrow.png') }}" alt="">
                            </div>
                        </div>
                        <div class="trending_wrap">
                            <div class="search_icon">
                                <img src="{{ asset('images/search-icon.png') }}" alt="">
                            </div>
                            <span>T20 World Cup</span>
                            <div class="arrow">
                                <img src="{{ asset('images/arrow.png') }}" alt="">
                            </div>
                        </div>
                        <div class="trending_wrap">
                            <div class="search_icon">
                                <img src="{{ asset('images/search-icon.png') }}" alt="">
                            </div>
                            <span>Live News</span>
                            <div class="arrow">
                                <img src="{{ asset('images/arrow.png') }}" alt="">
                            </div>
                        </div>
                        <div class="trending_wrap">
                            <div class="search_icon">
                                <img src="{{ asset('images/search-icon.png') }}" alt="">
                            </div>
                            <span>Race Movie</span>
                            <div class="arrow">
                                <img src="{{ asset('images/arrow.png') }}" alt="">
                            </div>
                        </div>
                        <div class="trending_wrap">
                            <div class="search_icon">
                                <img src="{{ asset('images/search-icon.png') }}" alt="">

                            </div>
                            <span>Homer Cafe and Bar</span>
                            <div class="arrow">
                                <img src="{{ asset('images/arrow.png') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="chat-icon" id="chatIcon">
                        <a href="chat"><img src="{{ asset('images/question.png') }}" alt=""></a>
                    </div>
                    <div class="icon-text">
                        <span>Ask Recz</span>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- <div id="overlay">
        <div id="loader">Loading...</div>
    </div> --}}

    <script>
        document.getElementById('chatIcon').addEventListener('click', function() {
            alert('Chat icon clicked!');
        });
    </script>

    <script>
        var firstName = localStorage.getItem('firstName');
        if (firstName) {
            $('.login_profile span').text('Hello ' + firstName);
        }
    </script>

    {{-- <script>
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script> --}}

    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById("myDropdown");
            dropdown.classList.toggle("show");
        }

        function logout() {

            sessionStorage.clear();

            // localStorage.removeItem('api_token');
            localStorage.clear();

            window.location.href = '/login';
        }

        window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdown = document.getElementById("myDropdown");
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        }
    }

    </script>


    {{-- <script>
        $(document).ready(function() {
            const $input = $('#indexForm input[name="search_query"]');

            $input.on('keydown', function(event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    performSearch();
                }
            });

            function performSearch() {
                const token = localStorage.getItem('api_token');

                $.ajax({
                    url: "{{ route('index-process') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    },
                    data: JSON.stringify({
                        search_query: $input.val()
                    }),
                    success: function(response) {
                        if (response.success) {
                            console.log('Search query successful. Redirecting...');
                            window.location.href = response.redirect_url;
                        } else {
                            console.error('Search query error:', response.errors.search_query);
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON ? xhr.responseJSON.errors : {
                            search_query: 'An error occurred'
                        };
                        console.error('Search query error:', errors.search_query);
                    }
                });
            }
        });
    </script> --}}

    {{-- <script>
        $(document).ready(function() {
            const $input = $('#indexForm input[name="search_query"]');

            $input.on('keydown', function(event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    performSearch();
                }
            });

            function performSearch() {
                const token = localStorage.getItem('api_token');

                $.ajax({
                    url: "{{ route('index-process') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    },
                    data: JSON.stringify({
                        search_query: $input.val()
                    }),
                    success: function(response) {
                        if (response.success) {
                            console.log('Search query successful. Updating content...');
                            updateResults(response.result);
                            window.location.href = response.redirect_url;

                        } else {
                            console.error('Search query error:', response.errors.search_query);
                        }
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON ? xhr.responseJSON.errors : {
                            search_query: 'An error occurred'
                        };
                        console.error('Search query error:', errors.search_query);
                    }
                });
            }

            function updateResults(results) {
                const $container = $('.filter_list .container .row');
                $container.empty();

                console.log('Results:', results); // test point
                // debugger;
                results.forEach(result => {
                    console.log('Processing result:', result);  // test point
                    // debugger;
                    const html = `
                <div class="col-md-12">
                    <div class="card shadow-0 border rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="img_round">
                                        <img src="${result.img}" class="w-100" />
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <h5>${result.catName}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                    $container.append(html);
                });
            }
        });
    </script> --}}
@endsection
