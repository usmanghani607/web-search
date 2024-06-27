@extends('layouts.frontend')

@section('content')
    <section class="filter_result">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Showing result <span class="restaurant_result">“Restaurant in New York”</span></p>
                </div>
            </div>
        </div>
    </section>
    <section class="map_section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    {{-- <img src="{{ asset('images/map.png') }}" alt=""> --}}
                    <div style="width: 100%"><iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=350&amp;hl=en&amp;q=Restaurant%20in%20newyork+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/">gps systems</a></iframe></div>
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
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card">
                                <div class="card_img">
                                    <img class="card-main-img" src="{{ asset('images/restautant1.png') }}"
                                        alt="restaurant img">
                                    <img class="overlay-sec-img" src="{{ asset('images/top_img_2.png') }}" alt="Top Image">
                                    <img class="overlay-first-img" src="{{ asset('images/top_img.png') }}" alt="Top Image">
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
                                    <img class="overlay-sec-img" src="{{ asset('images/top_img_2.png') }}" alt="Top Image">
                                    <img class="overlay-first-img" src="{{ asset('images/top_img.png') }}" alt="Top Image">
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
                                    <img class="overlay-sec-img" src="{{ asset('images/top_img_2.png') }}" alt="Top Image">
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

@endsection
