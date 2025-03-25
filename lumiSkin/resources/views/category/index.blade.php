{{-- Author: Manuela Castaño Franco  --}}

@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-header">
        {{ __('categories.list') }}
    </div>
    <div class="card-body">
        <div class="row">
            @foreach ($viewData["categories"] as $category)
                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center text-primary">
                                {{ $category->getName() }}
                            </h5>
                            <p class="text-center text-muted">
                                {{ $category->getDescription() }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
