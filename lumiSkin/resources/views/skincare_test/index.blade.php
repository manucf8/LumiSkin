@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <h1>{{ $viewData['title'] }}</h1>
    <h2>{{ $viewData['subtitle'] }}</h2>

    <form action="{{ route('skincare_test.recommendation') }}" method="POST">
        @csrf

        <label for="skin_type">Skin Type:</label>
        <input type="text" id="skin_type" name="skin_type" value="combination" required><br><br>

        <label for="tone">Skin Tone:</label>
        <input type="text" id="tone" name="tone" value="light" required><br><br>

        <label for="preferences">Preferences:</label>
        <input type="text" id="preferences" name="preferences" value="cruelty-free" required><br><br>

        <button type="submit">Submit</button>
    </form>
@endsection
