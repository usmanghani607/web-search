@extends('layouts.frontend')
<?php
session_start();
?>
<style>
    .detail_page {
        display: none;
    }
</style>
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
                                <div class="right_btn">
                                    <a href="/login" class="btn">Sign in</a>
                                    <a href="#!" class="btn_red">Sign Up</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <section class="detail_page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="trailer_section">
                        <div class="container">
                            <div class="row">
                                <div id="carouselExampleControls" class="carousel slide movies_img" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @if (isset($result['lstMedia']) && count($result['lstMedia']) > 0)
                                            @foreach ($result['lstMedia'] as $index => $media)
                                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <img src="{{ $media['link'] }}" alt="...">
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="trailer_play">
                                                                        @if (isset($result['embed_link']))
                                                                            <iframe src="{{ $result['embed_link'] }}"
                                                                                title="{{ $result['linkTitle'] }}"
                                                                                frameborder="0"
                                                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                                                referrerpolicy="strict-origin-when-cross-origin"
                                                                                allowfullscreen></iframe>
                                                                        @else
                                                                            <p>Video not available.</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="carousel-item active">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <img src="{{ asset('images/dummy_image.webp') }}"
                                                            alt="No Image Available">
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="trailer_play">
                                                                    <p>Video not available.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    @if (isset($result['lstMedia']) && count($result['lstMedia']) > 1)
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                            <span><i class="fas fa-chevron-left"></i></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                            <span><i class="fas fa-chevron-right"></i></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="title_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title">
                                        <span class="name">
                                            @php
                                                $movieTitle = '';
                                                foreach ($result['lstMeta'] as $meta) {
                                                    if ($meta['metaID'] == 1) {
                                                        $movieTitle = $meta['value'];
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $movieTitle }}
                                        </span>
                                        <span class="fav_icon"><img src="{{ asset('images/favourit.png') }}"
                                                alt=""></span>
                                        <div class="star_sec">
                                            <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                                    alt="">{{ $result['rating'] }}</span>
                                            @php
                                                $ratingCount = $result['ratingCount'] ?? 0;
                                                $fullStars = (int) $ratingCount;
                                                $halfStar = $ratingCount - $fullStars >= 0.5 ? true : false;
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $fullStars)
                                                    <span><img src="{{ asset('images/red-star.png') }}"
                                                            alt=""></span>
                                                @elseif($i == $fullStars + 1 && $halfStar)
                                                    <span><img src="{{ asset('images/half-red.png') }}"
                                                            alt=""></span>
                                                @else
                                                    <span><img src="{{ asset('images/half-red.png') }}"
                                                            alt=""></span>
                                                @endif
                                            @endfor

                                            <span class="user_based">(Based on {{ $result['ratingCount'] }} users)</span>
                                        </div>
                                        <div class="people_like">
                                            <span class="people_img">
                                                @foreach ($result['lstRating'] as $index => $rating)
                                                    @if ($index < 2)
                                                        @if ($index == 0)
                                                            <img class="overlay-sec-img" src="{{ $rating['socialImg'] }}"
                                                                alt="{{ $rating['firstName'] }}">
                                                        @else
                                                            <img class="overlay-first-img" src="{{ $rating['socialImg'] }}"
                                                                alt="{{ $rating['firstName'] }}">
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </span>
                                            <span style="color: #000000">
                                                @if (isset($result['lstRating']) && count($result['lstRating']) > 0)
                                                    <span
                                                        class="start_bold">{{ $result['lstRating'][0]['firstName'] }}</span>
                                                    and {{ count($result['lstRating']) - 1 }}
                                                    <span class="start_bold">other</span> people Recz it!
                                                @else
                                                    <span class="start_bold">No one</span> Recz it yet!
                                                @endif
                                            </span>

                                            <span class="start_empty">
                                                <img src="{{ asset('images/start-empty.png') }}" alt="">
                                                <img src="{{ asset('images/start-empty.png') }}" alt="">
                                                <img src="{{ asset('images/start-empty.png') }}" alt="">
                                                <img src="{{ asset('images/start-empty.png') }}" alt="">
                                                <img src="{{ asset('images/start-empty.png') }}" alt="">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="about_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title">
                                        <div class="name">About the Movie</div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="icons">
                                                    <div><img src="{{ asset('images/time-icon.png') }}" alt="">
                                                    </div>
                                                    <div class="desc">
                                                        @php
                                                            $duration = isset($result['lstMeta'][3]['value'])
                                                                ? (int) $result['lstMeta'][3]['value']
                                                                : 0;
                                                            $hours = intdiv($duration, 60);
                                                            $minutes = $duration % 60;
                                                        @endphp
                                                        {{ $hours }}h {{ $minutes }}m
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="icons">
                                                    <div><img src="{{ asset('images/action.png') }}" alt="">
                                                    </div>
                                                    <div class="desc">
                                                        @php
                                                            $genre = '';
                                                            foreach ($result['lstMeta'] as $meta) {
                                                                if ($meta['metaID'] == 22) {
                                                                    $genre = $meta['value'];
                                                                    break;
                                                                }
                                                            }
                                                        @endphp
                                                        {{ $genre }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="icons">
                                                    <div><img src="{{ asset('images/date.png') }}" alt=""></div>
                                                    <div class="desc">
                                                        @php
                                                            $releaseDate = '';
                                                            foreach ($result['lstMeta'] as $meta) {
                                                                if ($meta['metaID'] == 51) {
                                                                    $releaseDate = date(
                                                                        'd M, Y',
                                                                        strtotime($meta['value']),
                                                                    );
                                                                    break;
                                                                }
                                                            }
                                                        @endphp
                                                        {{ $releaseDate }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="icons">
                                                    <div><img src="{{ asset('images/starts.png') }}" alt="">
                                                    </div>
                                                    <div class="desc">
                                                        @php
                                                            $rating = '';
                                                            foreach ($result['lstMeta'] as $meta) {
                                                                if ($meta['metaID'] == 52) {
                                                                    $rating = $meta['value'];
                                                                    break;
                                                                }
                                                            }
                                                        @endphp
                                                        {{ $rating }} / 10 ({{ $result['ratingCount'] }}K)
                                                    </div>
                                                    @if (!empty($result['dataSrc']))
                                                        <span class="imb">{{ $result['dataSrc'] }}</span>
                                                    @else
                                                        <span>{{ $result['dataSrc'] }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border"></div>

                                        {{-- <div class="cast_name">Cast</div>
                                        <div class="cast_img">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/cast1.png') }}" alt=""></div>
                                                    <div class="first_name">Shameik Moore</div>
                                                    <div class="sec_name">Miles Morales</div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/cast2.png') }}" alt=""></div>
                                                    <div class="first_name">Hailee Steinfeld</div>
                                                    <div class="sec_name">Gwen Stacy</div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/cast3.png') }}" alt=""></div>
                                                    <div class="first_name">Brian Tyree Henry</div>
                                                    <div class="sec_name">Jeff Morales</div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/cast1.png') }}" alt=""></div>
                                                    <div class="first_name">Luna</div>
                                                    <div class="sec_name">Gwen Stacy</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border"></div> --}}

                                        <div class="summary_name">Summary</div>
                                        <div class="summary_des">
                                            @php
                                                $description = '';
                                                if (isset($result['lstMeta']) && is_array($result['lstMeta'])) {
                                                    foreach ($result['lstMeta'] as $meta) {
                                                        if ($meta['metaID'] == 53 && !empty($meta['value'])) {
                                                            $description = $meta['value'];
                                                            break;
                                                        }
                                                    }
                                                } else {
                                                    $description = 'Summary is not available.';
                                                }
                                            @endphp
                                            <p>{{ $description }}</p>
                                        </div>

                                        <div class="border"></div>

                                        {{-- <div class="video_name">Videos</div>
                                        <div class="video_links">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <iframe
                                                        src="https://www.youtube.com/embed/t06RUxPbp_c?si=zA2I6c1hud8SkUn5"
                                                        title="YouTube video player" frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                        referrerpolicy="strict-origin-when-cross-origin"
                                                        allowfullscreen></iframe>
                                                </div>
                                                <div class="col-md-4">
                                                    <iframe
                                                        src="https://www.youtube.com/embed/t06RUxPbp_c?si=zA2I6c1hud8SkUn5"
                                                        title="YouTube video player" frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                        referrerpolicy="strict-origin-when-cross-origin"
                                                        allowfullscreen></iframe>
                                                </div>
                                                <div class="col-md-4">
                                                    <iframe
                                                        src="https://www.youtube.com/embed/t06RUxPbp_c?si=zA2I6c1hud8SkUn5"
                                                        title="YouTube video player" frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                        referrerpolicy="strict-origin-when-cross-origin"
                                                        allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border"></div> --}}

                                        <div class="comments_name">Comments</div>
                                        @if (isset($comments) && count($comments) > 0)
                                            @foreach ($comments as $comment)
                                                <div class="comment_area">
                                                    <span><img src="{{ $comment['socialImg'] }}"
                                                            alt="{{ $comment['firstName'] }}"></span>
                                                    <span class="comment">{{ $comment['firstName'] }}
                                                        {{ $comment['lastName'] }}</span>
                                                    <p>{{ $comment['msg'] }}</p>
                                                    @if (isset($comment['createdOn']))
                                                        <p class="comment_date">
                                                            {{ date('d M Y', strtotime($comment['createdOn'])) }}</p>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <span>No comments available</span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="more_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title">
                                        <div class="like_name">More like this</div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-main-img" src="{{ asset('images/movie1.png') }}"
                                                        alt="restaurant img">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Harry Potter: The Complet…</h5>
                                                        <span class="star_point"><img
                                                                src="{{ asset('images/star_icon.png') }}"
                                                                alt="">4.0</span>
                                                        <span class="rating">425 Users Recz It!</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-main-img" src="{{ asset('images/movie.png') }}"
                                                        alt="restaurant img">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Harry Potter and the Philo…</h5>
                                                        <span class="star_point"><img
                                                                src="{{ asset('images/star_icon.png') }}"
                                                                alt="">4.0</span>
                                                        <span class="rating">425 Users Recz It!</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-main-img" src="{{ asset('images/movie2.png') }}"
                                                        alt="restaurant img">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Harry Potter and the Cha…</h5>
                                                        <span class="star_point"><img
                                                                src="{{ asset('images/star_icon.png') }}"
                                                                alt="">4.0</span>
                                                        <span class="rating">425 Users Recz It!</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-main-img" src="{{ asset('images/movie3.png') }}"
                                                        alt="restaurant img">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Harry Potter and the Pris…</h5>
                                                        <span class="star_point"><img
                                                                src="{{ asset('images/star_icon.png') }}"
                                                                alt="">4.0</span>
                                                        <span class="rating">425 Users Recz It!</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="detail_page books">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="trailer_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="carouselExampleControls" class="carousel slide movies_img"
                                        data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @if (isset($result['lstMedia']) && count($result['lstMedia']) > 0)
                                                @foreach ($result['lstMedia'] as $index => $media)
                                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                        <div class="row">
                                                            <img src="{{ $media['link'] }}" alt="...">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="carousel-item active">
                                                    <div class="row">
                                                        <img src="{{ asset('images/dummy_image.webp') }}"
                                                            alt="No Image Available">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        @if (isset($result['lstMedia']) && count($result['lstMedia']) > 1)
                                            <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                                <span><i class="fas fa-chevron-left"></i></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                                <span><i class="fas fa-chevron-right"></i></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="title_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title">
                                        <span class="name">
                                            @php
                                                $bookTitle = '';
                                                foreach ($result['lstMeta'] as $meta) {
                                                    if ($meta['metaID'] == 16) {
                                                        $bookTitle = $meta['value'];
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $bookTitle }}
                                        </span>
                                        <span class="fav_icon"><img src="{{ asset('images/favourit.png') }}"
                                                alt=""></span>
                                        <div class="star_sec">
                                            <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                                    alt="">{{ $result['rating'] }}</span>
                                            @php
                                                $ratingCount = $result['ratingCount'] ?? 0;
                                                $fullStars = (int) $ratingCount;
                                                $halfStar = $ratingCount - $fullStars >= 0.5 ? true : false;
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $fullStars)
                                                    <span><img src="{{ asset('images/red-star.png') }}"
                                                            alt=""></span>
                                                @elseif($i == $fullStars + 1 && $halfStar)
                                                    <span><img src="{{ asset('images/half-red.png') }}"
                                                            alt=""></span>
                                                @else
                                                    <span><img src="{{ asset('images/half-red.png') }}"
                                                            alt=""></span>
                                                @endif
                                            @endfor

                                            <span class="user_based">(Based on {{ $result['ratingCount'] }} users)</span>
                                        </div>
                                        <div class="people_like">

                                            <span class="people_img">
                                                @foreach ($result['lstRating'] as $index => $rating)
                                                    @if ($index < 2)
                                                        @if ($index == 0)
                                                            <img class="overlay-sec-img" src="{{ $rating['socialImg'] }}"
                                                                alt="{{ $rating['firstName'] }}">
                                                        @else
                                                            <img class="overlay-first-img"
                                                                src="{{ $rating['socialImg'] }}"
                                                                alt="{{ $rating['firstName'] }}">
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </span>
                                            <span style="color: #000000">
                                                @if (isset($result['lstRating']) && count($result['lstRating']) > 0)
                                                    <span
                                                        class="start_bold">{{ $result['lstRating'][0]['firstName'] }}</span>
                                                    and {{ count($result['lstRating']) - 1 }}
                                                    <span class="start_bold">other</span> people Recz it!
                                                @else
                                                    <span class="start_bold">No one</span> Recz it yet!
                                                @endif
                                            </span>
                                            <span class="start_empty">
                                                <img src="{{ asset('images/start-empty.png') }}" alt="">
                                                <img src="{{ asset('images/start-empty.png') }}" alt="">
                                                <img src="{{ asset('images/start-empty.png') }}" alt="">
                                                <img src="{{ asset('images/start-empty.png') }}" alt="">
                                                <img src="{{ asset('images/start-empty.png') }}" alt="">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="about_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title">
                                        <div class="name">About Book</div>
                                        @php
                                            // Mapping metaID to book detail fields
                                            $bookDetailMapping = [
                                                16 => 'Title',
                                                26 => 'Author',
                                                15 => 'Edition',
                                                27 => 'Publisher',
                                                28 => 'Binding',
                                                29 => 'Language',
                                                30 => 'Pages',
                                            ];

                                            // Initialize book details with default empty values
                                            $bookDetails = [
                                                'Title' => '',
                                                'Author' => '',
                                                'Publisher' => '',
                                                'Edition' => '',
                                                'Binding' => '',
                                                'Language' => '',
                                                'Pages' => '',
                                            ];

                                            // Extract values based on metaID
                                            foreach ($result['lstMeta'] as $meta) {
                                                if (isset($bookDetailMapping[$meta['metaID']])) {
                                                    $bookDetails[$bookDetailMapping[$meta['metaID']]] = $meta['value'];
                                                }
                                            }
                                        @endphp

                                        <div class="row">
                                            @foreach ($bookDetails as $detail => $value)
                                                @if ($value)
                                                    <div class="book_detail">
                                                        <span>{{ $detail }} -</span>
                                                        <span>{{ $value }}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        <div class="border"></div>

                                        {{-- <div class="summary_name">Description</div>
                                        <div class="summary_des">
                                            <p>People think that when you want to change your life, you need to think big.
                                                But world-renowned habits expert James Clear has discovered another way.
                                                He knows that real change comes from the compound effect of hundreds of
                                                small decisions:
                                                doing two <br>push-ups a day, waking up five minutes early, or holding a
                                                single short phone call.
                                                <br>
                                                <br>
                                                He calls them atomic habits. <br><br>In this ground-breaking book,
                                                Clears reveals exactly how these minuscule changes can grow into such
                                                life-altering outcomes.
                                                He uncovers a handful of simple life hacks (the forgotten art of Habit
                                                Stacking,
                                                the unexpected power of the Two Minute Rule, or the trick to entering the
                                                Goldilocks Zone),
                                                and delves into cutting-edge psychology and neuroscience to explain why they
                                                matter.
                                                Along the way, he tells inspiring stories of Olympic gold medalists, leading
                                                CEOs, and
                                                distinguished scientists who have used the science of tiny habits to stay
                                                productive,
                                                motivated, and happy. <br><br>These small changes will have a revolutionary
                                                effect on your career,
                                                your relationships, and your life.
                                            </p>
                                        </div>
                                        <div class="border"></div> --}}

                                        <div class="comments_name">Comments</div>
                                        @if (isset($comments) && count($comments) > 0)
                                            @foreach ($comments as $comment)
                                                <div class="comment_area">
                                                    <span><img src="{{ $comment['socialImg'] }}"
                                                            alt="{{ $comment['firstName'] }}"></span>
                                                    <span class="comment">{{ $comment['firstName'] }}
                                                        {{ $comment['lastName'] }}</span>
                                                    <p>{{ $comment['msg'] }}</p>
                                                    @if (isset($comment['createdOn']))
                                                        <p class="comment_date">
                                                            {{ date('d M Y', strtotime($comment['createdOn'])) }}</p>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <span>No comments available</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="more_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title">
                                        <div class="like_name">More like this</div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-main-img" src="{{ asset('images/movie1.png') }}"
                                                        alt="restaurant img">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Harry Potter: The Complet…</h5>
                                                        <span class="star_point"><img
                                                                src="{{ asset('images/star_icon.png') }}"
                                                                alt="">4.0</span>
                                                        <span class="rating">425 Users Recz It!</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-main-img" src="{{ asset('images/movie.png') }}"
                                                        alt="restaurant img">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Harry Potter and the Philo…</h5>
                                                        <span class="star_point"><img
                                                                src="{{ asset('images/star_icon.png') }}"
                                                                alt="">4.0</span>
                                                        <span class="rating">425 Users Recz It!</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-main-img" src="{{ asset('images/movie2.png') }}"
                                                        alt="restaurant img">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Harry Potter and the Cha…</h5>
                                                        <span class="star_point"><img
                                                                src="{{ asset('images/star_icon.png') }}"
                                                                alt="">4.0</span>
                                                        <span class="rating">425 Users Recz It!</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-main-img" src="{{ asset('images/movie3.png') }}"
                                                        alt="restaurant img">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Harry Potter and the Pris…</h5>
                                                        <span class="star_point"><img
                                                                src="{{ asset('images/star_icon.png') }}"
                                                                alt="">4.0</span>
                                                        <span class="rating">425 Users Recz It!</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="more_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title">
                                        <div class="like_name">More like this</div>
                                        <div id="more-like-this" class="row">
                                            @foreach ($suggestions as $post)
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <img class="card-main-img" src="{{ $post['image'] }}" alt="{{ $post['title'] }} img">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $post['title'] }}</h5>
                                                            <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">{{ $post['rating'] }}</span>
                                                            <span class="rating">{{ $post['ratingCount'] }} Users Recz It!</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        </div>
    </section>

    <section class="detail_page song">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="trailer_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="carouselExampleControls" class="carousel slide movies_img"
                                        data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="{{ asset('images/song.png') }}" class="d-block w-100"
                                                    alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{ asset('images/song.png') }}" class="d-block w-100"
                                                    alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{ asset('images/song.png') }}" class="d-block w-100"
                                                    alt="...">
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                            <span><i class="fas fa-chevron-left"></i></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                            <span><i class="fas fa-chevron-right"></i></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="title_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title">
                                        <span class="name">Girls Like You</span>
                                        <span class="fav_icon"><img src="{{ asset('images/favourit.png') }}"
                                                alt=""></span>
                                        <div class="star_sec">
                                            <span class="star_point"><img src="{{ asset('images/star_icon.png') }}"
                                                    alt="">4.5</span>
                                            <span><img src="{{ asset('images/red-star.png') }}" alt=""></span>
                                            <span><img src="{{ asset('images/red-star.png') }}" alt=""></span>
                                            <span><img src="{{ asset('images/red-star.png') }}" alt=""></span>
                                            <span><img src="{{ asset('images/red-star.png') }}" alt=""></span>
                                            <span><img src="{{ asset('images/half-red.png') }}" alt=""></span>
                                            <span class="user_based">(Based on 328 users)</span>
                                        </div>
                                        <div class="people_like">

                                            <span class="people_img">
                                                <img class="overlay-sec-img" src="{{ asset('images/top_img_2.png') }}"
                                                    alt="Top Image">
                                                <img class="overlay-first-img" src="{{ asset('images/top_img.png') }}"
                                                    alt="Top Image">
                                            </span>
                                            <span style="color: #000000"><span class="start_bold">Ranga</span> and
                                                327 <span class="start_bold">other</span> people Recz it!</span>
                                            <span class="start_empty">
                                                <img src="{{ asset('images/start-empty.png') }}" alt="">
                                                <img src="{{ asset('images/start-empty.png') }}" alt="">
                                                <img src="{{ asset('images/start-empty.png') }}" alt="">
                                                <img src="{{ asset('images/start-empty.png') }}" alt="">
                                                <img src="{{ asset('images/start-empty.png') }}" alt="">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="about_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title">
                                        <div class="name">About Song</div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="icons">
                                                    <div><img src="{{ asset('images/time-icon.png') }}" alt="">
                                                    </div>
                                                    <div class="desc">03:56</div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="icons">
                                                    <div><img src="{{ asset('images/action.png') }}" alt="">
                                                    </div>
                                                    <div class="desc">English</div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="icons">
                                                    <div><img src="{{ asset('images/date.png') }}" alt=""></div>
                                                    <div class="desc">May 30, 2018</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border"></div>


                                        <div class="cast_name">Song Artists</div>
                                        <div class="cast_img">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/song1.png') }}" alt="">
                                                    </div>
                                                    <div class="first_name">Maroon 5</div>
                                                    <div class="sec_name">Singer</div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/song2.png') }}" alt="">
                                                    </div>
                                                    <div class="first_name">Cardi B</div>
                                                    <div class="sec_name">Singer</div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/song2.png') }}" alt="">
                                                    </div>
                                                    <div class="first_name">Cardi B</div>
                                                    <div class="sec_name">Singer</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border"></div>

                                        <div class="summary_name">Description</div>
                                        <div class="summary_des">
                                            <p>Sing along the lyrics of Girls Like You Song from Girls Like You album.
                                                Girls Like You Song from the Girls Like You album is voiced by famous singer
                                                Maroon 5, Cardi B.
                                                The lyrics of Girls Like You Song from Girls Like You album are written by
                                            </p>
                                        </div>
                                        <div class="border"></div>

                                        <div class="comments_name">Comments</div>
                                        <div class="comment_area">
                                            <span><img src="{{ asset('images/top_img.png') }}" alt=""></span>
                                            <span class="comment">Ranga</span>
                                            <p>It’s honestly absurd how good the “Spider-Verse” movies are. “Across the
                                                Spider-Verse”
                                                is just as great, if not better than “Into the Spider-Verse”. I really don’t
                                                know how.
                                                “Spider-Man: Across the Spider-Verse” is fantastic! Deftly juggles deeply
                                                heartfelt
                                                character beats with crazy multiverse content, just packed with so many
                                                delightful easter eggs.
                                                Loved how Gwen’s story is expanded, her scenes with Shea Whigham’s
                                                Captain Stacy are truly special.</p>
                                            <p class="comment_date">31 May 2023</p>
                                        </div>

                                        <div class="comment_area">
                                            <span><img src="{{ asset('images/top_img.png') }}" alt=""></span>
                                            <span class="comment">Ranga</span>
                                            <p>It’s honestly absurd how good the “Spider-Verse” movies are. “Across the
                                                Spider-Verse”
                                                is just as great, if not better than “Into the Spider-Verse”. I really don’t
                                                know how.
                                                “Spider-Man: Across the Spider-Verse” is fantastic! Deftly juggles deeply
                                                heartfelt
                                                character beats with crazy multiverse content, just packed with so many
                                                delightful easter eggs.
                                                Loved how Gwen’s story is expanded, her scenes with Shea Whigham’s
                                                Captain Stacy are truly special.</p>
                                            <p class="comment_date">31 May 2023</p>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="more_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title">
                                        <div class="like_name">More like this</div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-main-img" src="{{ asset('images/movie1.png') }}"
                                                        alt="restaurant img">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Harry Potter: The Complet…</h5>
                                                        <span class="star_point"><img
                                                                src="{{ asset('images/star_icon.png') }}"
                                                                alt="">4.0</span>
                                                        <span class="rating">425 Users Recz It!</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-main-img" src="{{ asset('images/movie.png') }}"
                                                        alt="restaurant img">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Harry Potter and the Philo…</h5>
                                                        <span class="star_point"><img
                                                                src="{{ asset('images/star_icon.png') }}"
                                                                alt="">4.0</span>
                                                        <span class="rating">425 Users Recz It!</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-main-img" src="{{ asset('images/movie2.png') }}"
                                                        alt="restaurant img">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Harry Potter and the Cha…</h5>
                                                        <span class="star_point"><img
                                                                src="{{ asset('images/star_icon.png') }}"
                                                                alt="">4.0</span>
                                                        <span class="rating">425 Users Recz It!</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-main-img" src="{{ asset('images/movie3.png') }}"
                                                        alt="restaurant img">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Harry Potter and the Pris…</h5>
                                                        <span class="star_point"><img
                                                                src="{{ asset('images/star_icon.png') }}"
                                                                alt="">4.0</span>
                                                        <span class="rating">425 Users Recz It!</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        function getQueryParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        var catID = parseInt(getQueryParameter('catID'), 10);

        var moviesPage = document.querySelector('.detail_page');
        var booksPage = document.querySelector('.detail_page.books');
        var webSeriesPage = document.querySelector('.detail_page.song');

        function showSection(catID) {
            moviesPage.style.display = 'none';
            booksPage.style.display = 'none';
            webSeriesPage.style.display = 'none';

            if (catID === 1) {
                moviesPage.style.display = 'block';
            } else if (catID === 8) {
                booksPage.style.display = 'block';
            } else if (catID === 2) {
                webSeriesPage.style.display = 'block';
            }
        }

        showSection(catID);
    });
</script>
