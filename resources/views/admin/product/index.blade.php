@extends('admin.layouts.main')

@section('content')

  <div class="container-fluid p-0">
    <h1 class="display-6 mb-3">{{ $title }}</h1>

    <div class="row">
      <div class="col-12 col-lg-12 col-xxl-9">

        <div class="row justify-content-between">
          <div class="col-sm-3">
            <a href="{{ route('admin.product.create') }}"
              class="btn btn-primary mb-3 d-block d-print-none"><i
                data-feather="plus"></i>Add Product</a>
          </div>
          <div class="col-sm-3">
            <a href="#" onclick="window.print()"
              class="btn btn-success mb-3 d-block d-print-none"><i
                data-feather="printer"></i>Print</a>
          </div>
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
                <th class="d-none d-xl-table-cell d-print-table-cell">Category
                </th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($products as $product)
                <tr
                  onclick="window.location.href = '{{ route('admin.product.edit', $product) }}'"
                  style="cursor: pointer;">
                  <td>{{ $product->name }}</td>
                  <td class="d-none d-xl-table-cell d-print-table-cell">
                    {{ $product->category->name }}</td>
                  <td>
                    Rp {{ number_format($product->price, '0', '', '.') }}
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
