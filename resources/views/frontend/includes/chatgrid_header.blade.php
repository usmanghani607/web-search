<style>
@media only screen and (min-width: 320px) and (max-width: 767px) {
    /* .right_btn .btn { display: block; } */
    .topheader .navbar { padding: 0 10px; }
    .right_btn .btn { padding: 5px; font-size: 12px; }
    .right_btn .btn_red { padding: 5px; font-size: 12px; }
    }
    .hidden {
        display: none;
    }
    .dropdown-content.show {
        display: block;
    }
</style>

<div class="topheader">
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button> --}}
                    <div class="col">
                        <div class="logo_left">
                            <a href="/"><img src="{{ asset('images/logo.png') }}" alt="logo"></a>
                        </div>
                    </div>

                    <div class="col">
                        <div class="rec text-center">
                            {{-- <i class="fa-solid fa-question"></i> --}}
                            <img class="card-img-top" src="{{ asset('/images/question.png') }}">
                            <span>Ask Recz</span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="profile_btn">
                            <div class="right_btn">
                                <a href="/login" class="btn">Sign in</a>
                                <a href="#!" class="btn_red">Sign Up</a>
                            </div>
                        </div>
                    </div>
                    <div id="loginProfileContainer" class="hidden">
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
                </div>
            </nav>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var token = localStorage.getItem('api_token');
        var firstName = localStorage.getItem('firstName');

        if (token) {
            var profileBtn = document.querySelector('.profile_btn');
            profileBtn.style.display = 'none';

            var loginProfileContainer = document.getElementById('loginProfileContainer');
            loginProfileContainer.classList.remove('hidden');

            if (firstName) {
                document.querySelector('.login_profile span').textContent = 'Hello ' + firstName;
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
