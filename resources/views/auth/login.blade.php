@extends('layouts.main')

@section('content')

  <div class="hero-wrap hero-bread"
    style="background-image: url({{ asset('home-asset/images/bg_3.jpg') }});">
    <div class="container-fluid"
      style="background-color: rgba(0, 0, 0, 0.2); padding: 15em 0;">
      <div
        class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-10 ftco-animate text-center">
          <p class="breadcrumbs"><span class="mr-2"><a
                href="{{ route('home') }}">Home</a></span> <span>Login</span>
          </p>
          <h1 class="mb-0 display-3 text-light">Login</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-10 ftco-animate">

          @if (session()->has('success'))
            <div class="alert alert-primary alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="alert-message">
                {{ session('success') }}
              </div>
            </div>
          @endif

          @if (session()->has('status'))
            <div class="alert alert-primary alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="alert-message">
                {{ session('status') }}
              </div>
            </div>
          @endif

          @if (session()->has('login-error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert"
                aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="alert-message">
                {{ session('login-error') }}
              </div>
            </div>
          @endif

          <h3 class="mb-4 billing-heading">Login</h3>

          <form action="{{ route('authenticate') }}" class="billing-form"
            id="form-register" method="post">
            @csrf

            <div class="row align-items-end">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" required autofocus
                    class="form-control @error('email') is-invalid @enderror"
                    style="color:black !important" placeholder="" id="email"
                    value="{{ old('email') }}">
                  @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" required
                    class="form-control @error('password') is-invalid @enderror"
                    style="color:black !important" placeholder="" id="password">
                  @error('password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="w-100"></div>
            <button class="d-block mx-auto btn btn-primary py-3 px-4"
              style="width:70% !important;">Login</button>
          </form>

          <p class="mt-4 text-center">Need an account ? <a
              href="{{ route('register') }}">Register
              Now</a></p>
          <p class="mt-4 text-center"><a
              href="{{ route('password.request') }}">
              Forgot My Password
            </a></p>
        </div>
      </div>

    </div>

    </div>
  </section> <!-- .section -->

@endsection
