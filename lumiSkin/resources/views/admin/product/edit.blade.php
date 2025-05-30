{{-- Author: Juan Jose Restrepo Hernandez  --}}

@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card mb-4">
  <div class="card-header">
    {{ __('products.edit') }}
  </div>
  <div class="card-body">
    @if($errors->any())
    <ul class="alert alert-danger list-unstyled">
      @foreach($errors->all() as $error)
      <li>- {{ $error }}</li>
      @endforeach
    </ul>
    @endif

    <form method="POST" action="{{ route('admin.product.update', ['id'=> $viewData['product']->getId()]) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT') 
      <div class="row">
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('products.name') }}:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="name" value="{{ $viewData['product']->getName() }}" type="text" class="form-control">
            </div>
          </div>
        </div>
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('products.price') }}:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="price" value="{{ $viewData['product']->getPrice() }}" type="number" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('products.image') }}:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input class="form-control" type="file" name="image">
            </div>
          </div>
        </div>
        <div class="col">
          &nbsp;
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">{{ __('products.description') }}</label>
        <textarea class="form-control" name="description" rows="3">{{ $viewData['product']->getDescription() }}</textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">{{ __('products.brand') }}</label>
        <input type="text" class="form-control" name="brand" value="{{ $viewData['product']->getBrand() }}">
      </div>
      <div class="mb-3">
    <label class="form-label">{{ __('products.categories') }}</label>
    @foreach($viewData['categories'] as $category)
        <div class="form-check">
            <input 
                class="form-check-input" 
                type="checkbox" 
                name="categories[]" 
                value="{{ $category->id }}" 
                id="category-{{ $category->id }}" 
                {{ $viewData['product']->categories->contains($category->id) ? 'checked' : '' }}>
            <label class="form-check-label" for="category-{{ $category->id }}">
                {{ $category->name }}
            </label>
        </div>
    @endforeach
</div>

      <button type="submit" class="btn btn-primary">{{ __('app.submit') }}</button>
    </form>
  </div>
</div>
@endsection