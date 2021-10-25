@extends('admin.layouts.main')

@section('content')

<div class="container-fluid p-0">

  <h1 class="display-6 mb-3">{{ $title }}</h1>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">

          <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="form-group row mb-3">
              <label for="name" class="col-form-label col-sm-2">Name</label>
              <div class="col-sm-10">
                <input type="text" class="slug-from form-control @error('name') is-invalid @enderror" id="name"
                  name="name" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-3">
              <label for="slug" class="col-form-label col-sm-2">Slug</label>
              <div class="col-sm-10">
                <input type="text" readonly class="slug-field form-control @error('slug') is-invalid @enderror"
                  id="slug" name="slug" value="{{ old('slug') }}">
                @error('slug')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-3">
              <div class="d-none img-container justify-content-end">
                <img height="120" width="120" class="img-preview mb-2 border border-dark" style="object-fit: cover;">
              </div>

              <label for="image" class="col-form-label col-sm-2">Image</label>
              <div class="col-sm-10">
                <input onchange="previewImg();" name="image"
                  class="img-input form-control @error('image') is-invalid @enderror" type="file">
                @error('image')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>

            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-primary mr-2">
                Submit
              </button>
              <a class="btn btn-warning" href="{{ route('admin.category.index') }}">
                Cancel
              </a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection


@section('script')
<script src="{{ asset('admin-asset/js/imagePreview.js') }}"></script>
<script src="{{ asset('admin-asset/js/generateSlug.js') }}"></script>
@endsection


{{-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, commodi! Delectus sit, assumenda qui natus cupiditate
ducimus esse, fugiat enim voluptatum consequuntur non dolor mollitia atque? Sint, molestiae suscipit? Ea?Sit
perspiciatis facilis inventore quo! Magni quae non animi asperiores reprehenderit quo dolor voluptas laudantium
repudiandae ea sunt porro, ducimus ut deleniti obcaecati dolorem totam eum aspernatur quasi aut cum? --}}