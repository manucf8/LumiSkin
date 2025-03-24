@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card">
  <div class="card-header">
    {{ __('admin.home') }}
  </div>
  <div class="card-body">
    {{ __('admin.welcome') }}
  </div>
</div>
@endsection