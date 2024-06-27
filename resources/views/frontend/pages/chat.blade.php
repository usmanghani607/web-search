@extends('layouts.search_frontend')

@section('content')
    <section class="chat_head">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading text-center">
                        <img src="{{ asset('images/question.png')}}" alt="">
                        {{-- <i class="fa-solid fa-question"></i> --}}
                        <span>Ask Recz</span>
                        <h3>How can I help you today?</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="question">
        <div class="container">
            <div class="chat_form_wp">
                <div class="row">
                    <div class="col-md-6">
                        <div class="rest">
                            <p>Help me find out restaurants near<br> me</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="rest">
                            <p>Help me find out the top places in New York</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="rest">
                            <p>Help me find out restaurants near<br> me</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="rest">
                            <p>Help me find out the top places in New York</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="chat_foot">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form class="d-flex chat-container" role="search">
                            <input class="form-control" type="search" aria-label="Search" placeholder="Write here…">
                            <div class="send_icon">
                                {{-- <i class="fa-solid fa-paper-plane"></i> --}}
                                <img src="{{ asset('images/send.png') }}" alt="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
