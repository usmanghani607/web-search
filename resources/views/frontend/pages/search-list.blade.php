@extends('layouts.frontend')
<?php
session_start();
?>
<style>
    #loaderOverlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    #loader {
        display: none;
        position: fixed;
        left: 50%;
        top: 50%;
        z-index: 1000;
        width: 50px;
        height: 50px;
        margin: -25px 0 0 -25px;
        border: 10px solid #f3f3f3;
        border-radius: 50%;
        border-top: 10px solid #FF385C;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    form#indexForm {
        margin-bottom: 0;
    }

    .hidden {
        display: none;
    }

    .dropdown-content.show {
        display: block;
    }

    .swal2-actions .swal2-confirm.swal2-styled {
        background-color: #FF385C
    }
</style>

@section('content')
    <div class="topheader">
        <div class="container-fluid">
            <div class="row">
                <nav class="navbar navbar-expand-lg">
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
                            <form id="indexForm" class="d-flex search-container" role="search">
                                @csrf
                                <input id="searchInput" class="form-control me-2" aria-label="Search">
                                <div class="search_icon">
                                    <img src="{{ asset('images/search-icon.png') }}" alt="">
                                </div>
                            </form>
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

    <div class="header_filter">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="search_checkbox">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input filter-checkbox" type="checkbox" id="all" value="All"
                                checked>
                            <label class="form-check-label" for="all">All</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input filter-checkbox" type="checkbox" id="movies" value="Movies">
                            <label class="form-check-label" for="movies">Movies</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input filter-checkbox" type="checkbox" id="web_series"
                                value="Web Series">
                            <label class="form-check-label" for="web_series">Web series</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input filter-checkbox" type="checkbox" id="books" value="Books">
                            <label class="form-check-label" for="books">Books</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="rest form-check-input filter-checkbox" type="checkbox" id="restaurants"
                                value="Restaurants">
                            <label class="form-check-label" for="restaurants">Restaurants</label>
                            <img src="{{ asset('images/icon.png') }}" alt="Star Icon" class="checkbox-image"
                                id="checkboxImage">
                        </div>
                        {{-- <div class="form-check form-check-inline">
                            <input class="form-check-input filter-checkbox" type="checkbox" id="news" value="News">
                            <label class="form-check-label" for="news">News</label>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="loaderOverlay"></div>
    <div id="loader"></div>

    <div class="filter_result">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p id="searchResultText"></p>
                </div>
            </div>
        </div>
    </div>

    <section class="filter_list">
        <div class="container"></div>

    </section>

    {{-- <section class="listing_pagnation">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </section> --}}


    <script>
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
    </script>

    <script>
        $(document).ready(function() {
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

                    $('#loaderOverlay').show();
                    $('#loader').show();

                    $.ajax({
                        // url: "{{ route('search-list-process') }}",
                        url: "https://dev.therecz.com/search-list-process", // Ensure HTTPS is used
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Authorization': 'Bearer ' + token
                        },
                        data: {
                            search_query: searchText,
                            catID: catID
                        },
                        success: function(response) {
                            $('#loaderOverlay').hide();
                            $('#loader').hide();

                            if (response.success) {
                                renderResults(response.result);
                            } else {
                                console.error('No results found');
                            }
                        },
                        error: function(xhr, status, error) {
                            $('#loaderOverlay').hide();
                            $('#loader').hide();
                            console.error(error);
                        }
                    });
                } else {
                    console.log('Empty search input');
                }
            }

            $('#searchInput').on('input', function() {
                var searchText = $(this).val().trim();
                $('#searchResultText').text(`Showing result “${searchText}”`);
            });

            $('#indexForm').on('submit', function(e) {
                e.preventDefault();
                var searchText = $('#searchInput').val().trim();
                $('#searchResultText').text(`Showing result “${searchText}”`);
                var selectedCatID = getSelectedCatID();
                performSearch(searchText, selectedCatID);
            });

            $(document).on('change', '.filter-checkbox', function() {
                $('.filter-checkbox').prop('checked', false);
                $(this).prop('checked', true);
                var searchText = $('#searchInput').val().trim();
                var selectedCatID = getSelectedCatID();
                performSearch(searchText, selectedCatID);
            });

            function getSelectedCatID() {
                const category = $('.filter-checkbox:checked').val();
                switch (category) {
                    case 'Movies':
                        return 1; // CatID for Movies
                    case 'Web Series':
                        return 2; // CatID for Web Series
                    case 'Books':
                        return 8; // CatID for Books
                    case 'Restaurants':
                        return 3; // CatID for Restaurants
                    default:
                        return 0; // CatID for All or unspecified
                }
            }

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
                performSearch(searchQuery, getSelectedCatID());
            } else {
                $('#all').prop('checked', true);
                $('#searchResultText').text('Showing result “All”');
                performSearch('All', 0); // CatID for All
            }

            function renderResults(results) {
                var container = $('.filter_list .container');
                container.empty();

                var charLimit = 300;

                results.forEach(function(result) {
                    var imgSrc = result.img ? result.img : '{{ asset('images/dummy_image.webp') }}';
                    var lstReczItFrnd = result.lstReczItFrnd;
                    var firstName = lstReczItFrnd.length > 0 ? lstReczItFrnd[0].firstName : '';
                    var totalReczIt = result.totalReczIt;
                    var reczItText = firstName ?
                        `<span style="color: #000000"><span class="start_bold">${firstName}</span> and ${totalReczIt} <span class="start_bold">other</span> people Recz it!</span>` :
                        '';

                    var metaValue22 = '';
                    if (result.lstMeta) {
                        var metaItem = result.lstMeta.find(meta => meta.metaID === 22);
                        metaValue22 = metaItem ? metaItem.value : '';
                    }

                    var metaValue26 = '';
                    if (result.lstMeta) {
                        var metaItem = result.lstMeta.find(meta => meta.metaID === 26);
                        metaValue26 = metaItem ? metaItem.value : '';
                    }

                    var metaValue51 = '';
                    if (result.lstMeta) {
                        var metaItem = result.lstMeta.find(meta => meta.metaID === 51);
                        metaValue51 = metaItem ? metaItem.value : '';
                    }

                    var metaValue53 = '';
                    if (result.lstMeta) {
                        var metaItem = result.lstMeta.find(meta => meta.metaID === 53);
                        metaValue53 = metaItem ? metaItem.value : '';
                    }

                    var metaValue15 = '';
                    if (result.lstMeta) {
                        var metaItem = result.lstMeta.find(meta => meta.metaID === 15);
                        metaValue15 = metaItem ? metaItem.value : '';
                    }

                    var dataSrcHtml = '';
                    if (result.catID === 1 && result.dataSrc) {
                        dataSrcHtml = `<span class="imb">${result.dataSrc}</span>`;
                    }

                    var authorHtml = '';
                    if (metaValue26) {
                        authorHtml = `<div class="mb-2 auther">
                                            <span>Auther - ${metaValue26}</span>
                                        </div>`;
                    }

                    var additionalInfoHtml = '';
                    if (result.catID === 1) {
                        additionalInfoHtml = `<span class="yellow_star"><img src="{{ asset('images/yellow_star.png') }}" alt=""></span>
                                                <span class="bold">${result.rating} / 10</span>`;
                    }

                    var metaValue15Html = metaValue15 ? `<div class="mb-2 text-gray">
                                                <span>${metaValue15}.</span>
                                            </div>` : '';

                    function truncateText(text, limit) {
                        return text.length > limit ? text.substring(0, limit) + '...' : text;
                    }

                    var metaValue53Html = metaValue53 ? `<div class="mb-3 text-gray">
                                                <span>${truncateText(metaValue53, charLimit)}</span>
                                            </div>` : '';

                    var metaValue22Html = metaValue22 ? `<span>${metaValue22} ·</span>` : '';

                    var resultHtml = `<div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card shadow-0 border rounded-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="img_round">
                                                        <a href="https://dev.therecz.com/search-detail?id=${result.pid}&catID=${result.catID ? result.catID : ''}">
                                                            <img src="${imgSrc}" class="w-100" onerror="this.onerror=null;this.src='{{ asset('images/dummy_image.webp') }}';"/>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                    <h5>${result.title}</h5>
                                                    ${authorHtml}
                                                    ${metaValue15Html}
                                                    <div class="mb-2 text-gray">
                                                        ${metaValue22Html}
                                                        <span>${metaValue51}</span>
                                                        ${additionalInfoHtml}
                                                        ${dataSrcHtml}
                                                    </div>
                                                    ${metaValue53Html}
                                                    <div class="text-starts">
                                                        <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">${result.rating}</span>
                                                        ${reczItText}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    container.append(resultHtml);
                });
            }
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
@endsection
