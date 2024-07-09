@extends('layouts.frontend')

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
    {{-- <section class="detail_page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="trailer_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="movies_img">
                                        <img src="{{ asset('images/spide.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="trailer_play">
                                        <iframe src="https://www.youtube.com/embed/t06RUxPbp_c?si=zA2I6c1hud8SkUn5"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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
                                        <span class="name">Spider-Man: Across the Spider-Verse</span>
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
                                        <div class="name">About the Movie</div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="icons">
                                                    <div><img src="{{ asset('images/time-icon.png') }}" alt="">
                                                    </div>
                                                    <div class="desc">2h 20m</div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="icons">
                                                    <div><img src="{{ asset('images/action.png') }}" alt="">
                                                    </div>
                                                    <div class="desc">Action, Adventure, Animation</div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="icons">
                                                    <div><img src="{{ asset('images/date.png') }}" alt=""></div>
                                                    <div class="desc">1 Jun, 2023</div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="icons">
                                                    <div><img src="{{ asset('images/starts.png') }}" alt="">
                                                    </div>
                                                    <div class="desc">7.5 / 10 (688K)</div>
                                                    <span class="imb">IMDb</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border"></div>

                                        <div class="cast_name">Cast</div>
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
                                        <div class="border"></div>

                                        <div class="summary_name">Summary</div>
                                        <div class="summary_des">
                                            <p>Miles Morales returns for the next chapter of the Oscar®-winning Spider-Verse
                                                saga, an epic adventure that will transport Brooklyn’s full-time, friendly
                                                neighborhood Spider-Man across the Multiverse to join forces with Gwen Stacy
                                                and a new team of Spider-People to face off with a villain more powerful
                                                than anything they have ever encountered.</p>
                                        </div>
                                        <div class="border"></div>

                                        <div class="video_name">Videos</div>
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
    </section> --}}

    <section class="detail_page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="trailer_section">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="movies_img">
                                        <img src="{{ $result['lstInfo']['img'] ?? asset('images/dummy_image.webp') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="trailer_play">
                                        <iframe src="{{ $result['trailer_url'] ?? 'https://www.youtube.com/embed/t06RUxPbp_c?si=zA2I6c1hud8SkUn5' }}"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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
                                        <span class="name">{{ $result['lstInfo']['title'] ?? 'Spider-Man: Across the Spider-Verse' }}</span>
                                        <span class="fav_icon"><img src="{{ asset('images/favourit.png') }}" alt=""></span>
                                        <div class="star_sec">
                                            <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">{{ $result['rating'] ?? '4.5' }}</span>
                                            @for ($i = 0; $i < floor($result['rating'] ?? 4.5); $i++)
                                                <span><img src="{{ asset('images/red-star.png') }}" alt=""></span>
                                            @endfor
                                            @if (($result['rating'] ?? 4.5) - floor($result['rating'] ?? 4.5) > 0)
                                                <span><img src="{{ asset('images/half-red.png') }}" alt=""></span>
                                            @endif
                                            <span class="user_based">(Based on {{ $result['totalReczIt'] ?? 328 }} users)</span>
                                        </div>
                                        <div class="people_like">
                                            <span class="people_img">
                                                <img class="overlay-sec-img" src="{{ asset('images/top_img_2.png') }}" alt="Top Image">
                                                <img class="overlay-first-img" src="{{ asset('images/top_img.png') }}" alt="Top Image">
                                            </span>
                                            <span style="color: #000000"><span class="start_bold">{{ $result['recz_first_name'] ?? 'Ranga' }}</span> and {{ $result['recz_count'] ?? 327 }} <span class="start_bold">other</span> people Recz it!</span>
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
                                                    <div><img src="{{ asset('images/time-icon.png') }}" alt=""></div>
                                                    <div class="desc">{{ $result['lstInfo']['mins'] ?? '2h 20m' }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="icons">
                                                    <div><img src="{{ asset('images/action.png') }}" alt=""></div>
                                                    <div class="desc">{{ $result['lstInfo']['genres'] ?? 'Action, Adventure, Animation' }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="icons">
                                                    <div><img src="{{ asset('images/date.png') }}" alt=""></div>
                                                    <div class="desc">{{ $result['lstInfo']['releaseDate'] ?? '1 Jun, 2023' }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="icons">
                                                    <div><img src="{{ asset('images/starts.png') }}" alt=""></div>
                                                    <div class="desc">{{ $result['lstInfo']['imdbRating'] ?? '7.5' }} / 10  ({{ $result['lstInfo'][('imdbRatingCount')] ?? '(688K)' }})</div>
                                                    <span class="imb">{{ $result['dataSrc'] ?? 'IMDb' }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border"></div>

                                        <div class="cast_name">Cast</div>
                                        {{-- <div class="cast_img">
                                            <div class="row">
                                                @foreach ($result['lstInfo']['casts'] ?? [] as $cast)
                                                    <div class="col-md-2">
                                                        <div><img src="{{ $cast['image'] }}" alt=""></div>
                                                        <div class="first_name">{{ $cast['name'] }}</div>
                                                        <div class="sec_name">{{ $cast['role'] }}</div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div> --}}
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
                                        <div class="border"></div>

                                        <div class="summary_name">Summary</div>
                                        <div class="summary_des">
                                            <p>{{ $result['lstInfo']['desp'] ?? 'Miles Morales returns for the next chapter of the Oscar®-winning Spider-Verse saga, an epic adventure that will transport Brooklyn’s full-time, friendly neighborhood Spider-Man across the Multiverse to join forces with Gwen Stacy and a new team of Spider-People to face off with a villain more powerful than anything they have ever encountered.' }}</p>
                                        </div>
                                        <div class="border"></div>

                                        <div class="video_name">Videos</div>
                                        <div class="video_links">
                                            {{-- <div class="row">
                                                @foreach ($result['videos'] ?? [] as $video)
                                                    <div class="col-md-4">
                                                        <iframe src="{{ $video['url'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                                    </div>
                                                @endforeach
                                            </div> --}}
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
                                        <div class="border"></div>

                                        <div class="comments_name">Comments</div>
                                        {{-- @foreach ($result['comments'] ?? [] as $comment)
                                            <div class="comment_area">
                                                <span><img src="{{ asset('images/top_img.png') }}" alt=""></span>
                                                <span class="comment">{{ $comment['user'] }}</span>
                                                <p>{{ $comment['text'] }}</p>
                                                <p class="comment_date">{{ $comment['date'] }}</p>
                                            </div>
                                        @endforeach --}}
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
                                        {{-- <div class="row">
                                            @foreach ($result['similar_movies'] ?? [] as $movie)
                                                <div class="col-md-3">
                                                    <div class="card">
                                                        <img class="card-main-img" src="{{ $movie['image'] }}" alt="movie img">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $movie['title'] }}</h5>
                                                            <span class="star_point"><img src="{{ asset('images/star_icon.png') }}" alt="">{{ $movie['rating'] }}</span>
                                                            <span class="rating">{{ $movie['recz_count'] }} Users Recz It!</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div> --}}
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
