@extends('admin.layouts.main')

@section('content')

<div class="container-fluid p-0">
  <h1 class="display-6 mb-3">{{ $title }} </h1>

  <div class="row">
    <div class="col-lg-8">

      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="alert-message">
          {{ session('success') }}
        </div>
      </div>
      @endif

      <div class="card mb-3 py-2">
        <div class="card-header">
          <h2 class="h1 text-capitalize">
            {{ auth()->user()->firstname }}
            {{ auth()->user()->lastname }}
          </h2>
        </div>
        <div class="card-body d-flex justify-content-between">
          <div>
            <div class="py-2">
              <p class="h6 text-bold">Email Address</p>
              <p class="h3 text-muted">
                {{ auth()->user()->email }}
              </p>
            </div>
            <div class="py-2">
              <p class="h6 text-bold">Phone Number</p>
              <p class="h3 text-muted">
                {{ auth()->user()->phone }}
              </p>
            </div>
            <div class="py-2">
              <p class="h6 text-bold">Address</p>
              <p class="h3 text-muted">
                {{ auth()->user()->address }}
              </p>
            </div>
          </div>
          <div>
            <div class="py-2">
              <p class="h6 text-right text-bold">Province</p>
              <p class="h3 text-right text-muted">
                {{ auth()->user()->province }}
              </p>
            </div>
            <div class="py-2">
              <p class="h6 text-right text-bold">City</p>
              <p class="h3 text-right text-muted">
                {{ auth()->user()->city }}
              </p>
            </div>
            <div class="py-2">
              <p class="h6 text-right text-bold">Postal Code</p>
              <p class="h3 text-right text-muted">
                {{ auth()->user()->postal_code }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection