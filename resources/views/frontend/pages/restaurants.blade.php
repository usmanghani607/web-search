@extends('layouts.frontend')
<?php
session_start();
?>
@section('content')
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
                                    <input id="searchInput" class="form-control me-2" aria-label="Search">
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
                            <input class="form-check-input filter-checkbox" type="checkbox" id="all" value="All">
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
                        <div class="form-check form-check-inline">
                            <input class="form-check-input filter-checkbox" type="checkbox" id="news" value="News">
                            <label class="form-check-label" for="news">News</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="filter_result">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {{-- <p>Showing result <span class="restaurant_result">“Restaurant in New York”</span></p> --}}
                    <p class="result_message" style="display: none;">Showing result<span class="restaurant_result"></span></p>
                </div>
            </div>
        </div>
    </section>

    <section class="filter_restaurant">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="list_heading">
                        <p>Restaurants near you <a href="#" class="see">See All</a></p>

                    </div>
                    <div class="row restaurant-cards">
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card_img">
                                    <img class="card-main-img" src="{{ asset('images/restautant1.png') }}"
                                        alt="restaurant img">
                                    <img class="overlay-sec-img" src="{{ asset('images/top_img_2.png') }}"
                                        alt="Top Image">
                                    <img class="overlay-first-img" src="{{ asset('images/top_img.png') }}"
                                        alt="Top Image">
                                    <span>Prerna, Ranga and 12 other people visited here!</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Homer Cafe and Bar</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-2">
                            <div class="card">
                                <div class="card_img">
                                    <img class="card-main-img" src="{{ asset('images/restautant2.png') }}"
                                        alt="restaurant img">
                                    <img class="overlay-sec-img" src="{{ asset('images/top_img.png') }}" alt="Top Image">
                                    <img class="overlay-first-img" src="{{ asset('images/top_img_2.png') }}"
                                        alt="Top Image">
                                    <span>Pamkhuri, Prerna, and 12 other people visited here!</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Homer Cafe and Bar</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card_img">
                                    <img class="card-main-img" src="{{ asset('images/restautant1.png') }}"
                                        alt="restaurant img">
                                    <img class="overlay-sec-img" src="{{ asset('images/top_img_2.png') }}"
                                        alt="Top Image">
                                    <img class="overlay-first-img" src="{{ asset('images/top_img.png') }}"
                                        alt="Top Image">
                                    <span>Prerna, Ranga and 12 other people visited here!</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Homer Cafe and Bar</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card_img">
                                    <img class="card-main-img" src="{{ asset('images/restautant2.png') }}"
                                        alt="restaurant img">
                                    <img class="overlay-sec-img" src="{{ asset('images/top_img.png') }}"
                                        alt="Top Image">
                                    <img class="overlay-first-img" src="{{ asset('images/top_img_2.png') }}"
                                        alt="Top Image">
                                    <span>Pamkhuri, Prerna, and 12 other people visited here!</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Homer Cafe and Bar</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card_img">
                                    <img class="card-main-img" src="{{ asset('images/restautant1.png') }}"
                                        alt="restaurant img">
                                    <img class="overlay-sec-img" src="{{ asset('images/top_img_2.png') }}"
                                        alt="Top Image">
                                    <img class="overlay-first-img" src="{{ asset('images/top_img.png') }}"
                                        alt="Top Image">
                                    <span>Prerna, Ranga and 12 other people visited here!</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Homer Cafe and Bar</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card_img">
                                    <img class="card-main-img" src="{{ asset('images/restautant2.png') }}"
                                        alt="restaurant img">
                                    <img class="overlay-sec-img" src="{{ asset('images/top_img.png') }}"
                                        alt="Top Image">
                                    <img class="overlay-first-img" src="{{ asset('images/top_img_2.png') }}"
                                        alt="Top Image">
                                    <span>Pamkhuri, Prerna, and 12 other people visited here!</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Homer Cafe and Bar</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div class="row">
                        <div class="card">
                            <img class="card-main-img" src="{{ asset('images/restautant1.png') }}" alt="restaurant img">
                            <div class="card-body">
                                <h3 class="card-title">Homer Cafe and Bar</h3>
                                <h3 class="card-text">New York</h3>
                                <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                        alt="">4.5</span>
                                <span class="rating">425 Users Recz It!</span>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-main-img" src="{{ asset('images/restautant1.png') }}" alt="restaurant img">
                            <div class="card-body">
                                <h3 class="card-title">Homer Cafe and Bar</h3>
                                <h3 class="card-text">New York</h3>
                                <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                        alt="">4.5</span>
                                <span class="rating">425 Users Recz It!</span>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-main-img" src="{{ asset('images/restautant1.png') }}" alt="restaurant img">
                            <div class="card-body">
                                <h3 class="card-title">Homer Cafe and Bar</h3>
                                <h3 class="card-text">New York</h3>
                                <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                        alt="">4.5</span>
                                <span class="rating">425 Users Recz It!</span>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-main-img" src="{{ asset('images/restautant1.png') }}" alt="restaurant img">
                            <div class="card-body">
                                <h3 class="card-title">Homer Cafe and Bar</h3>
                                <h3 class="card-text">New York</h3>
                                <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                        alt="">4.5</span>
                                <span class="rating">425 Users Recz It!</span>
                            </div>
                        </div>
                        <div class="card">
                            <img class="card-main-img" src="{{ asset('images/restautant1.png') }}" alt="restaurant img">
                            <div class="card-body">
                                <h3 class="card-title">Homer Cafe and Bar</h3>
                                <h3 class="card-text">New York</h3>
                                <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                        alt="">4.5</span>
                                <span class="rating">425 Users Recz It!</span>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    <section class="filter_restaurant">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="list_heading">
                        <p>Places near me <a href="#" class="see">See All</a></p>

                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card">
                                <img class="card-main-img" src="{{ asset('images/place1.png') }}" alt="restaurant img">
                                <div class="card-body">
                                    <h3 class="card-title">Homer Cafe and Bar</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img class="card-main-img" src="{{ asset('images/place2.png') }}" alt="restaurant img">
                                <div class="card-body">
                                    <h3 class="card-title">Homer Cafe and Bar</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img class="card-main-img" src="{{ asset('images/place3.png') }}" alt="restaurant img">
                                <div class="card-body">
                                    <h3 class="card-title">Homer Cafe and Bar</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img class="card-main-img" src="{{ asset('images/place4.png') }}" alt="restaurant img">
                                <div class="card-body">
                                    <h3 class="card-title">Homer Cafe and Bar</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img class="card-main-img" src="{{ asset('images/place5.png') }}" alt="restaurant img">
                                <div class="card-body">
                                    <h3 class="card-title">Homer Cafe and Bar</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <img class="card-main-img" src="{{ asset('images/place6.png') }}" alt="restaurant img">
                                <div class="card-body">
                                    <h3 class="card-title">Homer Cafe and Bar</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="filter_restaurant near_rest">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="list_heading">
                        <p>Nearest Restaurants List <a href="#" class="see">See All</a></p>

                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card">
                                {{-- <img class="card-main-img" src="{{ asset('images/near1.png') }}" alt="restaurant img"> --}}
                                <div class="card_img">
                                    <img class="card-main-img" src="{{ asset('images/near1.png') }}"
                                        alt="restaurant img">
                                    <img class="overlay-first-img" src="{{ asset('images/top_img.png') }}"
                                        alt="Top Image">
                                    <span>Prerna recommended this restaurant in <br>New York</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">The Odeon</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card_img">
                                    <img class="card-main-img" src="{{ asset('images/near2.png') }}"
                                        alt="restaurant img">
                                    <img class="overlay-first-img" src="{{ asset('images/top_img.png') }}"
                                        alt="Top Image">
                                    <span>Prerna recommended this restaurant in <br>New York</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">New Garden</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card_img">
                                    <img class="card-main-img" src="{{ asset('images/near3.png') }}"
                                        alt="restaurant img">
                                    <img class="overlay-first-img" src="{{ asset('images/top_img.png') }}"
                                        alt="Top Image">
                                    <span>Prerna recommended this restaurant in <br>New York</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Homer Cafe and Bar</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card_img">
                                    <img class="card-main-img" src="{{ asset('images/near4.png') }}"
                                        alt="restaurant img">
                                    <img class="overlay-first-img" src="{{ asset('images/top_img.png') }}"
                                        alt="Top Image">
                                    <span>Prerna recommended this restaurant in <br>New York</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Starbucks</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card_img">
                                    <img class="card-main-img" src="{{ asset('images/near5.png') }}"
                                        alt="restaurant img">
                                    <img class="overlay-first-img" src="{{ asset('images/top_img.png') }}"
                                        alt="Top Image">
                                    <span>Prerna recommended this restaurant in <br>New York</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Homer Cafe and Bar</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card_img">
                                    <img class="card-main-img" src="{{ asset('images/near6.png') }}"
                                        alt="restaurant img">
                                    <img class="overlay-first-img" src="{{ asset('images/top_img.png') }}"
                                        alt="Top Image">
                                    <span>Prerna recommended this restaurant in <br>New York</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">Starbucks</h3>
                                    <h3 class="card-text">New York</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                            alt="">4.5</span>
                                    <span class="rating">425 Users Recz It!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

    {{-- <script>
        $(document).ready(function() {
            function performSearch(searchText) {
                if (searchText.length > 0) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var token = localStorage.getItem('api_token');

                    $('#loaderOverlay').show();
                    $('#loader').show();

                    $.ajax({
                        url: "{{ route('restaurant-process') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Authorization': 'Bearer ' + token
                        },
                        data: {
                            search_query: searchText
                        },
                        success: function(response) {
                            $('#loaderOverlay').hide();
                            $('#loader').hide();

                            if (response.success) {
                                renderResults(response.result);
                                $('#searchResultText').text(`Showing result “${searchText}”`);
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
                performSearch(searchText);

                if (searchText.length === 0) {
                    $('#searchResultText').text('');
                }
            });

            $('#indexForm').on('submit', function(e) {
                e.preventDefault();
                var searchText = $('#searchInput').val().trim();
                performSearch(searchText);
            });

            // Add event listeners for checkboxes
            $('.filter-checkbox').on('change', function() {
                if (this.checked) {
                    var searchText = $(this).val();
                    $('#searchInput').val(searchText);

                    performSearch(searchText);
                }
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
                performSearch(searchQuery);
                $('#searchResultText').text(`Showing result “${searchQuery}”`);
            }

            function renderResults(results) {
                var container = $('.filter_list .container');
                container.empty();

                results.forEach(function(result) {
                    var imbSpan = result.dataSrc ? `<span class="imb">${result.dataSrc}</span>` : '';
                    var resultHtml = `<div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="card shadow-0 border rounded-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="img_round">
                                                            <a href="#!">
                                                                <img src="${result.img}" class="w-100" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <h5>${result.title}</h5>
                                                        <div class="mb-2 auther">
                                                            <span>Director- ${result.author}</span>
                                                        </div>
                                                        <div class="mb-2 text-gray">
                                                            <span>2h 20m ·</span>
                                                            <span>Action,</span>
                                                            <span>Adventure,</span>
                                                            <span>Animation ·</span>
                                                            <span>1 Jun, 2001</span>
                                                            <span class="yellow_star"><img src="{{ asset('images/yellow_star.png') }}" alt=""></span>
                                                            <span class="bold">${result.rating} / 10</span>
                                                            <span class="bold">(688K)</span>
                                                            ${imbSpan}
                                                        </div>
                                                        <div class="mb-3 text-gray">
                                                            <span>An ancient prophecy seems to be coming true when a mysterious presence begins
                                                                stalking the corridors of a school of magic and leaving its victims
                                                                paralyzed.</span>
                                                        </div>
                                                        <div class="text-starts">
                                                            <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">${result.rating}</span>
                                                            <span style="color: #000000"><span class="start_bold">Ranga</span> and 327 <span class="start_bold">other</span> people Recz it!</span>
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
    </script> --}}

    {{-- <script>
        $(document).ready(function() {
            function performSearch(searchText) {
                if (searchText.length > 0) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var token = localStorage.getItem('api_token');

                    $('#loaderOverlay').show();
                    $('#loader').show();

                    $.ajax({
                        url: "{{ route('restaurant-process') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Authorization': 'Bearer ' + token
                        },
                        data: {
                            search_query: searchText
                        },
                        success: function(response) {
                            $('#loaderOverlay').hide();
                            $('#loader').hide();

                            if (response.success) {
                                renderResults(response.result);
                                $('.restaurant_result').text(`“${searchText}”`);
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
                performSearch(searchText);

                if (searchText.length === 0) {
                    $('.restaurant_result').text('');
                }
            });

            $('#indexForm').on('submit', function(e) {
                e.preventDefault();
                var searchText = $('#searchInput').val().trim();
                performSearch(searchText);
            });

            // Add event listeners for checkboxes
            $('.filter-checkbox').on('change', function() {
                if (this.checked) {
                    var searchText = $(this).val();
                    $('#searchInput').val(searchText);

                    performSearch(searchText);
                }
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
                performSearch(searchQuery);
                $('.restaurant_result').text(`“${searchQuery}”`);
            }

            function renderResults(results) {
                var container = $('.filter_list .container');
                container.empty();

                results.forEach(function(result) {
                    var imbSpan = result.dataSrc ? `<span class="imb">${result.dataSrc}</span>` : '';
                    var resultHtml = `<div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="card shadow-0 border rounded-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="img_round">
                                                            <a href="#!">
                                                                <img src="${result.img}" class="w-100" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <h5>${result.title}</h5>
                                                        <div class="mb-2 auther">
                                                            <span>Director- ${result.author}</span>
                                                        </div>
                                                        <div class="mb-2 text-gray">
                                                            <span>2h 20m ·</span>
                                                            <span>Action,</span>
                                                            <span>Adventure,</span>
                                                            <span>Animation ·</span>
                                                            <span>1 Jun, 2001</span>
                                                            <span class="yellow_star"><img src="{{ asset('images/yellow_star.png') }}" alt=""></span>
                                                            <span class="bold">${result.rating} / 10</span>
                                                            <span class="bold">(688K)</span>
                                                            ${imbSpan}
                                                        </div>
                                                        <div class="mb-3 text-gray">
                                                            <span>An ancient prophecy seems to be coming true when a mysterious presence begins
                                                                stalking the corridors of a school of magic and leaving its victims
                                                                paralyzed.</span>
                                                        </div>
                                                        <div class="text-starts">
                                                            <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">${result.rating}</span>
                                                            <span style="color: #000000"><span class="start_bold">Ranga</span> and 327 <span class="start_bold">other</span> people Recz it!</span>
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
    </script> --}}

    {{-- <script>
        $(document).ready(function() {
            function performSearch(searchText) {
                if (searchText.length > 0) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var token = localStorage.getItem('api_token');

                    $('#loaderOverlay').show();
                    $('#loader').show();

                    $.ajax({
                        url: "{{ route('restaurant-process') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Authorization': 'Bearer ' + token
                        },
                        data: {
                            search_query: searchText
                        },
                        success: function(response) {
                            $('#loaderOverlay').hide();
                            $('#loader').hide();

                            if (response.success) {
                                renderResults(response.result);
                                $('.restaurant_result').text(`“${searchText}”`);
                                $('.result_message').show();
                            } else {
                                console.error('No results found');
                                $('.result_message').hide();
                            }
                        },
                        error: function(xhr, status, error) {
                            $('#loaderOverlay').hide();
                            $('#loader').hide();
                            console.error(error);
                            $('.result_message').hide();
                        }
                    });
                } else {
                    console.log('Empty search input');
                    $('.result_message').hide();
                }
            }

            $('#searchInput').on('input', function() {
                var searchText = $(this).val().trim();
                performSearch(searchText);

                if (searchText.length === 0) {
                    $('.restaurant_result').text('');
                    $('.result_message').hide();
                }
            });

            $('#indexForm').on('submit', function(e) {
                e.preventDefault();
                var searchText = $('#searchInput').val().trim();
                performSearch(searchText);
            });

            // Add event listeners for checkboxes
            $('.filter-checkbox').on('change', function() {
                if (this.checked) {
                    var searchText = $(this).val();
                    $('#searchInput').val(searchText);

                    performSearch(searchText);
                }
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
                performSearch(searchQuery);
                $('.restaurant_result').text(`“${searchQuery}”`);
                $('.result_message').show();
            }

            function renderResults(results) {
                var container = $('.filter_list .container');
                container.empty();

                results.forEach(function(result) {
                    var imbSpan = result.dataSrc ? `<span class="imb">${result.dataSrc}</span>` : '';
                    var resultHtml = `<div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="card shadow-0 border rounded-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="img_round">
                                                            <a href="#!">
                                                                <img src="${result.img}" class="w-100" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <h5>${result.title}</h5>
                                                        <div class="mb-2 auther">
                                                            <span>Director- ${result.author}</span>
                                                        </div>
                                                        <div class="mb-2 text-gray">
                                                            <span>2h 20m ·</span>
                                                            <span>Action,</span>
                                                            <span>Adventure,</span>
                                                            <span>Animation ·</span>
                                                            <span>1 Jun, 2001</span>
                                                            <span class="yellow_star"><img src="{{ asset('images/yellow_star.png') }}" alt=""></span>
                                                            <span class="bold">${result.rating} / 10</span>
                                                            <span class="bold">(688K)</span>
                                                            ${imbSpan}
                                                        </div>
                                                        <div class="mb-3 text-gray">
                                                            <span>An ancient prophecy seems to be coming true when a mysterious presence begins
                                                                stalking the corridors of a school of magic and leaving its victims
                                                                paralyzed.</span>
                                                        </div>
                                                        <div class="text-starts">
                                                            <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">${result.rating}</span>
                                                            <span style="color: #000000"><span class="start_bold">Ranga</span> and 327 <span class="start_bold">other</span> people Recz it!</span>
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
    </script> --}}


    {{-- <script>
        $(document).ready(function() {
            function performSearch(searchText) {
                if (searchText.length > 0) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var token = localStorage.getItem('api_token');

                    $('#loaderOverlay').show();
                    $('#loader').show();

                    $.ajax({
                        url: "{{ route('restaurant-process') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Authorization': 'Bearer ' + token
                        },
                        data: {
                            search_query: searchText
                        },
                        success: function(response) {
                            $('#loaderOverlay').hide();
                            $('#loader').hide();

                            if (response.success) {
                                renderResults(response.result);
                                $('.restaurant_result').text(`“${searchText}”`);
                                $('.result_message').show();
                            } else {
                                console.error('No results found');
                                $('.restaurant-cards').empty(); // Clear previous results
                                $('.result_message').hide();
                            }
                        },
                        error: function(xhr, status, error) {
                            $('#loaderOverlay').hide();
                            $('#loader').hide();
                            console.error(error);
                            $('.restaurant-cards').empty(); // Clear previous results
                            $('.result_message').hide();
                        }
                    });
                } else {
                    console.log('Empty search input');
                    $('.restaurant-cards').empty(); // Clear previous results
                    $('.result_message').hide();
                }
            }

            $('#searchInput').on('input', function() {
                var searchText = $(this).val().trim();
                performSearch(searchText);

                if (searchText.length === 0) {
                    $('.restaurant_result').text('');
                    $('.restaurant-cards').empty(); // Clear previous results
                    $('.result_message').hide();
                }
            });

            $('#indexForm').on('submit', function(e) {
                e.preventDefault();
                var searchText = $('#searchInput').val().trim();
                performSearch(searchText);
            });

            // Add event listeners for checkboxes
            $('.filter-checkbox').on('change', function() {
                if (this.checked) {
                    var searchText = $(this).val();
                    $('#searchInput').val(searchText);

                    performSearch(searchText);
                }
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
                performSearch(searchQuery);
                $('.restaurant_result').text(`“${searchQuery}”`);
                $('.result_message').show();
            }

            function renderResults(results) {
                var container = $('.restaurant-cards');
                container.empty();

                results.forEach(function(result) {
                    var imbSpan = result.dataSrc ? `<span class="imb">${result.dataSrc}</span>` : '';
                    var cardHtml = `
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card_img">
                                    <img class="card-main-img" src="${result.img}" alt="restaurant img">
                                    <!-- Include overlay images and other content here -->
                                    <span>${result.visitors}</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">${result.title}</h3>
                                    <h3 class="card-text">${result.location}</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">${result.rating}</span>
                                    <span class="rating">${result.recommendations} Users Recz It!</span>
                                </div>
                            </div>
                        </div>`;
                    container.append(cardHtml);
                });
            }
        });
    </script> --}}


    {{-- <script>
        $(document).ready(function() {
            function performSearch(searchText) {
                if (searchText.length > 0) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var token = localStorage.getItem('api_token');

                    $('#loaderOverlay').show();
                    $('#loader').show();

                    $.ajax({
                        url: "{{ route('restaurant-process') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Authorization': 'Bearer ' + token
                        },
                        data: {
                            search_query: searchText
                        },
                        success: function(response) {
                            $('#loaderOverlay').hide();
                            $('#loader').hide();

                            if (response.success) {
                                renderResults(response.result);
                                $('.restaurant_result').text(`“${searchText}”`);
                                $('.result_message').show();
                            } else {
                                console.error('No results found');
                                $('.restaurant-cards').empty(); // Clear previous results
                                $('.result_message').hide();
                            }
                        },
                        error: function(xhr, status, error) {
                            $('#loaderOverlay').hide();
                            $('#loader').hide();
                            console.error(error);
                            $('.restaurant-cards').empty(); // Clear previous results
                            $('.result_message').hide();
                        }
                    });
                } else {
                    console.log('Empty search input');
                    $('.restaurant-cards').empty(); // Clear previous results
                    $('.result_message').hide();
                }
            }

            $('#searchInput').on('input', function() {
                var searchText = $(this).val().trim();
                performSearch(searchText);

                if (searchText.length === 0) {
                    $('.restaurant_result').text('');
                    $('.restaurant-cards').empty(); // Clear previous results
                    $('.result_message').hide();
                }
            });

            $('#indexForm').on('submit', function(e) {
                e.preventDefault();
                var searchText = $('#searchInput').val().trim();
                performSearch(searchText);
            });

            // Add event listeners for checkboxes
            $('.filter-checkbox').on('change', function() {
                if (this.checked) {
                    var searchText = $(this).val();
                    $('#searchInput').val(searchText);

                    performSearch(searchText);
                }
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
                performSearch(searchQuery);
                $('.restaurant_result').text(`“${searchQuery}”`);
                $('.result_message').show();
            }

            function renderResults(results) {
                var container = $('.restaurant-cards');
                container.empty();

                results.forEach(function(result) {
                    var img = result.img ? result.img : '{{ asset('images/dummy_image.png') }}';
                    var imbSpan = result.dataSrc ? `<span class="imb">${result.dataSrc}</span>` : '';
                    var cardHtml = `
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card_img">
                                    <img class="card-main-img" src="${result.img}" alt="restaurant img">
                                    <!-- Include overlay images and other content here -->
                                    <img class="overlay-sec-img" src="${result.lstPublicPhotos}"
                                        alt="Top Image">
                                    <img class="overlay-first-img" src="${result.lstPublicPhotos}"
                                        alt="Top Image">
                                    <span>${result.totalVisitedFrnd}</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">${result.title}</h3>
                                    <h3 class="card-text">${result.location}</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">${result.rating}</span>
                                    <span class="rating">${result.recommendations} Users Recz It!</span>
                                </div>
                            </div>
                        </div>`;
                    container.append(cardHtml);
                });
            }
        });
    </script> --}}


    <script>
        $(document).ready(function() {
            function performSearch(searchText) {
                if (searchText.length > 0) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var token = localStorage.getItem('api_token');

                    $('#loaderOverlay').show();
                    $('#loader').show();

                    $.ajax({
                        url: "{{ route('restaurant-process') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Authorization': 'Bearer ' + token
                        },
                        data: {
                            search_query: searchText
                        },
                        success: function(response) {
                            $('#loaderOverlay').hide();
                            $('#loader').hide();

                            if (response.success) {
                                renderResults(response.result);
                                $('.restaurant_result').text(`“${searchText}”`);
                                $('.result_message').show();
                            } else {
                                console.error('No results found');
                                $('.restaurant-cards').empty(); // Clear previous results
                                $('.result_message').hide();
                            }
                        },
                        error: function(xhr, status, error) {
                            $('#loaderOverlay').hide();
                            $('#loader').hide();
                            console.error(error);
                            $('.restaurant-cards').empty(); // Clear previous results
                            $('.result_message').hide();
                        }
                    });
                } else {
                    console.log('Empty search input');
                    $('.restaurant-cards').empty(); // Clear previous results
                    $('.result_message').hide();
                }
            }

            $('#searchInput').on('input', function() {
                var searchText = $(this).val().trim();
                performSearch(searchText);

                if (searchText.length === 0) {
                    $('.restaurant_result').text('');
                    $('.restaurant-cards').empty(); // Clear previous results
                    $('.result_message').hide();
                }
            });

            $('#indexForm').on('submit', function(e) {
                e.preventDefault();
                var searchText = $('#searchInput').val().trim();
                performSearch(searchText);
            });

            // Add event listeners for checkboxes
            $('.filter-checkbox').on('change', function() {
                if (this.checked) {
                    var searchText = $(this).val();
                    $('#searchInput').val(searchText);

                    performSearch(searchText);
                }
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
                performSearch(searchQuery);
                $('.restaurant_result').text(`“${searchQuery}”`);
                $('.result_message').show();
            }

            function renderResults(results) {
                var container = $('.restaurant-cards');
                container.empty();

                results.forEach(function(result) {
                    var imgSrc = result.img ? result.img : '{{ asset('images/dummy_image.png') }}';
                    var imbSpan = result.dataSrc ? `<span class="imb">${result.dataSrc}</span>` : '';
                    var cardHtml = `
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card_img">
                                    <img class="card-main-img" src="${imgSrc}" alt="restaurant img" onerror="this.onerror=null;this.src='{{ asset('images/dummy_image.png') }}';">
                                    <!-- Include overlay images and other content here -->
                                    <img class="overlay-sec-img" src="${result.lstPublicPhotos}" alt="Top Image" onerror="this.onerror=null;this.src='{{ asset('images/dummy_image.png') }}';">
                                    <img class="overlay-first-img" src="${result.lstPublicPhotos}" alt="Top Image" onerror="this.onerror=null;this.src='{{ asset('images/dummy_image.png') }}';">
                                    <span>${result.totalVisitedFrnd}</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">${result.title}</h3>
                                    <h3 class="card-text">${result.location}</h3>
                                    <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">${result.rating}</span>
                                    <span class="rating">${result.recommendations} Users Recz It!</span>
                                </div>
                            </div>
                        </div>`;
                    container.append(cardHtml);
                });
            }
        });
    </script>


@endsection
