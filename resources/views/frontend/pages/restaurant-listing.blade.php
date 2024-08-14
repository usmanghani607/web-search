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
                    <p class="result_message" style="display: none;">Showing result<span class="restaurant_result"></span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="filter_restaurant">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="list_heading">
                        <p>Restaurants near you</p>

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
                        <div class="col-md-2">
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
                        </div>
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


@endsection
