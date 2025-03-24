@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <h1>{{ $viewData['title'] }}</h1>
    <h2>{{ $viewData['subtitle'] }}</h2>

    <form action="{{ route('skincare_test.recommendation') }}" method="POST">
        @csrf

        @foreach ($viewData['questions'] as $question)
            <label>{{ $question['question'] }}</label><br>
            <select name="{{ $question['name'] }}" required>
                @foreach ($question['options'] as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select><br><br>
        @endforeach

        <button type="submit">Enviar</button>
    </form>
@endsection
