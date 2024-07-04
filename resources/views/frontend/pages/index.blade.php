@extends('layouts.index_frontend')

<style>
    .hidden {
    display: none;
}

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
