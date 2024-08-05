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

                        <div class="trending_wrap" id="trending-wrap">
                        </div>

                        {{-- <div class="trending_wrap">
                            <div class="search_icon">
                                <img src="{{ asset('images/search-icon.png') }}" alt="">
                            </div>
                            <span id="harryPotterSpan"><a href="">Harry Potter</a></span>
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
                        </div> --}}
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

            if (!token) {
                Swal.fire({
                    title: 'Login Required',
                    text: 'You need to login to perform this action.',
                    icon: 'warning',
                    confirmButtonText: 'Login',
                    showCancelButton: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/login';
                    }
                });
                return;
            }

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const token =
                'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3MjI1MDA4MTAsImV4cCI6MTc1NDAzNjgxMCwiYXVkIjoiVVNFUiIsImRhdGEiOnsidWlkIjoiNDgxIiwiZmlyc3ROYW1lIjoidGVzdGluZyIsImxhc3ROYW1lIjoidGVzdGluZzEiLCJlbWFpbElEIjoiZ2hhbmlza3luZXRAZ21haWwuY29tIiwibG9naW5UeXBlIjpudWxsLCJjYWxsRnJvbSI6IklPUyJ9fQ.Eyk07gjtsfaMPqf0z2B6erVJC7DjmUJMeW39suC8GFA'; // Replace with your actual token

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (token) {
                fetch('/api/fetch-trends', {
                        method: 'POST',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        const trendsWrap = document.getElementById('trending-wrap');

                        if (data.result && data.result.length > 0) {
                            trendsWrap.innerHTML = data.result.map(trend => `
                        <div class="trend_item">
                            <div class="search_icon">
                                <img src="{{ asset('images/search-icon.png') }}" alt="">
                            </div>
                            <span class="trend-item" data-query="${trend.catName}"><a href="#">${trend.catName}</a></span>
                            <div class="arrow">
                                <img src="{{ asset('images/arrow.png') }}" alt="">
                            </div>
                        </div>
                    `).join('');

                            document.querySelectorAll('.trend-item').forEach(span => {
                                span.addEventListener('click', function() {
                                    const query = this.getAttribute('data-query');
                                    document.getElementById('searchQueryInput').value = query;
                                    document.getElementById('indexForm').submit();
                                });
                            });
                        } else {
                            trendsWrap.innerHTML = '<p>No trends available.</p>';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                console.error('No token found.');
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let isPopupShown = false;

            function checkSession() {
                fetch('/api/check-session', {
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${localStorage.getItem('api_token')}`,
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.status === 401 && !isPopupShown) {

                            localStorage.removeItem('api_token');
                            localStorage.removeItem('firstName');

                            Swal.fire({
                                title: 'Session Expired',
                                text: 'Please log in again.',
                                icon: 'warning',
                                confirmButtonText: 'Login',
                                showCancelButton: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/login';
                                }
                            });

                            isPopupShown = true;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            setInterval(checkSession, 5000); // Check session every 5 seconds
        });
    </script>
@endsection
