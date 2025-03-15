@extends('layouts.app') 
@section('title', $viewData["title"]) 
@section('subtitle', $viewData["subtitle"]) 
@section('content') 
<p>Below is the complete information of this category.</p>
<div class="card mb-3">
<div class="row g-0"> 
    <div class="col-md-8"> 
      <div class="card-body"> 
        <h3 class="card-title"> 
        {{ $viewData["category"]->getName() }}
        </h3> 
        <p class="card-text"><i>ID:</i> {{ $viewData["category"]->getId() }}</p>
        <p class="card-text"><i>Description:</i> {{ $viewData["category"]->getDescription() }}</p>
        <p class="card-text"><i>Created at:</i> {{ $viewData["category"]->getCreatedAt() }}</p>
        <p class="card-text"><i>Updated at:</i> {{ $viewData["category"]->getUpdatedAt() }}</p>
        
        <form action="{{ route('category.delete', [$viewData["category"]->getId()]) }}" method="POST"> 
              @csrf 
              @method('DELETE') 
            <button class="btn btn-danger">Delete</button> 
          </form> 
      </div> 
    </div> 
  </div> 
</div> 
@endsection