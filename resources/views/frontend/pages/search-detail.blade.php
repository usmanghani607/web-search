@extends('layouts.frontend')

<style>
    .card .card-body .star_point {
    background: #FF385C;
    padding: 2px 6px;
    border-radius: 2px;
    color: white;
    display: inline-flex;
    align-items: center;
    font-size: 13px;
    margin-right: 15px;
}
.card .card-body span.star_point img {
    background: #FF385C;
    margin-right: 5px;
}
.card .card-body .img-fluid {
    max-width: 100%;
    height: 330px;
}
</style>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $result['title'] }}</h3>
                </div>
                <div class="card-body">
                    <img src="{{ $result['img'] }}" alt="{{ $result['title'] }}" class="img-fluid">
                    <p>Director: </p>
                    <div class="mb-3 text-gray">
                        <span> {{ implode(', ', array_column($result['lstMeta'], 'value')) }} </span>
                    </div>
                    <span class="star_point"><img src="{{ asset ('images/star_icon.png')}}" alt="">{{$result['rating']}}</span>

                    <p></p>
                </div>
            </div>
        </div>


    </div>
</div>

@endsection


