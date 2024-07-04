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
                                <form id="indexForm" class="d-flex search-container" role="search">
                                    @csrf
                                    <input id="searchInput" class="form-control me-2" aria-label="Search">
                                    <div class="search_icon">
                                        <img src="{{ asset('images/search-icon.png') }}" alt="">
                                    </div>
                                </form>

                            </div>
                            {{-- <div class="col">
                                <div class="right_btn">
                                    <a href="/login" class="btn">Sign in</a>
                                    <a href="#!" class="btn_red">Sign Up</a>
                                </div>
                            </div> --}}
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
            function performSearch(searchText) {
                if (searchText.length > 0) {
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var token = localStorage.getItem('api_token');

                    $('#loaderOverlay').show();
                    $('#loader').show();

                    $.ajax({
                        url: "{{ route('search-list-process') }}",
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

            $(document).on('change', '.filter-checkbox', function() {

                $('.filter-checkbox').prop('checked', false);

                $(this).prop('checked', true);

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
                    var imgSrc = result.img ? result.img : '{{ asset('images/dummy_image.webp') }}';
                    var lstReczItFrnd = result.lstReczItFrnd;
                    var firstName = lstReczItFrnd.length > 0 ? lstReczItFrnd[0].firstName : '';
                    var reczItText = firstName ?
                        `<span style="color: #000000"><span class="start_bold">${firstName}</span> and 327 <span class="start_bold">other</span> people Recz it!</span>` :'';

                    var metaValues = result.lstMeta.map(meta => meta.value).filter(value => value).join(', ');

                    var resultHtml = `<div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card shadow-0 border rounded-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="img_round">
                                                        <a href="{{ route('search-detail') }}?id=${result.pid}">
                                                            <img src="${imgSrc}" class="w-100" onerror="this.onerror=null;this.src='{{ asset('images/dummy_image.webp') }}';"/>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                    <h5>${result.title}</h5>

                                                    <div class="mb-2 text-gray">
                                                        <span>${metaValues} ·</span>

                                                    </div>
                                                    <div class="mb-3 text-gray">
                                                        <span></span>
                                                    </div>
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
@endsection
