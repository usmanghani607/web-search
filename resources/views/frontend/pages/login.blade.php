@extends('layouts.index_frontend')
<?php
session_start();
?>
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
                                        <p>We've missed you! Log back in to discover great recommendations from your trusted
                                            people.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-7">
                                <div class="card-body">
                                    <form id="loginForm">
                                        @csrf
                                        <div class="row">
                                            <div class="login_head mb-3 pb-1">
                                                <span>Log in</span>
                                            </div>
                                            <div class="account">
                                                <span class="">Don’t have an account?</span>
                                                <span class="sign_up"><a href="" data-bs-toggle="modal"
                                                        data-bs-target="#loginModal">Sign up</a></span>
                                            </div>

                                            <div class="email mb-4">
                                                <label class="form-label">Email*</label>
                                                <input type="email" id="emailId" name="emailId"
                                                    class="form-control form-control-lg" placeholder="Enter your email">
                                                <span id="emailError" class="error_message"></span>
                                            </div>
                                            <div class="password">
                                                <label class="form-label">Password*</label>
                                                <input type="password" id="pass" name="pass"
                                                    class="form-control form-control-lg" placeholder="Password*">
                                                <span id="passwordError" class="error_message"></span>
                                                <span class="forgot"><a href="#!">Forgot password?</a></span>
                                            </div>
                                            <div class="pt-1 mb-4">
                                                <button type="button" class="btn btn_login login_button">Login</button>
                                            </div>
                                            <div class="line">
                                                <h1>Or</h1>
                                            </div>
                                            <div class="socail_login">
                                                <button type="button" class="google_btn"><img
                                                        src="{{ asset('images/google.png') }}">Log in with Google</button>
                                                <button type="button" class="ios_btn"><img
                                                        src="{{ asset('images/apple.png') }}">Log in with Apple</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="close" style="height: 0">
                                    <div data-bs-dismiss="modal" aria-label="Close">
                                        <img class="cross-icon" src="{{ asset('images/cross.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <img class="lady" src="{{ asset('images/lady.png') }}" alt="">
                                    <div class="col-md-8">
                                        <h3>Scan to Download App</h3>
                                        <img class="scan" src="{{ asset('images/scan.png') }}" alt="">
                                        <p>Available on</p>
                                        <img class="applestore" src="{{ asset('images/apple-play.png') }}" alt="">
                                        <img class="googlestore" src="{{ asset('images/google-play.png') }}" alt="">
                                    </div>
                                    <div class="col-md-4"></div>
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

    {{-- <script>
        $(document).ready(function() {
            $('.login_button').on('click', function(e) {
                e.preventDefault();

                $('#overlay').show();

                $.ajax({
                    url: "{{ route('process') }}",
                    // url: "https://dev.therecz.com/user_login",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },

                    data: JSON.stringify({
                        emailID: $('#emailID').val(),
                        pass: $('#pass').val()
                    }),
                    success: function(response) {
                        $('#overlay').hide();

                        if (response.success) {
                            localStorage.setItem('api_token', response.token);
                            localStorage.setItem('firstName', response
                                .firstName); // Store the user name
                            window.location.href = response.redirect_url;
                        } else {
                            displayErrors({
                                password: response.errors.password
                            });
                        }
                    },
                    error: function(xhr) {
                        $('#overlay').hide();

                        const errors = xhr.responseJSON ? xhr.responseJSON.errors : {
                            password: 'An error occurred'
                        };
                        displayErrors(errors);
                    }
                });
            });

            function displayErrors(errors) {
                $('#emailError').html('');
                $('#passwordError').html('');

                $('#emailID').removeClass('error_border');
                $('#pass').removeClass('error_border');

                if (errors.emailID) {
                    $('#emailError').html(errors.emailID);
                    $('#emailID').addClass('error_border');
                }

                if (errors.pass) {
                    $('#passwordError').html(errors.pass);
                    $('#pass').addClass('error_border');
                }

                if (errors.password) {
                    $('#passwordError').html(errors.password);
                    $('#pass').addClass('error_border');
                }
            }
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $('.login_button').on('click', function(e) {
                e.preventDefault();

                const emailId = $('#emailId').val();
                const password = $('#pass').val();
                const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

                if (!emailPattern.test(emailId)) {
                    $('#emailError').text('Please enter a valid email address.');
                    $('#emailId').addClass('error_border');
                    return;
                } else {
                    $('#emailError').text('');
                    $('#emailId').removeClass('error_border');
                }

                $('#overlay').show();

                $.ajax({
                    // url: "{{ route('process') }}",
                    url: "https://dev.therecz.com/user_login",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    data: JSON.stringify({
                        emailID: emailId,
                        pass: password

                    }),
                    success: function(response) {
                        $('#overlay').hide();

                        if (response.success) {
                            localStorage.setItem('api_token', response.token);
                            localStorage.setItem('firstName', response.firstName);
                            window.location.href = response.redirect_url;
                        } else {
                            displayErrors(response.errors);
                        }
                    },
                    error: function(xhr) {
                        $('#overlay').hide();

                        const errors = xhr.responseJSON ? xhr.responseJSON.errors : {
                            password: 'An error occurred'
                        };
                        displayErrors(errors);
                    }
                });
            });

            function displayErrors(errors) {
                $('#emailError').html('');
                $('#passwordError').html('');

                $('#emailId').removeClass('error_border');
                $('#pass').removeClass('error_border');

                if (errors.emailID) {
                    $('#emailError').html(errors.emailID);
                    $('#emailId').addClass('error_border');
                }

                if (errors.pass) {
                    $('#passwordError').html(errors.pass);
                    $('#pass').addClass('error_border');
                }

                if (errors.password) {
                    $('#passwordError').html(errors.password);
                    $('#pass').addClass('error_border');
                }
            }
        });
    </script>
@endsection
