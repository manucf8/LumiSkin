@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <h1>{{ $viewData['title'] }}</h1>
    <h2>{{ $viewData['subtitle'] }}</h2>

    <p>{{ $viewData['recommendation'] }}</p>

    <a href="{{ route('skincare_test.index') }}">Back to the Test</a>
@endsection
