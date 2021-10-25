@extends('admin.layouts.main')

@section('content')

  <div class="container-fluid p-0">
    <h1 class="display-6 mb-3">{{ $title }}</h1>

    <div class="row">
      <div class="col-12 col-lg-12 col-xxl-9">

        <div class="col-sm-3">
          <a href="{{ route('admin.category.create') }}"
            class="btn btn-primary mb-3 d-block d-print-none"><i
              data-feather="plus"></i>Add Category</a>
        </div>

        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"
              aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="alert-message">
              {{ session('success') }}
            </div>
          </div>
        @endif

        <div class="card rounded-3 overflow-hidden">
          <table class="table table-hover">
            <thead class="table-dark">
              <tr>
                <th>Name</th>
                <th>Total Products</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($categories as $category)
                <tr
                  onclick="window.location.href = '{{ route('admin.category.edit', $category) }}'"
                  style="cursor: pointer;">
                  <td>{{ $category->name }}</td>
                  <td>
                    {{ count($category->products) }}
                  </td>
                </tr>
              @empty
                <h2>Empty</h2>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
