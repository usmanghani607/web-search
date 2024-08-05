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
                            <div class="profile_btn">
                                <div class="col">
                                    <div class="right_btn">
                                        <a href="/login" class="btn">Sign in</a>
                                        <a href="#!" class="btn_red">Sign Up</a>
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
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close" style="height: 0">
                    <div data-bs-dismiss="modal" aria-label="Close">
                        <img class="cross-icon" src="{{ asset('images/cross.png') }}" alt="">
                    </div>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Image" class="img-fluid">
                </div>
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
                                <div id="carouselMoviesControls" class="carousel slide movies_img" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @if (isset($result['lstMedia']) && count($result['lstMedia']) > 0)
                                            @foreach ($result['lstMedia'] as $index => $media)
                                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <button type="button" class="btn" data-bs-toggle="modal"
                                                                data-bs-target="#detailModal"
                                                                onclick="showImageInModal('{{ $media['link'] }}')">
                                                                <img src="{{ $media['link'] }}" alt="...">
                                                            </button>
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
                                            data-bs-target="#carouselMoviesControls" data-bs-slide="prev">
                                            <span><i class="fas fa-chevron-left"></i></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselMoviesControls" data-bs-slide="next">
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
                                        <span class="fav_icon"><a href="" data-bs-toggle="modal"
                                            data-bs-target="#starModal"><img src="{{ asset('images/favourit.png') }}"
                                                alt=""></a></span>
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
                                                    <span class="red_star"><a href="" data-bs-toggle="modal"
                                                        data-bs-target="#starModal"><img src="{{ asset('images/red-star.png') }}"
                                                            alt=""></a></span>
                                                @elseif($i == $fullStars + 1 && $halfStar)
                                                    <span class="red_star"><a href="" data-bs-toggle="modal"
                                                        data-bs-target="#starModal"><img src="{{ asset('images/half-red.png') }}"
                                                            alt=""></a></span>
                                                @else
                                                    <span class="red_star"><a href="" data-bs-toggle="modal"
                                                        data-bs-target="#starModal"><img src="{{ asset('images/half-red.png') }}"
                                                            alt=""></a></span>
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
                                            {{-- <span style="color: #000000">
                                                @if (isset($result['lstRating']) && count($result['lstRating']) > 0)
                                                    <span
                                                        class="start_bold">{{ $result['lstRating'][0]['firstName'] }}</span>
                                                    and {{ count($result['lstRating']) - 1 }}
                                                    <span class="start_bold">other</span> people Recz it!
                                                @else
                                                    <span class="start_bold">No one</span> Recz it yet!
                                                @endif
                                            </span> --}}

                                            <span style="color: #000000">
                                                @if (isset($result['lstRating']) && count($result['lstRating']) > 0)
                                                    @if (count($result['lstRating']) == 1)
                                                        <span
                                                            class="start_bold">{{ $result['lstRating'][0]['firstName'] }}</span>
                                                        Recz it!
                                                    @else
                                                        <span
                                                            class="start_bold">{{ $result['lstRating'][0]['firstName'] }}</span>
                                                        and {{ count($result['lstRating']) - 1 }}
                                                        <span class="start_bold">other</span> people Recz it!
                                                    @endif
                                                @else
                                                    <span class="start_bold">No one</span> Recz it yet!
                                                @endif
                                            </span>


                                            <span class="start_empty">
                                                <a href="" data-bs-toggle="modal"
                                            data-bs-target="#starModal"><img src="{{ asset('images/start-empty.png') }}" alt=""></a>
                                            <a href="" data-bs-toggle="modal"
                                            data-bs-target="#starModal"><img src="{{ asset('images/start-empty.png') }}" alt=""></a>
                                            <a href="" data-bs-toggle="modal"
                                            data-bs-target="#starModal"><img src="{{ asset('images/start-empty.png') }}" alt=""></a>
                                            <a href="" data-bs-toggle="modal"
                                            data-bs-target="#starModal"><img src="{{ asset('images/start-empty.png') }}" alt=""></a>
                                            <a href="" data-bs-toggle="modal"
                                            data-bs-target="#starModal"><img src="{{ asset('images/start-empty.png') }}" alt=""></a>
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
                                        <div class="name">About Movie</div>
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
                                            @if (!empty($similarPosts))
                                                @foreach ($similarPosts as $post)
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <a
                                                                href="{{ route('search-detail', ['id' => $post['pid'], 'catID' => $post['catID'] ?? '']) }}">
                                                                <img class="card-main-img" src="{{ $post['img'] }}"
                                                                    alt="{{ $post['title'] }}">
                                                            </a>
                                                            <div class="card-body">
                                                                <h5 class="card-title">
                                                                    {{ Str::limit($post['title'], 20) }}</h5>
                                                                <span class="star_point">
                                                                    <img src="{{ asset('images/star_icon.png') }}"
                                                                        alt=""> {{ $post['rating'] }}
                                                                </span>
                                                                <span class="rating">{{ $post['totalReczIt'] }} Users Recz
                                                                    It!</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-md-12">
                                                    <p>No similar posts found.</p>
                                                </div>
                                            @endif
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
                                    <div id="carouselBooksControls" class="carousel slide movies_img"
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
                                                data-bs-target="#carouselBooksControls" data-bs-slide="prev">
                                                <span><i class="fas fa-chevron-left"></i></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselBooksControls" data-bs-slide="next">
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
                                            @if (!empty($similarPosts))
                                                @foreach ($similarPosts as $post)
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <a
                                                                href="{{ route('search-detail', ['id' => $post['pid'], 'catID' => $post['catID'] ?? '']) }}">
                                                                <img class="card-main-img" src="{{ $post['img'] }}"
                                                                    alt="{{ $post['title'] }}">
                                                            </a>
                                                            <div class="card-body">
                                                                <h5 class="card-title">
                                                                    {{ Str::limit($post['title'], 20) }}</h5>
                                                                <span class="star_point">
                                                                    <img src="{{ asset('images/star_icon.png') }}"
                                                                        alt=""> {{ $post['rating'] }}
                                                                </span>
                                                                <span class="rating">{{ $post['totalReczIt'] }} Users Recz
                                                                    It!</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-md-12">
                                                    <p>No similar posts found.</p>
                                                </div>
                                            @endif
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

    <section class="detail_page restaurants">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    {{-- <div class="trailer_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        @if (count($result['lstMedia']) > 0)
                                            <div class="col-md-8">
                                                <img class="full_img"
                                                    src="{{ $result['lstMedia'][0]['link'] ?? asset('images/dummy_image.webp') }}"
                                                    alt="">
                                            </div>
                                        @else
                                            <div class="col-md-8">
                                                <img class="full_img" src="{{ asset('images/dummy_image.webp') }}"
                                                    alt="Dummy Image">
                                            </div>
                                        @endif
                                        <div class="col-md-4">
                                            @if (count($result['lstMedia']) > 1)
                                                <img class="first_img"
                                                    src="{{ $result['lstMedia'][1]['link'] ?? asset('images/dummy_image.webp') }}"
                                                    alt="">
                                            @else
                                                <img class="first_img" src="{{ asset('images/dummy_image.webp') }}"
                                                    alt="Dummy Image">
                                            @endif
                                            @if (count($result['lstMedia']) > 2)
                                                <p><img class="secnd_img"
                                                        src="{{ $result['lstMedia'][2]['link'] ?? asset('images/dummy_image.webp') }}"
                                                        alt=""></p>
                                            @else
                                                <p><img class="secnd_img" src="{{ asset('images/dummy_image.webp') }}"
                                                        alt="Dummy Image"></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    @if (isset($result['lstMedia']) && count($result['lstMedia']) < 3)
                        <div class="trailer_section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="carouselRestControls" class="carousel slide movies_img"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @if (count($result['lstMedia']) > 0)
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

                                            @if (count($result['lstMedia']) > 1)
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carouselRestControls" data-bs-slide="prev">
                                                    <span><i class="fas fa-chevron-left"></i></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carouselRestControls" data-bs-slide="next">
                                                    <span><i class="fas fa-chevron-right"></i></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="trailer_section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            @if (count($result['lstMedia']) > 0)
                                                <div class="col-md-8">
                                                    <img class="full_img"
                                                        src="{{ $result['lstMedia'][0]['link'] ?? asset('images/dummy_image.webp') }}"
                                                        alt="">
                                                </div>
                                            @else
                                                <div class="col-md-8">
                                                    <img class="full_img" src="{{ asset('images/dummy_image.webp') }}"
                                                        alt="Dummy Image">
                                                </div>
                                            @endif
                                            <div class="col-md-4">
                                                @if (count($result['lstMedia']) > 1)
                                                    <img class="first_img"
                                                        src="{{ $result['lstMedia'][1]['link'] ?? asset('images/dummy_image.webp') }}"
                                                        alt="">
                                                @else
                                                    <img class="first_img" src="{{ asset('images/dummy_image.webp') }}"
                                                        alt="Dummy Image">
                                                @endif
                                                @if (count($result['lstMedia']) > 2)
                                                    <p><img class="secnd_img"
                                                            src="{{ $result['lstMedia'][2]['link'] ?? asset('images/dummy_image.webp') }}"
                                                            alt=""></p>
                                                @else
                                                    <p><img class="secnd_img"
                                                            src="{{ asset('images/dummy_image.webp') }}"
                                                            alt="Dummy Image"></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                    <div class="title_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title">
                                        <span class="name">
                                            @php
                                                $restaurantTitle = '';
                                                foreach ($result['lstMeta'] as $meta) {
                                                    if ($meta['metaID'] == 5) {
                                                        $restaurantTitle = $meta['value'];
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $restaurantTitle }}
                                        </span>
                                        <span class="fav_icon"><img src="{{ asset('images/favourit.png') }}"
                                                alt=""></span>
                                        <div class="location">
                                            <span>{{ isset($result['location']) && !empty($result['location']) ? $result['location'] : 'No location available' }}
                                            </span>
                                        </div>
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
                                                            <img class="overlay-sec-img"
                                                                src="{{ $rating['socialImg'] }}"
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
                                        <div class="name">Cuisine</div>
                                        <div class="row">
                                            <div class="rest_loc">
                                                @php
                                                    $restaurantCuisine = '';
                                                    foreach ($result['lstMeta'] as $meta) {
                                                        if ($meta['metaID'] == 28) {
                                                            $restaurantCuisine = $meta['value'];
                                                            break;
                                                        }
                                                    }
                                                @endphp

                                                @if ($restaurantCuisine)
                                                    {{ $restaurantCuisine }}
                                                @else
                                                    Cuisine is not available
                                                @endif

                                            </div>
                                        </div>

                                        <div class="border"></div>


                                        {{-- <div class="rest_name">Cuisine</div>
                                        <div class="dish_img">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/dish1.png') }}" alt="">
                                                    </div>
                                                    <div class="dish_name">Butter Chicken</div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/dish2.png') }}" alt="">
                                                    </div>
                                                    <div class="dish_name">Chicken Tandoori</div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/dish3.png') }}" alt="">
                                                    </div>
                                                    <div class="dish_name">Dal Tadka</div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/dish4.png') }}" alt="">
                                                    </div>
                                                    <div class="dish_name">Chicken Tikka</div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/dish1.png') }}" alt="">
                                                    </div>
                                                    <div class="dish_name">Butter Chicken</div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/dish2.png') }}" alt="">
                                                    </div>
                                                    <div class="dish_name">Chicken Tandoori</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border"></div> --}}

                                        <div class="about_heading">About The Restaurant</div>
                                        {{-- <div class="info_area">
                                            <div class="row">
                                                <div class="price"><img src="{{ asset('images/price.png') }}"
                                                        alt=""><span>$50 for two</span></div>
                                                <div class="location"><img src="{{ asset('images/location-icon.png') }}"
                                                        alt=""><span>{{ isset($result['location']) && !empty($result['location']) ? $result['location'] : 'No location available' }}
                                                    </span></div>

                                                <div class="time">
                                                    <img src="{{ asset('images/icon-time.png') }}" alt="">
                                                    <span><span class="close">Closed</span> - Open soon ⋅ 11 am</span>
                                                    <i class="fa-solid fa-sort-down dropdown-icon" data-id="1"></i>
                                                    <div class="dropdown-menu" data-id="1">
                                                        <p>Hours:</p>
                                                        @php
                                                            $hoursMeta = collect($result['lstMeta'])->firstWhere(
                                                                'metaID',
                                                                47,
                                                            );
                                                            $hours = $hoursMeta
                                                                ? json_decode($hoursMeta['value'], true)
                                                                : null;
                                                        @endphp
                                                        @if (!empty($hours))
                                                            @foreach ($hours as $time)
                                                                <p>{{ $time }}</p>
                                                            @endforeach
                                                        @else
                                                            <p>No hours available</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="info_area">
                                            <div class="row">
                                                <div class="location"><img src="{{ asset('images/location-icon.png') }}"
                                                        alt=""><span>{{ isset($result['location']) && !empty($result['location']) ? $result['location'] : 'No location available' }}
                                                    </span></div>

                                                <div class="time">
                                                    <img src="{{ asset('images/icon-time.png') }}" alt="">
                                                    <span><span class="close">Closed</span> - Open soon ⋅ 11 am</span>
                                                    <i class="fa-solid fa-sort-down dropdown-icon" data-id="1"></i>
                                                    <div class="dropdown-menu" data-id="1">
                                                        <p>Hours:</p>
                                                        @php
                                                            $hoursMeta = collect($result['lstMeta'])->firstWhere(
                                                                'metaID',
                                                                47,
                                                            );
                                                            $hours = $hoursMeta
                                                                ? json_decode($hoursMeta['value'], true)
                                                                : null;
                                                        @endphp
                                                        @if (!empty($hours))
                                                            @foreach ($hours as $time)
                                                                <p>{{ $time }}</p>
                                                            @endforeach
                                                        @else
                                                            <p>No hours available</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border"></div>

                                        {{-- <div class="menu">Menu</div>
                                        <div class="dish_menu">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/menu.png') }}" alt="">
                                                    </div>
                                                    <div class="menu_name">Food Menu</div>
                                                    <div class="page">20 pages</div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/menu2.png') }}" alt="">
                                                    </div>
                                                    <div class="menu_name">Bevarages</div>
                                                    <div class="page">2 pages</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border"></div> --}}

                                        <div class="summary_name">Description</div>
                                        <div class="summary_des">
                                            <p>{{ isset($result['msg']) ? $result['msg'] : 'No message available' }}</p>
                                        </div>
                                        <div class="border"></div>

                                        {{-- <div class="menu">Menu</div>
                                        <div class="dish_menu">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/menu11.png') }}" alt="">
                                                    </div>
                                                    <div class="menu_name">Food</div>
                                                    <div class="page">55 Photos</div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div><img src="{{ asset('images/menu12.png') }}" alt="">
                                                    </div>
                                                    <div class="menu_name">Ambiance</div>
                                                    <div class="page">23 Photos</div>
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
                                            @if (!empty($similarPosts))
                                                @foreach ($similarPosts as $post)
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <a
                                                                href="{{ route('search-detail', ['id' => $post['pid'], 'catID' => $post['catID'] ?? '']) }}">
                                                                <img class="card-main-img" src="{{ $post['img'] }}"
                                                                    alt="{{ $post['title'] }}">
                                                            </a>
                                                            <div class="card-body">
                                                                <h5 class="card-title">
                                                                    {{ Str::limit($post['title'], 20) }}</h5>
                                                                <span class="star_point">
                                                                    <img src="{{ asset('images/star_icon.png') }}"
                                                                        alt=""> {{ $post['rating'] }}
                                                                </span>
                                                                <span class="rating">{{ $post['totalReczIt'] }} Users
                                                                    Recz It!</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-md-12">
                                                    <p>No similar posts found.</p>
                                                </div>
                                            @endif
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

    <section class="detail_page song">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="trailer_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="carouselMusicControls" class="carousel slide movies_img"
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
                                                data-bs-target="#carouselMusicControls" data-bs-slide="prev">
                                                <span><i class="fas fa-chevron-left"></i></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselMusicControls" data-bs-slide="next">
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
                                                $songTitle = '';
                                                foreach ($result['lstMeta'] as $meta) {
                                                    if ($meta['metaID'] == 38) {
                                                        $songTitle = $meta['value'];
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $songTitle }}
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
                                                            <img class="overlay-sec-img"
                                                                src="{{ $rating['socialImg'] }}"
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
                                        {{-- <div class="name">About Song</div>
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

                                        <div class="border"></div> --}}


                                        {{-- <div class="cast_name">Song Artists</div>
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

                                        <div class="border"></div> --}}

                                        <div class="summary_name">Description</div>
                                        <div class="summary_des">
                                            <p>{{ isset($result['msg']) ? $result['msg'] : 'No message available' }}</p>
                                        </div>
                                        <div class="border"></div>

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
                                            @if (!empty($similarPosts))
                                                @foreach ($similarPosts as $post)
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <a
                                                                href="{{ route('search-detail', ['id' => $post['pid'], 'catID' => $post['catID'] ?? '']) }}">
                                                                <img class="card-main-img" src="{{ $post['img'] }}"
                                                                    alt="{{ $post['title'] }}">
                                                            </a>
                                                            <div class="card-body">
                                                                <h5 class="card-title">
                                                                    {{ Str::limit($post['title'], 20) }}</h5>
                                                                <span class="star_point">
                                                                    <img src="{{ asset('images/star_icon.png') }}"
                                                                        alt=""> {{ $post['rating'] }}
                                                                </span>
                                                                <span class="rating">{{ $post['totalReczIt'] }} Users
                                                                    Recz It!</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-md-12">
                                                    <p>No similar posts found.</p>
                                                </div>
                                            @endif
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

    <section class="detail_page travel">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    {{-- <div class="trailer_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        @if (count($result['lstMedia']) > 0)
                                            <div class="col-md-8">
                                                <img class="full_img"
                                                    src="{{ $result['lstMedia'][0]['link'] ?? asset('images/dummy_image.webp') }}"
                                                    alt="">
                                            </div>
                                        @else
                                            <div class="col-md-8">
                                                <img class="full_img" src="{{ asset('images/dummy_image.webp') }}"
                                                    alt="Dummy Image">
                                            </div>
                                        @endif
                                        <div class="col-md-4">
                                            @if (count($result['lstMedia']) > 1)
                                                <img class="first_img"
                                                    src="{{ $result['lstMedia'][1]['link'] ?? asset('images/dummy_image.webp') }}"
                                                    alt="">
                                            @else
                                                <img class="first_img" src="{{ asset('images/dummy_image.webp') }}"
                                                    alt="Dummy Image">
                                            @endif
                                            @if (count($result['lstMedia']) > 2)
                                                <p><img class="secnd_img"
                                                        src="{{ $result['lstMedia'][2]['link'] ?? asset('images/dummy_image.webp') }}"
                                                        alt=""></p>
                                            @else
                                                <p><img class="secnd_img" src="{{ asset('images/dummy_image.webp') }}"
                                                        alt="Dummy Image"></p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    @if (isset($result['lstMedia']) && count($result['lstMedia']) < 3)
                        <div class="trailer_section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="carouselTravelControls" class="carousel slide movies_img"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @if (count($result['lstMedia']) > 0)
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

                                            @if (count($result['lstMedia']) > 1)
                                                <button class="carousel-control-prev" type="button"
                                                    data-bs-target="#carouselTravelControls" data-bs-slide="prev">
                                                    <span><i class="fas fa-chevron-left"></i></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button"
                                                    data-bs-target="#carouselTravelControls" data-bs-slide="next">
                                                    <span><i class="fas fa-chevron-right"></i></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="trailer_section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            @if (count($result['lstMedia']) > 0)
                                                <div class="col-md-8">
                                                    <img class="full_img"
                                                        src="{{ $result['lstMedia'][0]['link'] ?? asset('images/dummy_image.webp') }}"
                                                        alt="">
                                                </div>
                                            @else
                                                <div class="col-md-8">
                                                    <img class="full_img" src="{{ asset('images/dummy_image.webp') }}"
                                                        alt="Dummy Image">
                                                </div>
                                            @endif
                                            <div class="col-md-4">
                                                @if (count($result['lstMedia']) > 1)
                                                    <img class="first_img"
                                                        src="{{ $result['lstMedia'][1]['link'] ?? asset('images/dummy_image.webp') }}"
                                                        alt="">
                                                @else
                                                    <img class="first_img" src="{{ asset('images/dummy_image.webp') }}"
                                                        alt="Dummy Image">
                                                @endif
                                                @if (count($result['lstMedia']) > 2)
                                                    <p><img class="secnd_img"
                                                            src="{{ $result['lstMedia'][2]['link'] ?? asset('images/dummy_image.webp') }}"
                                                            alt=""></p>
                                                @else
                                                    <p><img class="secnd_img"
                                                            src="{{ asset('images/dummy_image.webp') }}"
                                                            alt="Dummy Image"></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                    <div class="title_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="title">
                                        <span class="name">
                                            @php
                                                $restaurantTitle = '';
                                                foreach ($result['lstMeta'] as $meta) {
                                                    if ($meta['metaID'] == 7) {
                                                        $restaurantTitle = $meta['value'];
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $restaurantTitle }}
                                        </span>
                                        <span class="fav_icon"><img src="{{ asset('images/favourit.png') }}"
                                                alt=""></span>
                                        <div class="location">
                                            <span>{{ isset($result['location']) && !empty($result['location']) ? $result['location'] : 'No location available' }}
                                            </span>
                                        </div>
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
                                                            <img class="overlay-sec-img"
                                                                src="{{ $rating['socialImg'] }}"
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
                                        {{-- <div class="name">About Place</div>
                                        <div class="row">
                                            <div class="travel_detail">
                                                <span>Wellness, Spa, Message Evolved</span>
                                            </div>
                                        </div>

                                        <div class="border"></div> --}}

                                        <div class="about_heading">Details</div>
                                        <div class="info_area">
                                            <div class="row">

                                                <div class="location"><img src="{{ asset('images/location-icon.png') }}"
                                                        alt=""><span>{{ isset($result['location']) && !empty($result['location']) ? $result['location'] : 'No location available' }}
                                                    </span></div>

                                                {{-- <div class="time">
                                                    <img src="{{ asset('images/icon-time.png') }}" alt="">
                                                    <span><span class="close">Closed</span> - Open soon ⋅ 11 am</span>
                                                    <i class="fa-solid fa-sort-down dropdown-icon" data-id="2"></i>
                                                    <div class="dropdown-menu" data-id="2">
                                                        <p>Hours:</p>
                                                        @php
                                                            $hoursMeta = collect($result['lstMeta'])->firstWhere(
                                                                'metaID',
                                                                47,
                                                            );
                                                            $hours = $hoursMeta
                                                                ? json_decode($hoursMeta['value'], true)
                                                                : null;
                                                        @endphp
                                                        @if (!empty($hours))
                                                            @foreach ($hours as $time)
                                                                <p>{{ $time }}</p>
                                                            @endforeach
                                                        @else
                                                            <p>No hours available</p>
                                                        @endif
                                                    </div>
                                                </div> --}}


                                            </div>
                                        </div>

                                        <div class="border"></div>

                                        <div class="summary_name">Description</div>
                                        <div class="summary_des">
                                            <p>{{ isset($result['msg']) ? $result['msg'] : 'No message available' }}</p>
                                        </div>
                                        <div class="border"></div>

                                        <div class="photo">Photos</div>
                                        <div class="photo_grid">
                                            <div class="row">
                                                @if (isset($result['lstMedia']) && count($result['lstMedia']) > 0)
                                                    @foreach ($result['lstMedia'] as $media)
                                                        <div class="col-md-3">
                                                            <div>
                                                                <img src="{{ $media['link'] }}"
                                                                    alt="Image {{ $loop->index + 1 }}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @for ($i = 0; $i < 8; $i++)
                                                        <div class="col-md-3">
                                                            <div>
                                                                <img src="{{ asset('images/placeholder.png') }}"
                                                                    alt="Placeholder Image">
                                                            </div>
                                                        </div>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>

                                        <div class="border travel"></div>

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
                                            @if (!empty($similarPosts))
                                                @foreach ($similarPosts as $post)
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <a
                                                                href="{{ route('search-detail', ['id' => $post['pid'], 'catID' => $post['catID'] ?? '']) }}">
                                                                <img class="card-main-img" src="{{ $post['img'] }}"
                                                                    alt="{{ $post['title'] }}">
                                                            </a>
                                                            <div class="card-body">
                                                                <h5 class="card-title">
                                                                    {{ Str::limit($post['title'], 20) }}</h5>
                                                                <span class="star_point">
                                                                    <img src="{{ asset('images/star_icon.png') }}"
                                                                        alt=""> {{ $post['rating'] }}
                                                                </span>
                                                                <span class="rating">{{ $post['totalReczIt'] }} Users
                                                                    Recz It!</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-md-12">
                                                    <p>No similar posts found.</p>
                                                </div>
                                            @endif
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

    <section class="detail_page willness">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="trailer_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        @if (count($result['lstMedia']) > 0)
                                            <div class="col-md-8">
                                                <img class="full_img"
                                                    src="{{ $result['lstMedia'][0]['link'] ?? asset('images/dummy_image.webp') }}"
                                                    alt="">
                                            </div>
                                        @else
                                            <div class="col-md-8">
                                                <img class="full_img" src="{{ asset('images/dummy_image.webp') }}"
                                                    alt="Dummy Image">
                                            </div>
                                        @endif
                                        <div class="col-md-4">
                                            @if (count($result['lstMedia']) > 1)
                                                <img class="first_img"
                                                    src="{{ $result['lstMedia'][1]['link'] ?? asset('images/dummy_image.webp') }}"
                                                    alt="">
                                            @else
                                                <img class="first_img" src="{{ asset('images/dummy_image.webp') }}"
                                                    alt="Dummy Image">
                                            @endif
                                            @if (count($result['lstMedia']) > 2)
                                                <p><img class="secnd_img"
                                                        src="{{ $result['lstMedia'][2]['link'] ?? asset('images/dummy_image.webp') }}"
                                                        alt=""></p>
                                            @else
                                                <p><img class="secnd_img" src="{{ asset('images/dummy_image.webp') }}"
                                                        alt="Dummy Image"></p>
                                            @endif
                                        </div>
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
                                                $willnessTitle = '';
                                                foreach ($result['lstMeta'] as $meta) {
                                                    if ($meta['metaID'] == 58) {
                                                        $willnessTitle = $meta['value'];
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $willnessTitle }}
                                        </span>
                                        <span class="fav_icon"><img src="{{ asset('images/favourit.png') }}"
                                                alt=""></span>
                                        <div class="location">
                                            <span>{{ isset($result['location']) && !empty($result['location']) ? $result['location'] : 'No location available' }}
                                            </span>
                                        </div>
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
                                                            <img class="overlay-sec-img"
                                                                src="{{ $rating['socialImg'] }}"
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
                                        <div class="name">About Place</div>
                                        <div class="row">
                                            <div class="willness_detail">
                                                <span>{{ $result['msg'] ? $result['msg'] : 'About is not available' }}</span>
                                            </div>
                                        </div>

                                        <div class="border"></div>

                                        <div class="about_heading">Details</div>
                                        <div class="info_area">
                                            <div class="row">
                                                <div class="price"><img src="{{ asset('images/price.png') }}"
                                                        alt=""><span>$50 for two</span></div>
                                                <div class="location"><img src="{{ asset('images/location-icon.png') }}"
                                                        alt=""><span>{{ isset($result['location']) && !empty($result['location']) ? $result['location'] : 'No location available' }}
                                                    </span></div>

                                                <div class="time">
                                                    <img src="{{ asset('images/icon-time.png') }}" alt="">
                                                    <span><span class="close">Closed</span> - Open soon ⋅ 11 am</span>
                                                    <i class="fa-solid fa-sort-down dropdown-icon" data-id="3"></i>
                                                    <div class="dropdown-menu" data-id="3">
                                                        <p>Hours:</p>
                                                        @php
                                                            $hoursMeta = collect($result['lstMeta'])->firstWhere(
                                                                'metaID',
                                                                47,
                                                            );
                                                            $hours = $hoursMeta
                                                                ? json_decode($hoursMeta['value'], true)
                                                                : null;
                                                        @endphp
                                                        @if (!empty($hours))
                                                            @foreach ($hours as $time)
                                                                <p>{{ $time }}</p>
                                                            @endforeach
                                                        @else
                                                            <p>No hours available</p>
                                                        @endif
                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                        <div class="border"></div>

                                        <div class="summary_name">Description</div>
                                        <div class="summary_des">
                                            <p>{{ isset($result['msg']) ? $result['msg'] : 'No description available' }}
                                            </p>
                                        </div>
                                        <div class="border"></div>

                                        <div class="photo">Photos</div>
                                        <div class="photo_grid">
                                            <div class="row">
                                                @if (isset($result['lstMedia']) && count($result['lstMedia']) > 0)
                                                    @foreach ($result['lstMedia'] as $media)
                                                        <div class="col-md-3">
                                                            <div>
                                                                <img src="{{ $media['link'] }}"
                                                                    alt="Image {{ $loop->index + 1 }}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @for ($i = 0; $i < 8; $i++)
                                                        <div class="col-md-3">
                                                            <div>
                                                                <img src="{{ asset('images/placeholder.png') }}"
                                                                    alt="Placeholder Image">
                                                            </div>
                                                        </div>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>

                                        <div class="border willness"></div>

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
                                            @if (!empty($similarPosts))
                                                @foreach ($similarPosts as $post)
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <a
                                                                href="{{ route('search-detail', ['id' => $post['pid'], 'catID' => $post['catID'] ?? '']) }}">
                                                                <img class="card-main-img" src="{{ $post['img'] }}"
                                                                    alt="{{ $post['title'] }}">
                                                            </a>
                                                            <div class="card-body">
                                                                <h5 class="card-title">
                                                                    {{ Str::limit($post['title'], 20) }}</h5>
                                                                <span class="star_point">
                                                                    <img src="{{ asset('images/star_icon.png') }}"
                                                                        alt=""> {{ $post['rating'] }}
                                                                </span>
                                                                <span class="rating">{{ $post['totalReczIt'] }} Users
                                                                    Recz It!</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-md-12">
                                                    <p>No similar posts found.</p>
                                                </div>
                                            @endif
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

    <section class="detail_page wine">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="trailer_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="carouselWineControls" class="carousel slide movies_img"
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
                                                data-bs-target="#carouselWineControls" data-bs-slide="prev">
                                                <span><i class="fas fa-chevron-left"></i></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselWineControls" data-bs-slide="next">
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
                                                $wineTitle = '';
                                                foreach ($result['lstMeta'] as $meta) {
                                                    if ($meta['metaID'] == 13) {
                                                        $wineTitle = $meta['value'];
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $wineTitle }}
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
                                                            <img class="overlay-sec-img"
                                                                src="{{ $rating['socialImg'] }}"
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
                                        <div class="name">About The Product</div>

                                        <div class="row">
                                            <div class="wine_detail">
                                                <span>{{ $result['msg'] ? $result['msg'] : 'About is not available' }}</span>
                                            </div>
                                        </div>
                                        <div class="border"></div>

                                        {{-- <div class="name">Specifications</div>

                                        <div class="row">
                                            <div class="wine_detail">
                                                <span>Vintage: </span>
                                            </div>
                                            <div class="wine_detail">
                                                <span>Varietal: </span>
                                            </div>
                                            <div class="wine_detail">
                                                <span>Appellation: </span>
                                            </div>
                                            <div class="wine_detail">
                                                <span>Acid: </span>
                                            </div>
                                            <div class="wine_detail">
                                                <span>pH: </span>
                                            </div>
                                            <div class="wine_detail">
                                                <span>Aging: </span>
                                            </div>
                                            <div class="wine_detail">
                                                <span>Fermentation: </span>
                                            </div>
                                            <div class="wine_detail">
                                                <span>Residual Sugar: </span>
                                            </div>
                                            <div class="wine_detail">
                                                <span>Alcohol: </span>
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
                                            @if (!empty($similarPosts))
                                                @foreach ($similarPosts as $post)
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <a
                                                                href="{{ route('search-detail', ['id' => $post['pid'], 'catID' => $post['catID'] ?? '']) }}">
                                                                <img class="card-main-img" src="{{ $post['img'] }}"
                                                                    alt="{{ $post['title'] }}">
                                                            </a>
                                                            <div class="card-body">
                                                                <h5 class="card-title">
                                                                    {{ Str::limit($post['title'], 20) }}</h5>
                                                                <span class="star_point">
                                                                    <img src="{{ asset('images/star_icon.png') }}"
                                                                        alt=""> {{ $post['rating'] }}
                                                                </span>
                                                                <span class="rating">{{ $post['totalReczIt'] }} Users
                                                                    Recz
                                                                    It!</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-md-12">
                                                    <p>No similar posts found.</p>
                                                </div>
                                            @endif
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

    <section class="detail_page podcast">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="trailer_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="carouselPodcastControls" class="carousel slide movies_img"
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
                                                data-bs-target="#carouselPodcastControls" data-bs-slide="prev">
                                                <span><i class="fas fa-chevron-left"></i></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselPodcastControls" data-bs-slide="next">
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
                                                $podcastTitle = '';
                                                foreach ($result['lstMeta'] as $meta) {
                                                    if ($meta['metaID'] == 40) {
                                                        $podcastTitle = $meta['value'];
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $podcastTitle }}
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

                                            <span class="user_based">(Based on {{ $result['ratingCount'] }}
                                                users)</span>
                                        </div>
                                        <div class="people_like">
                                            <span class="people_img">
                                                @foreach ($result['lstRating'] as $index => $rating)
                                                    @if ($index < 2)
                                                        @if ($index == 0)
                                                            <img class="overlay-sec-img"
                                                                src="{{ $rating['socialImg'] }}"
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
                                        <div class="name">About</div>
                                        <div class="row">
                                            <div class="podcast_detail">
                                                <span>
                                                    @php
                                                        $podcastAbout = '';
                                                        foreach ($result['lstMeta'] as $meta) {
                                                            if ($meta['metaID'] == 42) {
                                                                $podcastAbout = $meta['value'];
                                                                break;
                                                            }
                                                        }
                                                    @endphp
                                                    {{ $podcastAbout }}</span>
                                            </div>
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
                                            @if (!empty($similarPosts))
                                                @foreach ($similarPosts as $post)
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <a
                                                                href="{{ route('search-detail', ['id' => $post['pid'], 'catID' => $post['catID'] ?? '']) }}">
                                                                <img class="card-main-img" src="{{ $post['img'] }}"
                                                                    alt="{{ $post['title'] }}">
                                                            </a>
                                                            <div class="card-body">
                                                                <h5 class="card-title">
                                                                    {{ Str::limit($post['title'], 20) }}</h5>
                                                                <span class="star_point">
                                                                    <img src="{{ asset('images/star_icon.png') }}"
                                                                        alt=""> {{ $post['rating'] }}
                                                                </span>
                                                                <span class="rating">{{ $post['totalReczIt'] }} Users
                                                                    Recz
                                                                    It!</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-md-12">
                                                    <p>No similar posts found.</p>
                                                </div>
                                            @endif
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

    <section class="detail_page shopping">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="trailer_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="carouselShoppingControls" class="carousel slide movies_img"
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
                                                data-bs-target="#carouselShoppingControls" data-bs-slide="prev">
                                                <span><i class="fas fa-chevron-left"></i></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselShoppingControls" data-bs-slide="next">
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
                                                $shoppingTitle = '';
                                                foreach ($result['lstMeta'] as $meta) {
                                                    if ($meta['metaID'] == 37) {
                                                        $shoppingTitle = $meta['value'];
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            {{ $shoppingTitle }}
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

                                            <span class="user_based">(Based on {{ $result['ratingCount'] }}
                                                users)</span>
                                        </div>
                                        <div class="people_like">

                                            <span class="people_img">
                                                @foreach ($result['lstRating'] as $index => $rating)
                                                    @if ($index < 2)
                                                        @if ($index == 0)
                                                            <img class="overlay-sec-img"
                                                                src="{{ $rating['socialImg'] }}"
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
                                        <div class="name">About The Product</div>

                                        <div class="row">
                                            <div class="shopping_detail">
                                                <span>{{ $result['msg'] }}</span>
                                            </div>

                                        </div>

                                        <div class="border"></div>

                                        {{-- <div class="name">Specifications</div>

                                        <div class="row">
                                            <div class="shopping_detail">
                                                <span>Brand: </span>
                                            </div>
                                            <div class="shopping_detail">
                                                <span>Material: </span>
                                            </div>
                                            <div class="shopping_detail">
                                                <span>Special Feature: </span>
                                            </div>
                                            <div class="shopping_detail">
                                                <span>Colour: </span>
                                            </div>
                                            <div class="shopping_detail">
                                                <span>Capacity: </span>
                                            </div>
                                            <div class="shopping_detail">
                                                <span>Handle Material: </span>
                                            </div>
                                            <div class="shopping_detail">
                                                <span>Item Weight: </span>
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
                                            @if (!empty($similarPosts))
                                                @foreach ($similarPosts as $post)
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <a
                                                                href="{{ route('search-detail', ['id' => $post['pid'], 'catID' => $post['catID'] ?? '']) }}">
                                                                <img class="card-main-img" src="{{ $post['img'] }}"
                                                                    alt="{{ $post['title'] }}">
                                                            </a>
                                                            <div class="card-body">
                                                                <h5 class="card-title">
                                                                    {{ Str::limit($post['title'], 20) }}</h5>
                                                                <span class="star_point">
                                                                    <img src="{{ asset('images/star_icon.png') }}"
                                                                        alt=""> {{ $post['rating'] }}
                                                                </span>
                                                                <span class="rating">{{ $post['totalReczIt'] }} Users
                                                                    Recz
                                                                    It!</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-md-12">
                                                    <p>No similar posts found.</p>
                                                </div>
                                            @endif
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

    <section class="detail_page webseries">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="trailer_section">
                        <div class="container">
                            <div class="row">
                                <div id="carouselWebseriesControls" class="carousel slide movies_img"
                                    data-bs-ride="carousel">
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
                                            data-bs-target="#carouselWebseriesControls" data-bs-slide="prev">
                                            <span><i class="fas fa-chevron-left"></i></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselWebseriesControls" data-bs-slide="next">
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
                                                    if ($meta['metaID'] == 3) {
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

                                            <span class="user_based">(Based on {{ $result['ratingCount'] }}
                                                users)</span>
                                        </div>
                                        <div class="people_like">
                                            <span class="people_img">
                                                @foreach ($result['lstRating'] as $index => $rating)
                                                    @if ($index < 2)
                                                        @if ($index == 0)
                                                            <img class="overlay-sec-img"
                                                                src="{{ $rating['socialImg'] }}"
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
                                        <div class="name">About Movie</div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="icons">
                                                    <div><img src="{{ asset('images/time-icon.png') }}"
                                                            alt="">
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
                                                                if ($meta['metaID'] == 23) {
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
                                                    <div><img src="{{ asset('images/date.png') }}" alt="">
                                                    </div>
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
                                                                if ($meta['metaID'] == 56) {
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
                                                        if ($meta['metaID'] == 57 && !empty($meta['value'])) {
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
                                            @if (!empty($similarPosts))
                                                @foreach ($similarPosts as $post)
                                                    <div class="col-md-3">
                                                        <div class="card">
                                                            <a
                                                                href="{{ route('search-detail', ['id' => $post['pid'], 'catID' => $post['catID'] ?? '']) }}">
                                                                <img class="card-main-img" src="{{ $post['img'] }}"
                                                                    alt="{{ $post['title'] }}">
                                                            </a>
                                                            <div class="card-body">
                                                                <h5 class="card-title">
                                                                    {{ Str::limit($post['title'], 20) }}</h5>
                                                                <span class="star_point">
                                                                    <img src="{{ asset('images/star_icon.png') }}"
                                                                        alt=""> {{ $post['rating'] }}
                                                                </span>
                                                                <span class="rating">{{ $post['totalReczIt'] }} Users
                                                                    Recz
                                                                    It!</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="col-md-12">
                                                    <p>No similar posts found.</p>
                                                </div>
                                            @endif
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

    <!-- Modal -->
    <div class="modal fade" id="starModal" tabindex="-1" aria-labelledby="starModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="close" style="height: 0">
                    <div data-bs-dismiss="modal" aria-label="Close">
                        <img class="cross-icon" src="{{ asset('images/cross.png') }}" alt="">
                    </div>
                </div>
                <div class="modal-body">
                    <img class="lady" src="{{ asset('images/pop_bg.png') }}" alt="">
                    <div class="col-md-12">
                        <div class="row">
                            <h3>To use this feature, download Recz App.</h3>
                            <img class="scan" src="{{ asset('images/scan.png') }}" alt="">
                            <p>Available on</p>
                            <div class="app_link">
                                <a href="https://apps.apple.com/us/app/recz-social-recommendation-app/id1582034985"><img class="applestore" src="{{ asset('images/apple-play.png') }}" alt=""></a>
                                <a href="https://play.google.com/store/apps/details?id=com.recz.android"><img class="googlestore" src="{{ asset('images/google-play.png') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-4"></div> --}}
                </div>
            </div>
        </div>
    </div>



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
            var songPage = document.querySelector('.detail_page.song');
            var restaurantsPage = document.querySelector('.detail_page.restaurants');
            var travelPage = document.querySelector('.detail_page.travel');
            var willnessPage = document.querySelector('.detail_page.willness');
            var winePage = document.querySelector('.detail_page.wine');
            var podcastPage = document.querySelector('.detail_page.podcast');
            var shoppingPage = document.querySelector('.detail_page.shopping');
            var webseriesPage = document.querySelector('.detail_page.webseries');


            function showSection(catID) {
                moviesPage.style.display = 'none';
                booksPage.style.display = 'none';
                songPage.style.display = 'none';
                restaurantsPage.style.display = 'none';
                travelPage.style.display = 'none';
                willnessPage.style.display = 'none';
                winePage.style.display = 'none';
                podcastPage.style.display = 'none';
                shoppingPage.style.display = 'none';
                webseriesPage.style.display = 'none';


                if (catID === 1) {
                    moviesPage.style.display = 'block';
                } else if (catID === 8) {
                    booksPage.style.display = 'block';
                } else if (catID === 13) {
                    songPage.style.display = 'block';
                } else if (catID === 3) {
                    restaurantsPage.style.display = 'block';
                } else if (catID === 4) {
                    travelPage.style.display = 'block';
                } else if (catID === 14) {
                    willnessPage.style.display = 'block';
                } else if (catID === 7) {
                    winePage.style.display = 'block';
                } else if (catID === 12) {
                    podcastPage.style.display = 'block';
                } else if (catID === 5) {
                    shoppingPage.style.display = 'block';
                } else if (catID === 2) {
                    webseriesPage.style.display = 'block';
                }
            }

            showSection(catID);
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


@endsection
