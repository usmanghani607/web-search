@extends('layouts.index_frontend')

<style>
    .hidden {
        display: none;
    }
    /* #loadingIndicator {
        display: none;
    }
    .trending_wrap {
        display: none;
    } */
</style>

@section('content')
    <section class="index_wp">
        {{-- <div class="container-fluid">
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
        </div> --}}
        <div id="loginProfileContainer" class="container-fluid hidden">
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

                        {{-- <div id="trendingWrap" class="trending_wrap" style="display: none;">
                            <div class="search_icon">
                                <img src="{{ asset('images/search-icon.png') }}" alt="">
                            </div>
                            <span id="trendTitle">Harry Potter</span>
                            <div class="arrow">
                                <img src="{{ asset('images/arrow.png') }}" alt="">
                            </div>
                        </div>

                        <div id="loadingIndicator">
                            <p>Loading...</p>
                        </div> --}}



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

    <script>
        document.getElementById('chatIcon').addEventListener('click', function() {

        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var token = localStorage.getItem('api_token');
            var firstName = localStorage.getItem('firstName');

            if (token) {

                var loginProfileContainer = document.getElementById('loginProfileContainer');
                loginProfileContainer.classList.remove('hidden');

                if (firstName) {
                    $('.login_profile span').text('Hello ' + firstName);
                }
            }
        });

        function toggleDropdown() {
            var dropdown = document.getElementById("myDropdown");
            dropdown.classList.toggle("show");
        }

        function logout() {
            sessionStorage.clear();
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
        document.addEventListener('DOMContentLoaded', function() {
            const token = localStorage.getItem('api_token');
            console.log('Token:', token);

            if (!token) {
                console.error('Token not found in localStorage.');
                document.getElementById('loadingIndicator').textContent = 'Token not found. Cannot load trends.';
                return;
            }

            fetch('https://api-dev.therecz.com/api/post/get-trends.php', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({})
                })
                .then(response => {
                    console.log('Response:', response);
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.statusText}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data:', data);

                    if (data.success && data.result.length > 0) {
                        document.getElementById('loadingIndicator').style.display = 'none';

                        const trendingWrap = document.getElementById('trendingWrap');
                        trendingWrap.style.display = 'flex';

                        document.getElementById('trendTitle').textContent = data.result[0].title;
                    } else {
                        console.warn('No trends found or API response was not successful');
                        document.getElementById('loadingIndicator').textContent = 'No trends available.';
                    }
                })
                .catch(error => {
                    console.error('Error fetching trends:', error);
                    document.getElementById('loadingIndicator').textContent = 'Failed to load trends.';
                });
        });
    </script> --}}

    {{-- <script>
        var firstName = localStorage.getItem('firstName');
        if (firstName) {
            $('.login_profile span').text('Hello ' + firstName);
        }
    </script> --}}

    {{-- <script>
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
    </script> --}}
@endsection
