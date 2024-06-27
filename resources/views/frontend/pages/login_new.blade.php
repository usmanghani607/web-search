@extends('layouts.index_frontend')
<?php
session_start();
?>
<style>

    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
        background-color: #FF385C !important;
        border: transparent !important;
        border-radius: 4px !important;
        padding: 8px 50px !important;
    }

    div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm:focus {
        box-shadow: 0 0 0 3px rgb(112 102 224 / 0%) !important;
    }

    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: none;
    }

    #loader {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 20px;
    }

</style>

@section('content')
    <section class="login_section">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col col-md-12">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5">
                                <div class="login_left">
                                    <div class="img_sec">
                                        <img src="{{ asset('/images/login_icon.png') }}" alt="">
                                    </div>
                                    <div class="login_text">
                                        <h2>Welcome back!</h2>
                                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-7">
                                <div class="card-body">
                                    <form id="loginForm">
                                        <div class="row">
                                            <div class="login_head mb-3 pb-1">
                                                <span>Log in</span>
                                            </div>
                                            <div class="account">
                                                <span class="">Don’t have an account?</span>
                                                <span class="sign_up"><a href="#!">Sign up</a></span>
                                            </div>

                                            <div class="email mb-4">
                                                <label class="form-label">Email*</label>
                                                <input type="email" id="emailID" name="emailID" class="form-control form-control-lg" placeholder="Enter your email">
                                                <span id="emailError" class="error_message"></span>
                                            </div>
                                            <div class="password">
                                                <label class="form-label">Password*</label>
                                                <input type="password" id="pass" name="pass" class="form-control form-control-lg" placeholder="Password*">
                                                <span id="passwordError" class="error_message"></span>
                                                <span class="forgot"><a href="#!">Forgot password?</a></span>
                                            </div>
                                            <div class="pt-1 mb-4">
                                                <button class="btn btn_login" type="button">Login</button>
                                            </div>
                                            <div class="line">
                                                <h1>Or</h1>
                                            </div>
                                            <div class="socail_login">
                                                <button class="google_btn"><img src="{{ asset('images/google.png') }}">Log in with Google</button>
                                                <button class="ios_btn"><img src="{{ asset('images/apple.png') }}">Log in with Apple</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="overlay">
        <div id="loader">Loading...</div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.btn_login').addEventListener('click', validateForm);

            function validateForm() {
                let isValid = true;

                let email = document.getElementById("emailID").value;
                let password = document.getElementById("pass").value;

                let emailError = document.getElementById("emailError");
                let passwordError = document.getElementById("passwordError");

                let emailField = document.getElementById("emailID");
                let passwordField = document.getElementById("pass");

                emailField.classList.remove("error_border");
                passwordField.classList.remove("error_border");
                emailError.innerHTML = "";
                passwordError.innerHTML = "";

                if (!validateEmail(email)) {
                    emailError.innerHTML = "Please enter a valid email address.";
                    emailField.classList.add("error_border");
                    isValid = false;
                }

                if (password.length < 6) {
                    passwordError.innerHTML = "Password must be at least 6 characters long.";
                    passwordField.classList.add("error_border");
                    isValid = false;
                }


                if (isValid) {
                    document.getElementById("loginForm").submit();
                }
            }

            function validateEmail(email) {
                const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                return re.test(String(email).toLowerCase());
            }
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.login_button').on('click', function(e) {
                e.preventDefault();

                $('#overlay').show();

                $.ajax({
                    url: "{{ route('process') }}",
                    type: "POST",
                    data: $('#loginForm').serialize(),
                    success: function(response) {

                        $('#overlay').hide();

                        if (response.success) {
                            window.location.href = response.redirect_url;
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Login Failed',
                                text: response.error,
                            });
                        }
                    },
                    error: function(xhr) {

                        $('#overlay').hide();

                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            text: xhr.responseJSON ? xhr.responseJSON.error :
                                'An error occurred',
                        });
                    }
                });
            });
        });
    </script>
@endsection
