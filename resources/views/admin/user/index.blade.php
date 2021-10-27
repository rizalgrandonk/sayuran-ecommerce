@extends('admin.layouts.main')

@section('content')

  <div class="container-fluid p-0">
    <h1 class="display-6 mb-3">{{ $title }}</h1>

    <div class="row">
      <div class="col-12 col-lg-12 col-xxl-9">

        {{-- <div class="row justify-content-between">
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
        </div> --}}

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

        @error('is_admin')
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"
              aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="alert-message">
              {{ $message }}
            </div>
          </div>
        @enderror

        <div class="card rounded-3 overflow-hidden">
          <table class="table table-hover">
            <thead class="table-dark">
              <tr>
                <th>Name</th>
                <th class="d-print-none d-none d-xl-table-cell">Email</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($users as $user)
                <tr>
                  <td>{{ $user->firstname }}</td>
                  <td class="d-print-none d-none d-xl-table-cell">
                    {{ $user->email }}</td>
                  <td>
                    @if ($user->id == auth()->user()->id)
                      <span class="badge bg-secondary">Current User</span>
                    @elseif($user->is_admin)
                      <span class="badge bg-success">Admin</span>
                    @else
                      <span class="badge bg-primary bg-lg">Regular User</span>
                    @endif
                  </td>
                  <td>
                    @if ($user->id !== auth()->user()->id)
                      <form action="{{ route('admin.user.role', $user) }}"
                        method="POST">
                        @method('PUT')
                        @csrf

                        @if ($user->is_admin)
                          <input type="hidden" name="is_admin" value="0">
                          <button type="submit" class="btn btn-primary btn-sm">
                            Set To Regular User
                          </button>
                        @else
                          <input type="hidden" name="is_admin" value="1">
                          <button type="submit" class="btn btn-success btn-sm">
                            Set To Admin
                          </button>
                        @endif
                      </form>

                    @endif
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
