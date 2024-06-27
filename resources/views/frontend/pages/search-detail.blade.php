@extends('layouts.frontend')

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
                    <p>Director: {{ $result['author'] }}</p>
                    <p>Rating: {{ $result['rating'] }}</p>
                    <p>Genres: {{ implode(', ', array_column($result['lstMeta'], 'value')) }}</p>
                    <p>{{ $result['description'] }}</p>
                </div>
                <h6>testing</h6>
            </div>
        </div>
    </div>
</div>

@endsection


