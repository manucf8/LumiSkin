@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
    <h1>{{ $viewData['title'] }}</h1>
    <h2>{{ $viewData['subtitle'] }}</h2>

    <form action="{{ route('skincare_test.store') }}" method="POST">
        @csrf

        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

        <div id="responses">
            @foreach ($viewData['questions'] as $question)
                <label>{{ $question['question'] }}</label><br>
                <select name="responses[{{ $question['name'] }}]" required>
                    @foreach ($question['options'] as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select><br><br>
            @endforeach
        </div>

        <button type="submit">Send</button>
    </form>
@endsection
