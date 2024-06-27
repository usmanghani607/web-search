@extends('layouts.chatgrid_frontend')

<style>
    .carousel-item.active,
    .carousel-item-next,
    .carousel-item-prev {
        display: flex;
    }

    .carousel-item {
        display: none;
        flex-wrap: wrap;
    }

    .carousel-inner {
        display: flex;
        flex-wrap: nowrap;
    }

    .carousel-control-next,
    .carousel-control-prev {
        width: 5%;
    }

    .card {
        margin: 0 15px;
    }
</style>

@section('content')
    <section class="chat_grid">
        <div class="container">
            <div class="chat_form_wp">
                <div class="row">
                    <div class="col-md-12">
                        <div class="question_wp">
                            <span><i class="fa-solid fa-user"></i></span>
                            <span>You</span>
                            <p>show me latest restaurants in Chicago open after 10pm</p>
                        </div>
                        <div class="answer_wp">
                            <span><i class="fa-solid fa-question"></i></span>
                            <span>Ask Recz</span>
                            <p>I can’t provide real-time information or browse the internet,
                                including the latest restaurant openings. However, I can suggest
                                some popular late-night dining spots in Chicago based on what was
                                known up to my last update:</p>
                        </div>
                        <div class="slide_heading">
                            <p>Latest restaurants in Chicago open after 10pm</p>
                        </div>
                        <div class="slider">

                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-img-top" src="{{ asset('/images/slide1.png') }}"
                                                        alt="Card image cap">
                                                    <div class="card-body">
                                                        <h3 class="card-title">312 Chicago</h3>
                                                        <h3 class="card-text">Jaran Street, Chicago</h3>
                                                        <span class="star_point"><img
                                                                src="{{ asset('/images/star_icon.png') }}"
                                                                alt="">4.5</span>
                                                        <span class="rating">1K Users Recz It!</span>
                                                        <p><span class="visiter">Karan</span> and <span class="visiter">31
                                                                others</span> visited</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-img-top" src="{{ asset('/images/slide2.png') }}"
                                                        alt="Card image cap">
                                                    <div class="card-body">
                                                        <h3 class="card-title">312 Chicago</h3>
                                                        <h3 class="card-text">Jaran Street, Chicago</h3>
                                                        <span class="star_point"><img
                                                                src="{{ asset('/images/star_icon.png') }}"
                                                                alt="">4.5</span>
                                                        <span class="rating">1K Users Recz It!</span>
                                                        <p><span class="visiter">Karan</span> and <span class="visiter">31
                                                                others</span> visited</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-img-top" src="{{ asset('/images/slide3.png') }}"
                                                        alt="Card image cap">
                                                    <div class="card-body">
                                                        <h3 class="card-title">312 Chicago</h3>
                                                        <h3 class="card-text">Jaran Street, Chicago</h3>
                                                        <span class="star_point"><img
                                                                src="{{ asset('/images/star_icon.png') }}"
                                                                alt="">4.5</span>
                                                        <span class="rating">1K Users Recz It!</span>
                                                        <p><span class="visiter">Karan</span> and <span class="visiter">31
                                                                others</span> visited</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-img-top" src="{{ asset('/images/slide3.png') }}"
                                                        alt="Card image cap">
                                                    <div class="card-body">
                                                        <h3 class="card-title">312 Chicago</h3>
                                                        <h3 class="card-text">Jaran Street, Chicago</h3>
                                                        <span class="star_point"><img
                                                                src="{{ asset('/images/star_icon.png') }}"
                                                                alt="">4.5</span>
                                                        <span class="rating">1K Users Recz It!</span>
                                                        <p><span class="visiter">Karan</span> and <span class="visiter">31
                                                                others</span> visited</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-img-top" src="{{ asset('/images/slide1.png') }}"
                                                        alt="Card image cap">
                                                    <div class="card-body">
                                                        <h3 class="card-title">312 Chicago</h3>
                                                        <h3 class="card-text">Jaran Street, Chicago</h3>
                                                        <span class="star_point"><img
                                                                src="{{ asset('/images/star_icon.png') }}"
                                                                alt="">4.5</span>
                                                        <span class="rating">1K Users Recz It!</span>
                                                        <p><span class="visiter">Karan</span> and <span class="visiter">31
                                                                others</span> visited</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-img-top" src="{{ asset('/images/slide2.png') }}"
                                                        alt="Card image cap">
                                                    <div class="card-body">
                                                        <h3 class="card-title">312 Chicago</h3>
                                                        <h3 class="card-text">Jaran Street, Chicago</h3>
                                                        <span class="star_point"><img
                                                                src="{{ asset('/images/star_icon.png') }}"
                                                                alt="">4.5</span>
                                                        <span class="rating">1K Users Recz It!</span>
                                                        <p><span class="visiter">Karan</span> and <span class="visiter">31
                                                                others</span> visited</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-img-top" src="{{ asset('/images/slide3.png') }}"
                                                        alt="Card image cap">
                                                    <div class="card-body">
                                                        <h3 class="card-title">312 Chicago</h3>
                                                        <h3 class="card-text">Jaran Street, Chicago</h3>
                                                        <span class="star_point"><img
                                                                src="{{ asset('/images/star_icon.png') }}"
                                                                alt="">4.5</span>
                                                        <span class="rating">1K Users Recz It!</span>
                                                        <p><span class="visiter">Karan</span> and <span class="visiter">31
                                                                others</span> visited</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-img-top" src="{{ asset('/images/slide3.png') }}"
                                                        alt="Card image cap">
                                                    <div class="card-body">
                                                        <h3 class="card-title">312 Chicago</h3>
                                                        <h3 class="card-text">Jaran Street, Chicago</h3>
                                                        <span class="star_point"><img
                                                                src="{{ asset('/images/star_icon.png') }}"
                                                                alt="">4.5</span>
                                                        <span class="rating">1K Users Recz It!</span>
                                                        <p><span class="visiter">Karan</span> and <span class="visiter">31
                                                                others</span> visited</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button> --}}
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
        </div>
    </section>
    <section class="chatgrid_footer">
        <div class="chat_foot">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form class="d-flex chat-container" role="search">
                            <input class="form-control" type="search" aria-label="Search" placeholder="Write here…">
                            <div class="send_icon">
                                <i class="fa-solid fa-paper-plane"></i>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
