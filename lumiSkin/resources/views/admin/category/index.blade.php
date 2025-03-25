{{-- Author: Manuela Castaño Franco --}}

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
    {{ __('categories.create') }}
  </div>
  <div class="card-body">
    @if($errors->any())
    <ul class="alert alert-danger list-unstyled">
      @foreach($errors->all() as $error)
      <li>- {{ $error }}</li>
      @endforeach
    </ul>
    @endif

    <form method="POST" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('app.name') }}:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="name" value="{{ old('name') }}" type="text" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">{{ __('app.description') }}</label>
        <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
      </div>
    </div>
      <button type="submit" class="btn btn-primary">{{ __('app.submit') }}</button>
    </form>
  </div>

<div class="card">
  <div class="card-header">
    {{ __('categories.manage') }}
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
        @foreach ($viewData["categories"] as $category)
        <tr>
          <td>{{ $category->getId() }}</td>
          <td>{{ $category->getName() }}</td>
          <td>
            <a class="btn btn-primary" href="{{route('admin.category.edit', ['id'=> $category->getId()])}}">
              <i class="bi-pencil"></i>
            </a>
          </td>
          <td>
            <form action="{{ route('admin.category.delete', $category->getId())}}" method="POST">
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