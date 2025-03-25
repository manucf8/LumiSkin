{{-- Author: Juan Jose Restrepo Hernandez  --}}

@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card mb-4">
    <div class="card-header">
      {{ __('admin.home') }}
    </div>
    <div class="card-body">
      {{ __('admin.welcome') }}
    </div>
</div>
@endsection