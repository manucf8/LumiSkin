@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container my-5">
    <div class="card p-5">
        <h1 class="text-center mb-3">{{ $viewData['title'] }}</h1>
        <h2 class="text-center mb-4">{{ $viewData['subtitle'] }}</h2>

        <p class="text-justify">{{ $viewData['routine'] }}</p>

        <div class="text-center mt-4">
            <a href="{{ route('skincare_test.index') }}" class="btn btn-link">{{ __('skincare_test.back') }}</a>
        </div>
    </div>
</div>
@endsection