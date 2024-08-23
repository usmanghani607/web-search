@extends('layouts.frontend')
<?php
session_start();
?>
<style>
    .detail_page {
        display: none;
    }

    .hidden {
        display: none;
    }

    .dropdown-content.show {
        display: block;
    }

    .red_star a,
    .grey_star a {
        color: #fff;
    }

    .red_star a:hover,
    .grey_star a:hover {
        color: #fff;
    }
</style>
@section('content')
    <div class="topheader">
        <div class="container-fluid">
            <div class="row">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <div class="col-md-3 recz_logo">
                            <div class="logo_left">
                                <a href="/"><img src="{{ asset('images/logo.png') }}" alt="logo"></a>
                            </div>
                        </div>
                        <div class="profile_btn">
                            <div class="col">
                                <div class="right_btn">
                                    <a href="/login" class="btn">Sign in</a>
                                    <a href="#" class="btn_red" data-bs-toggle="modal"
                                        data-bs-target="#loginModal">Sign Up</a>
                                </div>
                            </div>
                        </div>
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
                                            <img class="applestore" src="{{ asset('images/apple-play.png') }}"
                                                alt="">
                                            <img class="googlestore" src="{{ asset('images/google-play.png') }}"
                                                alt="">
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div id="loaderOverlay"></div>
    <div id="loader"></div>

    <section class="filter_restaurant">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="list_heading">
                        <p>Near by places</p>
                    </div>
                    <div class="row">
                        <div id="placeStatus"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {

            function updateURL(searchText) {
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('search_query', searchText);
                const newUrl = `${window.location.pathname}?${urlParams.toString()}`;
                window.history.pushState({
                    path: newUrl
                }, '', newUrl);
            }

            function performSearch(searchText, catID) {
                if (searchText.length > 0) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var token = localStorage.getItem('api_token');

                    if (!token) {
                        Swal.fire({
                            title: 'Login Required',
                            text: 'You need to login to perform this action.',
                            icon: 'warning',
                            confirmButtonText: 'Login',
                            cancelButtonText: 'Cancel',
                            showCancelButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/login';
                            } else if (result.isDismissed) {
                                window.location.href = '/';
                            }
                        });
                        return;
                    }

                    showLoader();

                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            function(position) {
                                const lat = position.coords.latitude;
                                const lon = position.coords.longitude;
                                console.log(`Latitude: ${lat}, Longitude: ${lon}`);

                                $.ajax({
                                    // url: "{{ route('all-places-process') }}",
                                    url: "https://dev.therecz.com/all-places-process",
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Authorization': 'Bearer ' + token
                                    },
                                    data: {
                                        search_query: searchText,
                                        latitude: lat,
                                        longitude: lon,
                                        category: 3
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            renderPlaceResults(response.result);
                                        } else {
                                            console.error(
                                            'No results found for all-places-process');
                                        }
                                        hideLoader();
                                    },
                                    error: function(xhr, status, error) {
                                        console.error('Error from all-places-process:', error);
                                        hideLoader();
                                    }
                                });

                            },
                            function(error) {
                                console.error("Error in retrieving location:", error.message);
                                hideLoader();
                                if (error.code === error.PERMISSION_DENIED) {
                                    $('#placeStatus').text(
                                        'Location Permission Denied, Location is not available.');

                                    $.ajax({
                                        // url: "{{ route('all-places-process') }}",
                                        url: "https://dev.therecz.com/all-places-process",
                                        type: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': csrfToken,
                                            'Authorization': 'Bearer ' + token
                                        },
                                        data: {
                                            search_query: searchText,
                                            category: 3
                                        },
                                        success: function(response) {
                                            if (response.success) {
                                                renderPlaceResults(response.result);
                                            } else {
                                                console.error(
                                                    'No results found for all-places-process');
                                            }
                                            hideLoader();
                                        },
                                        error: function(xhr, status, error) {
                                            console.error('Error from all-places-process:', error);
                                            hideLoader();
                                        }
                                    });
                                }
                            }
                        );
                    } else {
                        console.log("Geolocation is not supported by this browser.");
                        hideLoader();

                        $.ajax({
                            // url: "{{ route('all-places-process') }}",
                            url: "https://dev.therecz.com/all-places-process",

                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Authorization': 'Bearer ' + token
                            },
                            data: {
                                search_query: searchText,
                                category: 3
                            },
                            success: function(response) {
                                if (response.success) {
                                    renderPlaceResults(response.result);
                                } else {
                                    console.error('No results found for all-place-process');
                                }
                                hideLoader();
                            },
                            error: function(xhr, status, error) {
                                console.error('Error from restaurant-process:', error);
                                hideLoader();
                            }
                        });
                    }
                } else {
                    console.log('Empty search input');
                    hideLoader();
                }
            }

            function showLoader() {
                $('#loaderOverlay').show();
                $('#loader').show();
            }

            function hideLoader() {
                $('#loaderOverlay').hide();
                $('#loader').hide();
            }

            $('#searchInput').on('input', function() {
                var searchText = $(this).val().trim();
                $('#searchResultText').text(`Showing result for “${searchText}”`);
            });

            $('#indexForm').on('submit', function(e) {
                e.preventDefault();
                var searchText = $('#searchInput').val().trim();
                $('#searchResultText').text(`Showing result for “${searchText}”`);
                updateURL(searchText);
                performSearch(searchText, 3);
            });

            $('.search_icon').on('click', function(e) {
                e.preventDefault();
                var searchText = $('#searchInput').val().trim();
                $('#searchResultText').text(`Showing result for “${searchText}”`);
                updateURL(searchText);
                performSearch(searchText, 3);
            });

            function getQueryParams() {
                const params = {};
                const queryString = window.location.search.substring(1).replace(/\+/g, ' ');
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
                $('#searchInput').val(searchQuery);
                $('#searchResultText').text(`Showing result “${searchQuery}”`);
                performSearch(searchQuery, 3);
            } else {
                $('#searchResultText').text('Showing result “Restaurant”');
                performSearch('restaurant', 3);
            }

            function renderPlaceResults(results) {
                var placeStatus = $('#placeStatus');
                placeStatus.empty();

                if (results.length === 0) {
                    placeStatus.append('<p>Places are not available</p>');
                } else {
                    var rowHtml = '<div class="row">';

                    results.forEach(function(result) {

                        var imageUrl = result.img || '{{ asset('images/dummy_image.webp') }}';
                        var name = String(result.name).trim();
                        var address = String(result.address).trim();
                        var truncatedName = truncateText(result.name, 13);
                        var truncatedAddress = truncateText(result.address, 25);

                        console.log('Original address:', address);
                        console.log('Truncated address:', truncatedAddress);

                        rowHtml += `
                            <div class="col-md-2 mb-3">
                                <div class="card">
                                    <div class="card_img">
                                            <img class="card-main-img" src="${result.img}" alt="place img" onerror="this.onerror=null;this.src='{{ asset('images/dummy_image.webp') }}';">
                                        </div>
                                    <div class="card-body">
                                        <h3 class="card-title">${truncatedName}</h3>
                                        <h3 class="card-text">${truncatedAddress}</h3>
                                        <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">${result.rating}</span>
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    rowHtml += '</div>'; // Close the row
                    placeStatus.append(rowHtml);
                }
            }

            function truncateText(text, limit) {
                return text.length > limit ? text.substring(0, limit) + '...' : text;
            }

        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdownIcons = document.querySelectorAll('.dropdown-icon');

            dropdownIcons.forEach(icon => {
                icon.addEventListener('click', function() {
                    const dropdownMenu = document.querySelector(
                        `.dropdown-menu[data-id="${icon.dataset.id}"]`);
                    if (dropdownMenu.style.display === 'block') {
                        dropdownMenu.style.display = 'none';
                    } else {
                        dropdownMenu.style.display = 'block';
                    }
                });
            });

            document.addEventListener('click', function(event) {
                dropdownIcons.forEach(icon => {
                    const dropdownMenu = document.querySelector(
                        `.dropdown-menu[data-id="${icon.dataset.id}"]`);
                    if (!icon.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.style.display = 'none';
                    }
                });
            });
        });
    </script>

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

    <script>
        function showImageInModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
        }
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

            setInterval(checkSession, 7200000);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchParam = new URLSearchParams(window.location.search).get('query');
            if (searchParam) {
                const searchInput = document.getElementById('searchInput');
                if (searchInput) {
                    searchInput.value = decodeURIComponent(searchParam);
                }
            }
        });
    </script>
@endsection
