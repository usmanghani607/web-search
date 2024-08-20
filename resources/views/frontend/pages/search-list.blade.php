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

    .filter_restaurant {
        display: none;
    }

    .filter_result {
        display: block;
    }

    .filter_list {
        display: block;
    }

    /* .filter_resulted {
        display: block;
    } */

    /* .map_section {
        display: block;
    } */

    #map {
            height: 350px;
            width: 100%;
        }
    .map_section {
        display: none;
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
                            >
                            <label class="form-check-label" for="all">All</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="movies form-check-input filter-checkbox" type="checkbox" id="movies"
                                value="Movies">
                            <label class="form-check-label" for="movies">Movies</label>
                            <img src="{{ asset('images/movies.png') }}" alt="Movies Icon" class="checkbox-image"
                                style="display: none;">
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="series form-check-input filter-checkbox" type="checkbox" id="web_series"
                                value="Web Series">
                            <label class="form-check-label" for="web_series">Web series</label>
                            <img src="{{ asset('images/series.png') }}" alt="Series Icon" class="checkbox-image"
                                style="display: none;">
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="book form-check-input filter-checkbox" type="checkbox" id="books"
                                value="Books">
                            <label class="form-check-label" for="books">Books</label>
                            <img src="{{ asset('images/book-icon.png') }}" alt="Books Icon" class="checkbox-image"
                                style="display: none;">
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="rest form-check-input filter-checkbox" type="checkbox" id="restaurants"
                                value="Restaurants">
                            <label class="form-check-label" for="restaurants">Restaurants</label>
                            <img src="{{ asset('images/icon.png') }}" alt="Restaurants Icon" class="checkbox-image"
                                style="display: none;">
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="rest form-check-input filter-checkbox" type="checkbox" id="music"
                                value="Music">
                            <label class="form-check-label" for="music">Music</label>
                            <img src="{{ asset('images/music-icon.png') }}" alt="Music Icon" class="checkbox-image"
                                style="display: none;">
                        </div>
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


    {{-- <section class="map_section" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div style="width: 100%"><iframe width="100%" height="350" frameborder="0" scrolling="no"
                            marginheight="0" marginwidth="0"
                            src="https://maps.google.com/maps?width=100%25&amp;height=350&amp;hl=en&amp;q=Restaurant%20in%20newyork+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a
                                href="https://www.gps.ie/">gps systems</a></iframe></div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="map_section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div style="width: 100%">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    {{-- <section class="filter_restaurant" style="display: none;">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="list_heading">
                        <p>Restaurants near you <a href="#" class="see">See All</a></p>
                    </div>
                    <div class="row">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
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
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
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
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    <section class="filter_restaurant" style="display: none;">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="list_heading">
                        <p>Restaurants near you <a href="#" class="see">See All</a></p>
                    </div>
                    <div class="row">
                        <div id="carouselRestaurantControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" id="restaurant-carousel-inner">

                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselRestaurantControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselRestaurantControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <p id="restaurantStatus"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="place_filter" style="display: none;">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="list_heading">
                        <p>Places near me <a href="#" class="see">See All</a></p>

                    </div>
                    <div class="row">
                        <div id="carouselPlaceControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" id="place-carousel-inner">

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselPlaceControls"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselPlaceControls"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="filter_restaurant" style="display: none;">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="list_heading">
                        <p>Places near me <a href="#" class="see">See All</a></p>
                    </div>
                    <div class="row">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" id="restaurant-carousel-inner">

                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

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
            const checkboxes = document.querySelectorAll('.filter-checkbox');
            const images = {
                movies: document.querySelector('#movies + label + img'),
                web_series: document.querySelector('#web_series + label + img'),
                books: document.querySelector('#books + label + img'),
                restaurants: document.querySelector('#restaurants + label + img'),
                music: document.querySelector('#music + label + img')

            };

            function toggleImages(selectedId) {
                Object.keys(images).forEach(id => {
                    images[id].style.display = (id === selectedId) ? 'inline' : 'none';
                });
            }

            function handleCheckboxChange(event) {
                checkboxes.forEach(checkbox => {
                    if (checkbox !== event.target) {
                        checkbox.checked = false;
                    }
                });

                toggleImages(event.target.id);
            }

            // Initially hide all images except for the selected one
            toggleImages(document.querySelector('.filter-checkbox:checked').id);

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', handleCheckboxChange);
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            function updateAllCheckboxState() {
                if ($('.filter-checkbox').not('#all').is(':checked')) {
                    $('#all').prop('checked', false);
                } else {
                    $('#all').prop('checked', true);
                }
            }

            function initializeCheckboxes() {
                var selectedRadioId = localStorage.getItem('selectedRadioId');
                var selectedCatID = localStorage.getItem('selectedCatID');

                if (selectedRadioId) {
                    $('#' + selectedRadioId).prop('checked', true);
                    $('#' + selectedRadioId).siblings('.checkbox-image').show();
                } else {

                    $('#all').prop('checked', true);
                }

                updateAllCheckboxState();
            }

            initializeCheckboxes();

            $('.filter-checkbox').on('change', function() {
                var checkboxId = $(this).attr('id');
                var catID = getSelectedCatID();

                $('.checkbox-image').hide();

                localStorage.setItem('selectedRadioId', checkboxId);
                localStorage.setItem('selectedCatID', catID);

                $(this).siblings('.checkbox-image').show();

                updateAllCheckboxState();
            });
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
                case 'Music':
                    return 13; // CatID for Music
                default:
                    return 0; // CatID for All or unspecified
            }
        }
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

    {{-- <script>
        $(document).ready(function() {
            function toggleSections() {
                if ($('#restaurants').is(':checked')) {
                    $('.filter_restaurant').show();
                    $('.map_section').show();
                    $('.place_filter').show();
                    $('.filter_list').hide();
                } else if ($('#all').is(':checked')) {
                    $('.filter_restaurant').hide();
                    $('.map_section').hide();
                    $('.place_filter').hide();
                    $('.filter_list').show();
                } else {
                    $('.filter_restaurant').hide();
                    $('.map_section').hide();
                    $('.place_filter').hide();
                    $('.filter_list').show();
                }
            }

            toggleSections();

            $('.filter-checkbox').on('change', function() {
                $('.filter-checkbox').prop('checked', false);
                $(this).prop('checked', true);
                toggleSections();

                var searchText = $('#searchInput').val().trim();
                var selectedCatID = getSelectedCatID();
                performSearch(searchText, selectedCatID);
            });

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

                    if (catID === 3) {
                        // Hit both routes for Restaurants
                        $.ajax({
                            url: "{{ route('restaurant-process') }}",
                            // url: "https://dev.therecz.com/restaurant-process",
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
                                if (response.success) {
                                    renderRestaurantResults(response.result);
                                } else {
                                    console.error('No results found for restaurant-process');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error from restaurant-process:', error);
                            },
                            complete: function() {
                                $('#loaderOverlay').hide();
                                $('#loader').hide();
                            }
                        });

                        $.ajax({
                            url: "{{ route('place-process') }}",
                            // url: "https://dev.therecz.com/place-process",
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
                                if (response.success) {
                                    renderPlaceResults(response.result);

                                } else {
                                    console.error('No results found for place-process');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error from place-process:', error);
                            }
                        });

                    } else {
                        // Hit the search-list-process route for other categories
                        $.ajax({
                            url: "{{ route('search-list-process') }}",
                            // url: "https://dev.therecz.com/search-list-process",
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
                                    renderSearchListResults(response.result);
                                } else {
                                    console.error('No results found for search-list-process');
                                }
                            },
                            error: function(xhr, status, error) {
                                $('#loaderOverlay').hide();
                                $('#loader').hide();
                                console.error(error);
                            }
                        });
                    }
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

            function truncateText(text, limit) {
                if (text.length > limit) {
                    return text.substring(0, limit) + '...';
                }
                return text;
            }

            function renderRestaurantResults(results) {
                var carouselInner = $('#restaurant-carousel-inner');
                var prevButton = $('.carousel-control-prev');
                var nextButton = $('.carousel-control-next');

                carouselInner.empty();

                if (results.length === 0) {
                    carouselInner.append(
                        '<div class="carousel-item active"><div class="row"><p>Restaurant not available</p></div></div>'
                    );
                    prevButton.hide();
                    nextButton.hide();
                } else {
                    var itemsPerSlide = 6; // Number of items per carousel slide
                    var numSlides = Math.ceil(results.length / itemsPerSlide);

                    prevButton.toggle(numSlides > 1);
                    nextButton.toggle(numSlides > 1);

                    for (var i = 0; i < numSlides; i++) {
                        var activeClass = i === 0 ? ' active' : '';
                        var slideHtml = `<div class="carousel-item${activeClass}"><div class="row">`;

                        for (var j = i * itemsPerSlide; j < (i + 1) * itemsPerSlide && j < results.length; j++) {
                            var result = results[j];
                            var imgSrc = result.img ? result.img : '{{ asset('images/dummy_image.webp') }}';
                            var title = result.title || 'Unknown Title';
                            var location = result.location || 'Unknown Location';
                            var rating = result.rating || '0';
                            var usersReczIt = result.usersReczIt;
                            title = truncateText(title, 13);
                            location = truncateText(location, 30);

                            var cardHtml = `
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card_img">
                                            <img class="card-main-img" src="${imgSrc}" alt="restaurant img">
                                            <span>${usersReczIt ? usersReczIt + " Users Recz It!" : ""}</span>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="card-title">${title}</h3>
                                            <h3 class="card-text">${location}</h3>
                                            <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">${rating}</span>
                                        </div>
                                    </div>
                                </div>
                            `;

                            slideHtml += cardHtml;
                        }

                        slideHtml += '</div></div>';
                        carouselInner.append(slideHtml);
                    }
                }
            }

            function renderPlaceResults(results) {
                var carouselInner = $('#place-carousel-inner');
                var prevButton = $('.carousel-control-prev');
                var nextButton = $('.carousel-control-next');

                carouselInner.empty();

                if (results.length === 0) {
                    carouselInner.append(
                        '<div class="carousel-item active"><div class="row"><p>Place not available</p></div></div>'
                    );
                    prevButton.hide();
                    nextButton.hide();
                } else {
                    var itemsPerSlide = 6; // Number of items per carousel slide
                    var numSlides = Math.ceil(results.length / itemsPerSlide);

                    prevButton.toggle(numSlides > 1);
                    nextButton.toggle(numSlides > 1);

                    for (var i = 0; i < numSlides; i++) {
                        var activeClass = i === 0 ? ' active' : '';
                        var slideHtml = `<div class="carousel-item${activeClass}"><div class="row">`;

                        for (var j = i * itemsPerSlide; j < (i + 1) * itemsPerSlide && j < results.length; j++) {
                            var result = results[j];
                            var imgSrc = result.img ? result.img : '{{ asset('images/dummy_image.webp') }}';
                            var name = result.name || 'Unknown Name';
                            var address = result.address || 'Unknown Address';
                            var rating = result.rating || '0';
                            var usersReczIt = result.usersReczIt;
                            name = truncateText(name, 13);
                            address = truncateText(address, 30);

                            var cardHtml = `
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card_img">
                                            <img class="card-main-img" src="${imgSrc}" alt="restaurant img">
                                            <span>${usersReczIt ? usersReczIt + " Users Recz It!" : ""}</span>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="card-title">${name}</h3>
                                            <h3 class="card-text">${address}</h3>
                                            <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">${rating}</span>
                                        </div>
                                    </div>
                                </div>
                            `;

                            slideHtml += cardHtml;
                        }

                        slideHtml += '</div></div>';
                        carouselInner.append(slideHtml);
                    }
                }
            }



            function renderSearchListResults(results) {
                var container = $('.filter_list .container');
                container.empty();

                var charLimit = 300;

                results.forEach(function(result) {
                    var imgSrc = result.img ? result.img : '{{ asset('images/dummy_image.webp') }}';
                    var lstReczItFrnd = result.lstReczItFrnd;
                    var firstName = lstReczItFrnd.length > 0 ? lstReczItFrnd[0].firstName : '';
                    var totalReczIt = result.totalReczIt;

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
                                            <a href="{{ route('search-detail') }}?id=${result.pid}&catID=${result.catID ? result.catID : ''}">
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
                                            <span class="start_bold">${result.totalReczIt}</span> people Recz it!</span>
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

            function toggleSections() {
                if ($('#restaurants').is(':checked')) {
                    $('.filter_restaurant').show();
                    $('.map_section').show();
                    $('.place_filter').show();
                    $('.filter_list').hide();
                } else if ($('#all').is(':checked')) {
                    $('.filter_restaurant').hide();
                    $('.map_section').hide();
                    $('.place_filter').hide();
                    $('.filter_list').show();
                } else {
                    $('.filter_restaurant').hide();
                    $('.map_section').hide();
                    $('.place_filter').hide();
                    $('.filter_list').show();
                }
            }

            toggleSections();

            $('.filter-checkbox').on('change', function() {
                $('.filter-checkbox').prop('checked', false);
                $(this).prop('checked', true);
                toggleSections();

                var searchText = $('#searchInput').val().trim();
                var selectedCatID = getSelectedCatID();
                performSearch(searchText, selectedCatID);
            });

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

                    if (catID === 3) {
                        // Geolocation for Restaurants
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(
                                function(position) {
                                    const lat = position.coords.latitude;
                                    const lon = position.coords.longitude;
                                    console.log(`Latitude: ${lat}, Longitude: ${lon}`);

                                    // Call restaurant-process API with geolocation data
                                    $.ajax({
                                        url: "{{ route('restaurant-process') }}",
                                        // url: "https://dev.therecz.com/restaurant-process",
                                        type: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': csrfToken,
                                            'Authorization': 'Bearer ' + token
                                        },
                                        data: {
                                            search_query: searchText,
                                            latitude: lat,
                                            longitude: lon
                                        },
                                        success: function(response) {
                                            if (response.success) {
                                                renderRestaurantResults(response.result);
                                            } else {
                                                console.error(
                                                    'No results found for restaurant-process');
                                            }
                                            hideLoader(); // Hide loader on success
                                        },
                                        error: function(xhr, status, error) {
                                            console.error('Error from restaurant-process:', error);
                                            hideLoader(); // Hide loader on error
                                        }
                                    });

                                    // Call place-process API with type 'restaurant'
                                    $.ajax({
                                        url: "{{ route('place-process') }}",
                                        // url: "https://dev.therecz.com/place-process",
                                        type: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': csrfToken,
                                            'Authorization': 'Bearer ' + token
                                        },
                                        data: {
                                            search_query: searchText,
                                            type: 'restaurant',
                                            catID: catID
                                        },
                                        success: function(response) {
                                            if (response.success) {
                                                renderPlaceResults(response.result);
                                            } else {
                                                console.error('No results found for place-process');
                                            }
                                            hideLoader(); // Hide loader on success
                                        },
                                        error: function(xhr, status, error) {
                                            console.error('Error from place-process:', error);
                                            hideLoader(); // Hide loader on error
                                        }
                                    });

                                },
                                function(error) {
                                    console.error("Error in retrieving location:", error.message);
                                    hideLoader(); // Hide loader if geolocation fails

                                    // If geolocation is not allowed, display the message "Restaurant is not available"
                                    if (error.code === error.PERMISSION_DENIED) {
                                        $('#restaurantStatus').text(
                                            'Location Permission Denied, Restaurant is not available.');

                                        // Only hit place-process API
                                        $.ajax({
                                            url: "{{ route('place-process') }}",
                                            // url: "https://dev.therecz.com/place-process",
                                            type: 'POST',
                                            headers: {
                                                'X-CSRF-TOKEN': csrfToken,
                                                'Authorization': 'Bearer ' + token
                                            },
                                            data: {
                                                search_query: searchText,
                                                type: 'restaurant',
                                                catID: catID
                                            },
                                            success: function(response) {
                                                if (response.success) {
                                                    renderPlaceResults(response.result);
                                                } else {
                                                    console.error(
                                                        'No results found for place-process');
                                                }
                                                hideLoader(); // Hide loader on success
                                            },
                                            error: function(xhr, status, error) {
                                                console.error('Error from place-process:', error);
                                                hideLoader(); // Hide loader on error
                                            }
                                        });
                                    }
                                }
                            );
                        } else {
                            console.log("Geolocation is not supported by this browser.");
                            hideLoader(); // Hide loader if geolocation is not supported
                        }

                    } else {
                        // Hit the search-list-process route for other categories
                        $.ajax({
                            url: "{{ route('search-list-process') }}",
                            // url: "https://dev.therecz.com/search-list-process",
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
                                if (response.success) {
                                    renderSearchListResults(response.result);
                                } else {
                                    console.error('No results found for search-list-process');
                                }
                                hideLoader(); // Hide loader on success
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                hideLoader(); // Hide loader on error
                            }
                        });
                    }
                } else {
                    console.log('Empty search input');
                    hideLoader(); // Hide loader if search input is empty
                }
            }

            function hideLoader() {
                $('#loaderOverlay').hide();
                $('#loader').hide();
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
                    case 'Music':
                        return 13; // CatID for Music
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

            function truncateText(text, limit) {
                if (text.length > limit) {
                    return text.substring(0, limit) + '...';
                }
                return text;
            }

            function renderRestaurantResults(results) {
                var carouselInner = $('#restaurant-carousel-inner');
                var prevButton = $('.carousel-control-prev');
                var nextButton = $('.carousel-control-next');

                carouselInner.empty();

                if (results.length === 0) {
                    carouselInner.append(
                        '<div class="carousel-item active"><div class="row"><p>Restaurant not available</p></div></div>'
                    );
                    prevButton.hide();
                    nextButton.hide();
                } else {
                    var itemsPerSlide = 6; // Number of items per carousel slide
                    var numSlides = Math.ceil(results.length / itemsPerSlide);

                    prevButton.toggle(numSlides > 1);
                    nextButton.toggle(numSlides > 1);

                    for (var i = 0; i < numSlides; i++) {
                        var activeClass = i === 0 ? ' active' : '';
                        var slideHtml = `<div class="carousel-item${activeClass}"><div class="row">`;

                        for (var j = i * itemsPerSlide; j < (i + 1) * itemsPerSlide && j < results.length; j++) {
                            var result = results[j];
                            var imgSrc = result.img ? result.img : '{{ asset('images/dummy_image.webp') }}';
                            var title = result.title || 'Unknown Title';
                            var location = result.location || 'Unknown Location';
                            var rating = result.rating || '0';
                            var usersReczIt = result.usersReczIt;
                            title = truncateText(title, 13);
                            location = truncateText(location, 30);

                            var cardHtml = `
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card_img">
                                            <img class="card-main-img" src="${imgSrc}" alt="restaurant img">
                                            <span>${usersReczIt ? usersReczIt + " Users Recz It!" : ""}</span>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="card-title">${title}</h3>
                                            <h3 class="card-text">${location}</h3>
                                            <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">${rating}</span>
                                        </div>
                                    </div>
                                </div>
                            `;

                            slideHtml += cardHtml;
                        }

                        slideHtml += '</div></div>';
                        carouselInner.append(slideHtml);
                    }
                }
            }

            function renderPlaceResults(results) {
                var carouselInner = $('#place-carousel-inner');
                var prevButton = $('.carousel-control-prev');
                var nextButton = $('.carousel-control-next');

                carouselInner.empty();

                if (results.length === 0) {
                    carouselInner.append(
                        '<div class="carousel-item active"><div class="row"><p>Place not available</p></div></div>'
                    );
                    prevButton.hide();
                    nextButton.hide();
                } else {
                    var itemsPerSlide = 6; // Number of items per carousel slide
                    var numSlides = Math.ceil(results.length / itemsPerSlide);

                    prevButton.toggle(numSlides > 1);
                    nextButton.toggle(numSlides > 1);

                    for (var i = 0; i < numSlides; i++) {
                        var activeClass = i === 0 ? ' active' : '';
                        var slideHtml = `<div class="carousel-item${activeClass}"><div class="row">`;

                        for (var j = i * itemsPerSlide; j < (i + 1) * itemsPerSlide && j < results.length; j++) {
                            var result = results[j];
                            var imgSrc = result.img ? result.img : '{{ asset('images/dummy_image.webp') }}';
                            var name = result.name || 'Unknown Name';
                            var address = result.address || 'Unknown Address';
                            var rating = result.rating || '0';
                            var usersReczIt = result.usersReczIt;
                            name = truncateText(name, 13);
                            address = truncateText(address, 30);

                            var cardHtml = `
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card_img">
                                            <img class="card-main-img" src="${imgSrc}" alt="restaurant img">
                                            <span>${usersReczIt ? usersReczIt + " Users Recz It!" : ""}</span>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="card-title">${name}</h3>
                                            <h3 class="card-text">${address}</h3>
                                            <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">${rating}</span>
                                        </div>
                                    </div>
                                </div>
                            `;

                            slideHtml += cardHtml;
                        }

                        slideHtml += '</div></div>';
                        carouselInner.append(slideHtml);
                    }
                }
            }



            function renderSearchListResults(results) {
                var container = $('.filter_list .container');
                container.empty();

                var charLimit = 300;

                results.forEach(function(result) {
                    var imgSrc = result.img ? result.img : '{{ asset('images/dummy_image.webp') }}';
                    var lstReczItFrnd = result.lstReczItFrnd;
                    var firstName = lstReczItFrnd.length > 0 ? lstReczItFrnd[0].firstName : '';
                    var totalReczIt = result.totalReczIt;

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
                                            <a href="{{ route('search-detail') }}?id=${result.pid}&catID=${result.catID ? result.catID : ''}">
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
                                            <span class="start_bold">${result.totalReczIt}</span> people Recz it!</span>
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

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_VSuTDsJ0fE33kZE66V2o71CUL8WEh_M"></script>

    <script>
        function initMap(locations) {
            const mapOptions = {
                zoom: 12,
                center: locations.length ? { lat: locations[0].latitude, lng: locations[0].longitude } : { lat: -34.397, lng: 150.644 }
            };
            const map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // Add markers to the map
            locations.forEach(location => {
                new google.maps.Marker({
                    position: { lat: location.latitude, lng: location.longitude },
                    map: map
                });
            });
        }
    </script>

    <script>
        $(document).ready(function() {

            function toggleSections() {
                if ($('#restaurants').is(':checked')) {
                    $('.filter_restaurant').show();
                    $('.map_section').show();
                    $('.place_filter').show();
                    $('.filter_list').hide();
                } else if ($('#all').is(':checked')) {
                    $('.filter_restaurant').hide();
                    $('.map_section').hide();
                    $('.place_filter').hide();
                    $('.filter_list').show();
                } else {
                    $('.filter_restaurant').hide();
                    $('.map_section').hide();
                    $('.place_filter').hide();
                    $('.filter_list').show();
                }
            }

            toggleSections();

            $('.filter-checkbox').on('change', function() {
                $('.filter-checkbox').prop('checked', false);
                $(this).prop('checked', true);
                toggleSections();

                var searchText = $('#searchInput').val().trim();
                var selectedCatID = getSelectedCatID();
                updateURL(searchText);
                performSearch(searchText, selectedCatID);
            });

            function updateURL(searchText) {
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('search_query', searchText);
                const newUrl = `${window.location.pathname}?${urlParams.toString()}`;
                window.history.pushState({ path: newUrl }, '', newUrl);
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

                    // $('#loaderOverlay').show();
                    showLoader();

                    if (catID === 3) {

                        // Geolocation for Restaurants
                        if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(
                                        function(position) {
                                            const lat = position.coords.latitude;
                                            const lon = position.coords.longitude;
                                            console.log(`Latitude: ${lat}, Longitude: ${lon}`);

                                            $.ajax({
                                                // url: "{{ route('restaurant-process') }}",
                                                url: "https://dev.therecz.com/restaurant-process",
                                                type: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': csrfToken,
                                                    'Authorization': 'Bearer ' + token
                                                },
                                                data: {
                                                    search_query: searchText,
                                                    latitude: lat,
                                                    longitude: lon
                                                },
                                                success: function(response) {
                                                    if (response.success) {
                                                        renderRestaurantResults(response.result);
                                                    } else {
                                                        console.error(
                                                            'No results found for restaurant-process');
                                                    }
                                                    hideLoader(); // Hide loader on success
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error('Error from restaurant-process:', error);
                                                    hideLoader(); // Hide loader on error
                                                }
                                            });

                                            $.ajax({
                                                // url: "{{ route('place-process') }}",
                                                url: "https://dev.therecz.com/place-process",
                                                type: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': csrfToken,
                                                    'Authorization': 'Bearer ' + token
                                                },
                                                data: {
                                                    search_query: searchText,
                                                    type: '',
                                                    catID: catID
                                                },
                                                success: function(response) {
                                                    if (response.success) {
                                                        renderPlaceResults(response.result);
                                                    } else {
                                                        console.error('No results found for place-process');
                                                    }
                                                    hideLoader(); // Hide loader on success
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error('Error from place-process:', error);
                                                    hideLoader(); // Hide loader on error
                                                }
                                            });

                                            // Call googleMapProcess
                                            $.ajax({
                                                // url: "{{ route('google-map-process') }}",
                                                url: "https://dev.therecz.com/google-map-process",
                                                type: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': csrfToken,
                                                    'Authorization': 'Bearer ' + token
                                                },
                                                data: {
                                                    search_query: searchText,
                                                    type: '',
                                                    skipCache: true
                                                },
                                                success: function(response) {
                                                    if (response.success) {
                                                        const locations = response.locations;
                                                        initMap(locations);
                                                        $('.map_section').show(); // Show the map section
                                                    } else {
                                                        console.error('No results found for google-map-process');
                                                    }
                                                    hideLoader(); // Hide loader on success
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error('Error from google-map-process:', error);
                                                    hideLoader(); // Hide loader on error
                                                }
                                            });

                                        },
                                        function(error) {
                                            console.error("Error in retrieving location:", error.message);
                                            hideLoader(); // Hide loader if geolocation fails

                                            // If geolocation is not allowed, display the message "Restaurant is not available"
                                            if (error.code === error.PERMISSION_DENIED) {
                                                $('#restaurantStatus').text(
                                                    'Location Permission Denied, Restaurant is not available.');

                                                $.ajax({
                                                    // url: "{{ route('place-process') }}",
                                                    url: "https://dev.therecz.com/place-process",
                                                    type: 'POST',
                                                    headers: {
                                                        'X-CSRF-TOKEN': csrfToken,
                                                        'Authorization': 'Bearer ' + token
                                                    },
                                                    data: {
                                                        search_query: searchText,
                                                        type: 'restaurant',
                                                        catID: catID
                                                    },
                                                    success: function(response) {
                                                        if (response.success) {
                                                            renderPlaceResults(response.result);
                                                        } else {
                                                            console.error(
                                                                'No results found for place-process');
                                                        }
                                                        hideLoader(); // Hide loader on success
                                                    },
                                                    error: function(xhr, status, error) {
                                                        console.error('Error from place-process:', error);
                                                        hideLoader(); // Hide loader on error
                                                    }
                                                });
                                            }
                                        }
                                    );
                                } else {
                                    console.log("Geolocation is not supported by this browser.");
                                    hideLoader(); // Hide loader if geolocation is not supported
                                }

                    } else {

                        $.ajax({
                            // url: "{{ route('search-list-process') }}",
                            url: "https://dev.therecz.com/search-list-process",
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
                                if (response.success) {
                                    renderSearchListResults(response.result);
                                } else {
                                    console.error('No results found for search-list-process');
                                }
                                hideLoader();
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
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
                var selectedCatID = getSelectedCatID();
                updateURL(searchText);
                performSearch(searchText, selectedCatID);
            });

            $('.search_icon').on('click', function(e) {
                e.preventDefault();
                var searchText = $('#searchInput').val().trim();
                $('#searchResultText').text(`Showing result for “${searchText}”`);
                var selectedCatID = getSelectedCatID();
                updateURL(searchText);
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
                    case 'Music':
                        return 13; // CatID for Music
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

            function truncateText(text, limit) {
                if (text.length > limit) {
                    return text.substring(0, limit) + '...';
                }
                return text;
            }

            function renderRestaurantResults(results) {
                var carouselInner = $('#restaurant-carousel-inner');
                var prevButton = $('.carousel-control-prev');
                var nextButton = $('.carousel-control-next');

                carouselInner.empty();

                if (results.length === 0) {
                    carouselInner.append(
                        '<div class="carousel-item active"><div class="row"><p>Restaurant not available</p></div></div>'
                    );
                    prevButton.hide();
                    nextButton.hide();
                } else {
                    var itemsPerSlide = 6; // Number of items per carousel slide
                    var numSlides = Math.ceil(results.length / itemsPerSlide);

                    prevButton.toggle(numSlides > 1);
                    nextButton.toggle(numSlides > 1);

                    for (var i = 0; i < numSlides; i++) {
                        var activeClass = i === 0 ? ' active' : '';
                        var slideHtml = `<div class="carousel-item${activeClass}"><div class="row">`;

                        for (var j = i * itemsPerSlide; j < (i + 1) * itemsPerSlide && j < results.length; j++) {
                            var result = results[j];
                            var imgSrc = result.img ? result.img : '{{ asset('images/dummy_image.webp') }}';
                            var title = result.title || 'Unknown Title';
                            var location = result.location || 'Unknown Location';
                            var rating = result.rating || '0';
                            var usersReczIt = result.usersReczIt;
                            title = truncateText(title, 13);
                            location = truncateText(location, 30);

                            var cardHtml = `
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card_img">
                                            <img class="card-main-img" src="${imgSrc}" alt="restaurant img">
                                            <span>${usersReczIt ? usersReczIt + " Users Recz It!" : ""}</span>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="card-title">${title}</h3>
                                            <h3 class="card-text">${location}</h3>
                                            <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">${rating}</span>
                                        </div>
                                    </div>
                                </div>
                            `;

                            slideHtml += cardHtml;
                        }

                        slideHtml += '</div></div>';
                        carouselInner.append(slideHtml);
                    }
                }
            }

            function renderPlaceResults(results) {
                var carouselInner = $('#place-carousel-inner');
                var prevButton = $('.carousel-control-prev');
                var nextButton = $('.carousel-control-next');

                carouselInner.empty();

                if (results.length === 0) {
                    carouselInner.append(
                        '<div class="carousel-item active"><div class="row"><p>Place not available</p></div></div>'
                    );
                    prevButton.hide();
                    nextButton.hide();
                } else {
                    var itemsPerSlide = 6; // Number of items per carousel slide
                    var numSlides = Math.ceil(results.length / itemsPerSlide);

                    prevButton.toggle(numSlides > 1);
                    nextButton.toggle(numSlides > 1);

                    for (var i = 0; i < numSlides; i++) {
                        var activeClass = i === 0 ? ' active' : '';
                        var slideHtml = `<div class="carousel-item${activeClass}"><div class="row">`;

                        for (var j = i * itemsPerSlide; j < (i + 1) * itemsPerSlide && j < results.length; j++) {
                            var result = results[j];
                            var imgSrc = result.img ? result.img : '{{ asset('images/dummy_image.webp') }}';
                            var name = result.name || 'Unknown Name';
                            var address = result.address || 'Unknown Address';
                            var rating = result.rating || '0';
                            var usersReczIt = result.usersReczIt;
                            name = truncateText(name, 13);
                            address = truncateText(address, 30);

                            var cardHtml = `
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card_img">
                                            <img class="card-main-img" src="${imgSrc}" alt="restaurant img">
                                            <span>${usersReczIt ? usersReczIt + " Users Recz It!" : ""}</span>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="card-title">${name}</h3>
                                            <h3 class="card-text">${address}</h3>
                                            <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">${rating}</span>
                                        </div>
                                    </div>
                                </div>
                            `;

                            slideHtml += cardHtml;
                        }

                        slideHtml += '</div></div>';
                        carouselInner.append(slideHtml);
                    }
                }
            }



            function renderSearchListResults(results) {
                var container = $('.filter_list .container');
                container.empty();

                var charLimit = 300;

                results.forEach(function(result) {
                    var imgSrc = result.img ? result.img : '{{ asset('images/dummy_image.webp') }}';
                    var lstReczItFrnd = result.lstReczItFrnd;
                    var firstName = lstReczItFrnd.length > 0 ? lstReczItFrnd[0].firstName : '';
                    var totalReczIt = result.totalReczIt;

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
                                            <a href="{{ route('search-detail') }}?id=${result.pid}&catID=${result.catID ? result.catID : ''}">
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
                                            <span class="start_bold">${result.totalReczIt}</span> people Recz it!</span>
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

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const resultSection = document.querySelector('.filter_resulted');
            const resultText = document.querySelector('.restaurant_result');

            searchInput.addEventListener('input', function() {
                const query = searchInput.value.trim();

                if (query) {
                    resultText.textContent = `“${query}”`;
                    resultSection.style.display = 'block'; // Show the result section
                } else {
                    resultSection.style.display = 'none'; // Hide the result section if input is empty
                }
            });
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const resultSection = document.querySelector('.filter_resulted');
            const resultText = document.querySelector('.restaurant_result');

            if (!searchInput) {
                console.error('Element with ID "searchInput" not found');
                return;
            }

            if (!resultSection) {
                console.error('Element with class "filter_resulted" not found');
                return;
            }

            if (!resultText) {
                console.error('Element with class "restaurant_result" not found');
                return;
            }

            searchInput.addEventListener('input', function() {
                const query = searchInput.value.trim();

                if (query) {
                    resultText.textContent = `“${query}”`;
                    resultSection.style.display = 'block'; // Show the result section
                } else {
                    resultSection.style.display = 'none'; // Hide the result section if input is empty
                }
            });
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

            setInterval(checkSession, 7200000);
        });
    </script>

    @if (session('popup_message'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Content not available',
                text: "{{ session('popup_message') }}",
                icon: 'info',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif
    @if (session('notfound_message'))
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: 'Content not available',
                text: "{{ session('notfound_message') }}",
                icon: 'info',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif

@endsection
