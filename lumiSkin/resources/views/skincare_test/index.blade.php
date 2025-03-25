@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container my-5">
    <div class="test-skincare">
        <h1>{{ $viewData['title'] }}</h1>
        <h2>{{ $viewData['subtitle'] }}</h2>

        <form action="{{ route('skincare_test.store') }}" method="POST" class="mt-4">
            @csrf

            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

            <div id="responses" class="text-start">
                @foreach ($viewData['questions'] as $question)
                <div class="mb-4">
                    <label class="form-label fw-bold">{{ $question['question'] }}</label>
                    <select name="responses[{{ $question['name'] }}]" class="form-select" required>
                        @foreach ($question['options'] as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-light">{{ __('app.submit') }}</button>
        </form>
    </div>
</div>
@endsection