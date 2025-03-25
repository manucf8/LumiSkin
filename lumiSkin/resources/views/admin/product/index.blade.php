{{-- Author: Juan Jose Restrepo Hernandez  --}}

@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="card mb-4">
  <div class="card-header">
  {{ __('products.create') }}
  </div>
  <div class="card-body">
    @if($errors->any())
    <ul class="alert alert-danger list-unstyled">
      @foreach($errors->all() as $error)
      <li>- {{ $error }}</li>
      @endforeach
    </ul>
    @endif

    <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('products.name') }}:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="name" value="{{ old('name') }}" type="text" class="form-control">
            </div>
          </div>
        </div>
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('products.price') }}:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="price" value="{{ old('price') }}" type="number" class="form-control">
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
        <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">{{ __('products.brand') }}</label>
        <input type="text" class="form-control" name="brand" value="{{ old('brand') }}">
      </div>
      <div class="mb-3">
      <label class="form-label">{{ __('products.categories') }}</label>
      <div>
          @foreach($viewData['categories'] as $category)
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category-{{ $category->id }}">
                  <label class="form-check-label" for="category-{{ $category->id }}">
                      {{ $category->name }}
                  </label>
              </div>
          @endforeach
      </div>
    </div>
      <button type="submit" class="btn btn-primary">{{ __('app.submit') }}</button>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-header">
  {{ __('products.manage') }}
  </div>
  <div class="card-body">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th scope="col">{{ __('app.id') }}</th>
          <th scope="col">{{ __('app.name') }}</th>
          <th scope="col">{{ __('app.edit') }}</th>
          <th scope="col">{{ __('app.delete') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($viewData["products"] as $product)
        <tr>
          <td>{{ $product->getId() }}</td>
          <td>{{ $product->getName() }}</td>
          <td>
            <a class="btn btn-primary" href="{{route('admin.product.edit', ['id'=> $product->getId()])}}">
              <i class="bi-pencil"></i>
            </a>
          </td>
          <td>
            <form action="{{ route('admin.product.delete', $product->getId())}}" method="POST">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger">
                <i class="bi-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection