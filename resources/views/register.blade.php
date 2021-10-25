@extends('layouts.main')

@section('content')

<div class="hero-wrap hero-bread" style="background-image: url({{ asset('home-asset/images/bg_2.jpg') }});">
  <div class="container-fluid" style="background-color: rgba(0, 0, 0, 0.2); padding: 15em 0;">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-10 ftco-animate text-center">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span>Register</span>
        </p>
        <h1 class="mb-0 display-3 text-light">Register</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 ftco-animate">
        <h3 class="mb-4 billing-heading">Register</h3>

        <form action="{{ route('auth.store') }}" class="billing-form" id="form-register" method="post">
          @csrf
          <input type="hidden" name="province" value="">
          <input type="hidden" name="city" value="">
          <input type="hidden" name="province_id" value="">
          <input type="hidden" name="city_id" value="">

          <div class="row align-items-end">
            <div class="col-md-6">
              <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" required
                  class="form-control @error('firstname') is-invalid @enderror" style="color:black !important"
                  placeholder="" id="firstname" value="{{ old('firstname') }}">
                @error('firstname')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" required class="form-control @error('lastname') is-invalid @enderror"
                  style="color:black !important" placeholder="" id="lastname" value="{{ old('lastname') }}">
                @error('lastname')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" required class="form-control @error('email') is-invalid @enderror"
                  style="color:black !important" placeholder="" id="email" value="{{ old('email') }}">
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
                  class="form-control @error('password') is-invalid @enderror" style="color:black !important"
                  placeholder="" id="password">
                @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="address">Detail Address</label>
                <input type="text" name="address" required class="form-control @error('address') is-invalid @enderror"
                  style="color:black !important" placeholder="Street Name, House Number, ect" id="address"
                  value="{{ old('address') }}">
                @error('address')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="province_list">Province</label>
                <select name="province_list" id="province_list" required
                  class="form-control @error('province_id') is-invalid @enderror" style="color:black !important">
                  <option value=""> -- Select Province -- </option>
                  @foreach ($listProvince as $province)
                  <option value="{{ $province['province_id'] }}__{{ $province['province'] }}">
                    {{ $province['province'] }}
                  </option>
                  @endforeach
                </select>
                @error('province_id')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="city_list">City</label>
                <select required name="city_list" id="city_list"
                  class="form-control @error('city_id') is-invalid @enderror" style="color:black !important">
                  <option value=""> -- Select City -- </option>
                </select>
                @error('city_id')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="w-100"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="text" name="postal_code" required
                  class="form-control @error('postal_code') is-invalid @enderror" style="color:black !important"
                  placeholder="" id="postal_code" value="{{ old('postal_code') }}">
                @error('postal_code')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" required class="form-control @error('phone') is-invalid @enderror"
                  style="color:black !important" placeholder="" id="phone" value="{{ old('phone') }}">
                @error('phone')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="w-100"></div>
          <button class="d-block mx-auto btn btn-primary py-3 px-4" style="width:70% !important;">Register</button>
        </form>
      </div>
    </div>

  </div>

  </div>
</section> <!-- .section -->

@endsection


@section('script')

<script>
  $('select[name="province_list"]').on('change', function() {
      let provinceValues = $(this).val().split("__")
      $('input[name="province"]').val(provinceValues[1])
      $('input[name="province_id"]').val(provinceValues[0])
      let provinceId = provinceValues[0]
      if (provinceId) {
        $.ajax({
          url: '/cities?province_id=' + provinceId,
          type: "GET",
          dataType: "json",
          success: function(response) {
            $('select[name="city_list"]').empty();
            $('select[name="city_list"]').append(
              '<option value=""> -- Select City -- </option>');

            $.each(response, function(key, value) {
              $('select[name="city_list"]').append(
                `<option value="${value.city_id}__${value.type} ${value.city_name}">
                   ${value.type} ${value.city_name} 
                  </option>`
              );
            });
          },
        });
      } else {
        $('select[name="city_list"]').append(
          '<option value=""> -- Select City -- </option>');
      }
    });

    $('select[name="city_list"]').on('change', function() {
      let cityValues = $(this).val().split("__")
      $('input[name="city"]').val(cityValues[1])
      $('input[name="city_id"]').val(cityValues[0])
    });
</script>

@endsection