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
    List of all categories 
  </div> 
  <div class="card-body"> 
    <div class="card-subtitle">
      Click on a specific ID to get more information about that category.
    </div>
    <table class="table table-bordered table-striped"> 
      <thead> 
        <tr> 
          <th scope="col">ID</th> 
          <th scope="col">Name</th> 
        </tr> 
      </thead> 
      <tbody> 
        @foreach ($viewData["categories"] as $category) 
        <tr> 
        <td><a class="nav-link active" href="{{ route('category.show', ['id'=> $category->getId()]) }}">{{ $category->getId() }}</a></td>  
          <td>{{ $category->getName() }}</td>  
        </tr> 
        @endforeach 
        </tbody> 
    </table> 
  </div> 
</div> 
@endsection