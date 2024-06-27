<style>
@media only screen and (min-width: 320px) and (max-width: 767px) {
    /* .right_btn .btn { display: block; } */
    .topheader .navbar { padding: 0 10px; }
    .right_btn .btn { padding: 5px; font-size: 12px; }
    .right_btn .btn_red { padding: 5px; font-size: 12px; }
    }
</style>

<div class="topheader">
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
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
                        <div class="rec text-center">
                            {{-- <i class="fa-solid fa-question"></i> --}}
                            <img class="card-img-top" src="{{ asset('/images/question.png') }}">
                            <span>Ask Recz</span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="right_btn">
                            <button class="btn">Sign in</button>
                            <button class="btn_red">Sign Up</button>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
