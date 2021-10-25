@extends('admin.layouts.main')

@section('content')

  <div class="container-fluid p-0">

    <h1 class="display-6 mb-3">{{ $title }}</h1>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">

            <form action="{{ route('admin.product.update', $product) }}"
              method="post" enctype="multipart/form-data">
              @method('PUT')
              @csrf

              <div class="form-group row mb-3">
                <label for="name" class="col-form-label col-sm-2">Name</label>
                <div class="col-sm-10">
                  <input type="text"
                    class="slug-from form-control @error('name') is-invalid @enderror"
                    id="name" name="name"
                    value="{{ old('name', $product->name) }}">
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
                  <input type="text" readonly
                    class="slug-field form-control @error('slug') is-invalid @enderror"
                    id="slug" name="slug"
                    value="{{ old('slug', $product->slug) }}">
                  @error('slug')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="category_id"
                  class="col-form-label col-sm-2">Category</label>
                <div class="col-sm-10">
                  <select name="category_id"
                    class="form-select @error('category_id') is-invalid @enderror">
                    <option value=""> -- Select Category -- </option>
                    @foreach ($categories as $category)
                      @if (old('category_id', $product->category_id) == $category->id)
                        <option selected value="{{ $category->id }}">
                          {{ $category->name }}
                        </option>
                      @else
                        <option value="{{ $category->id }}">
                          {{ $category->name }}
                        </option>
                      @endif
                    @endforeach
                  </select>
                  @error('category_id')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="price" class="col-form-label col-sm-2">Price</label>
                <div class="col-sm-10">
                  <input type="number"
                    class="slug-from form-control @error('price') is-invalid @enderror"
                    id="price" name="price"
                    value="{{ old('price', $product->price) }}">
                  @error('price')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-3">
                @if ($product->image)
                  <div class="img-container d-flex justify-content-end">
                    <img height="120" width="120"
                      src="{{ asset('storage/' . $product->image) }}"
                      class="img-preview mb-2 border border-dark"
                      style="object-fit: cover;">
                  </div>
                @else
                  <div class="d-none img-container justify-content-end">
                    <img height="120" width="120"
                      class="img-preview mb-2 border border-dark"
                      style="object-fit: cover;">
                  </div>
                @endif

                <label for="image" class="col-form-label col-sm-2">Image</label>
                <input type="hidden" name="oldImage"
                  value="{{ $product->sampul }}">

                <div class="col-sm-10">
                  <input onchange="previewImg();" name="image"
                    class="img-input form-control @error('image') is-invalid @enderror"
                    type="file">
                  @error('image')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="detail" class="col-form-label col-sm-2">Detail</label>
                <div class="col-sm-10">
                  <textarea name="detail"
                    class="form-control @error('detail') is-invalid @enderror"
                    id="detail"
                    rows="4">{{ old('detail', $product->detail) }}</textarea>
                  @error('detail')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              {{-- <div class="form-group row mb-3">
                <label for="image" class="col-form-label col-sm-2">
                  Image
                </label>
                <div class="col-sm-10">
                  <input type="file"
                    class="custom-file-input @error('image') is-invalid @enderror"
                    id="image" name="image" onchange="fotoLabel();">
                  @error('image')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                  <label class="custom-image-label" for="image">Pilih
                    gambar</label>
                </div>
              </div> --}}

              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-2">
                  Submit
                </button>
                <a class="btn btn-warning"
                  href="{{ route('admin.product.index') }}">
                  Cancel
                </a>
              </div>

            </form>

          </div>
        </div>
        <form action="{{ route('admin.product.destroy', $product) }}"
          method="POST">
          @method('DELETE')
          @csrf

          <button onclick="return confirm('Are You Sure ?')" type="submit"
            class="btn btn-lg btn-danger rounded mb-3">Delete
            Product</button>
        </form>
      </div>
    </div>
  </div>

@endsection


@section('script')
  <script src="{{ asset('admin-asset/js/imagePreview.js') }}"></script>
  <script src="{{ asset('admin-asset/js/generateSlug.js') }}"></script>
@endsection


{{-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, commodi! Delectus sit, assumenda qui natus cupiditate ducimus esse, fugiat enim voluptatum consequuntur non dolor mollitia atque? Sint, molestiae suscipit? Ea?Sit perspiciatis facilis inventore quo! Magni quae non animi asperiores reprehenderit quo dolor voluptas laudantium repudiandae ea sunt porro, ducimus ut deleniti obcaecati dolorem totam eum aspernatur quasi aut cum? --}}
