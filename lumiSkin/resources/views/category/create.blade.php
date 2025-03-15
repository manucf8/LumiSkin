@extends('layouts.app') 
@section('title', $viewData["title"]) 
@section('subtitle', $viewData["subtitle"]) 
@section('content') 
<div class="card mb-4"> 
  <div class="card-header"> 
    Create a Category 
  </div> 
  <div class="card-body"> 
    @if($errors->any()) 
    <ul class="alert alert-danger list-unstyled"> 
      @foreach($errors->all() as $error) 
      <li>- {{ $error }}</li> 
      @endforeach 
    </ul> 
    @endif 
    <p class="text-muted">Both the Name and Description fields are required to create a category.</p>
    <form method="POST" action="{{ route('category.store')  }}" enctype="multipart/form-data"> 

      @csrf 
      <div class="row"> 
        <div class="col"> 
          <div class="mb-3 row"> 
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label> 
            <div class="col-lg-10 col-md-6 col-sm-12"> 
              <input name="name" value="{{ old('name') }}" type="text" class="form-control"> 
            </div> 
          </div> 
        </div> 
      </div> 
      <div class="row"> 
      <div class="mb-3"> 
        <label class="form-label">Description</label> 
        <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea> 
      </div> 
      <button type="submit" class="btn btn-primary">Create</button> 
    </form> 
  </div> 
</div> 
@endsection