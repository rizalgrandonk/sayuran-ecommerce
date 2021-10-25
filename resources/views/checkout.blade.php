@extends('layouts.main')

@section('content')

<div class="hero-wrap hero-bread" style="background-image: url({{ asset('home-asset/images/bg_2.jpg') }});">
  <div class="container-fluid" style="background-color: rgba(0, 0, 0, 0.2); padding: 15em 0;">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-10 ftco-animate text-center">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span>Checkout</span>
        </p>
        <h1 class="mb-0 display-3 text-light">Checkout</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center">

      <div class="col-xl-7 ftco-animate">
        <h3 class="mb-4 billing-heading">Your Billing Information</h3>

        <div class="row align-items-end">
          <div class="col-md-6">
            <div class="form-group">
              <label for="firstname">First Name</label>
              <input type="text" name="firstname" required class="form-control" style="color:black !important"
                placeholder="" id="firstname" value="{{ auth()->user()->firstname }}" disabled>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="lastname">Last Name</label>
              <input type="text" name="lastname" required class="form-control" style="color:black !important"
                placeholder="" id="lastname" value="{{ auth()->user()->lastname }}" disabled>
            </div>
          </div>
          <div class="w-100"></div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" name="email" required class="form-control" style="color:black !important"
                placeholder="" id="email" value="{{ auth()->user()->email }}" disabled>
            </div>
          </div>
          <div class="w-100"></div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="address">Detail Address</label>
              <input type="text" name="address" required class="form-control" style="color:black !important"
                placeholder="" id="address" value="{{ auth()->user()->address }}" disabled>
            </div>
          </div>
          <div class="w-100"></div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="province">Province</label>
              <input type="text" name="province" required class="form-control" style="color:black !important"
                placeholder="" id="province" value="{{ auth()->user()->province }}" disabled>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="city">City</label>
              <input type="text" name="city" required class="form-control" style="color:black !important" placeholder=""
                id="city" value="{{ auth()->user()->city }}" disabled>
            </div>
          </div>
          <div class="w-100"></div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="postal_code">Postal Code</label>
              <input type="text" name="postal_code" required class="form-control" style="color:black !important"
                placeholder="" id="postal_code" value="{{ auth()->user()->postal_code }}" disabled>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input type="text" name="phone" required class="form-control" style="color:black !important"
                placeholder="" id="phone" value="{{ auth()->user()->phone }}" disabled>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-5">
        <div class="row mt-5 pt-3">

          <div class="col-md-12">
            <div class="form-group" id="delivery-section">
              <label for="delivery">Delivery Option</label>
              <select name="delivery" id="delivery" required
                class="form-control @error('delivery-cost') is-invalid @enderror" style="color:black !important">
                <option value=""> -- Select Delivery Option -- </option>
                @foreach ($listCost as $cost)
                <option value="{{ $cost['cost'][0]['value'] }}__{{ $cost['service'] }}">
                  JNE {{ $cost['service'] }}
                </option>
                @endforeach
              </select>
              @error('delivery-cost')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="col-md-12 d-flex mb-3">
            <div class="cart-detail cart-total p-3 p-md-4">
              <h3 class="billing-heading mb-4">Cart Total</h3>

              <div id="checkout-detail">
                <p class="d-flex">
                  <span>Subtotal</span>
                  <span>{{ $subtotal }}</span>
                </p>
              </div>
              <hr>
              <p class="d-flex total-price">
                <span>Total</span>
                <span class="total">{{ $total }}</span>
              </p>

              <button class="btn btn-primary py-3 px-4" id="pay-btn" type="button">
                {{-- <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Processing... --}}
                Place Order
              </button>
            </div>
          </div>
        </div>
      </div> <!-- .col-md-8 -->

    </div>

  </div>

  </div>
</section> <!-- .section -->

<form id="finish-form" action="{{ route('admin.checkout.finish') }}" method="post" style="display: hidden;">
  @csrf

  <input type="hidden" name="result-data">
  <input type="hidden" name="delivery-cost">
  <input type="hidden" name="delivery-service">
</form>

@endsection

@section('script')

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-ZK2Q4mMwnOvnPZFO"></script>

<script>
  $(document).ready(function() {
      $('#pay-btn').click(function(e) {
        e.preventDefault();

        let deliveryCost = $('input[name="delivery-cost"]').val()
        let deliveryService = $('input[name="delivery-service"]').val()

        if (!deliveryCost) {
          $('select[name="delivery"]').addClass('is-invalid')
          $('#delivery-section').append(
            `<div class="invalid-feedback">
              Select an option
            </div>`
          )
          return
        }

        $('#pay-btn').prop('disabled', true);
        $('#pay-btn').html(
          `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Processing`
        )

        $.ajax({
          url: `/admin/checkout/token?delivery_cost=${deliveryCost}&delivery_service=${deliveryService}`,
          type: "GET",
          dataType: "json",
          success: function(response) {
            console.log(response)
            snap.pay(response.token, {
              onSuccess: function(result) {
                $('input[name="result-data"]').val(JSON
                  .stringify(result, null, 2))
                $('input[name="delivery-cost"]').val(deliveryCost)
                $('input[name="delivery-service"]').val(deliveryService)
                $('#finish-form').submit()
              },
              onPending: function(result) {
                $('input[name="result-data"]').val(JSON
                  .stringify(result, null, 2))
                $('input[name="delivery-cost"]').val(deliveryCost)
                $('input[name="delivery-service"]').val(deliveryService)
                $('#finish-form').submit()
              },
              onError: function(result) {
                $('input[name="result-data"]').val(JSON
                  .stringify(result, null, 2))
                $('input[name="delivery-cost"]').val(deliveryCost)
                $('input[name="delivery-service"]').val(deliveryService)
                $('#finish-form').submit()
              }
            });
          },
          error: function(response) {
            console.log(response)
          },
        });

      })
    })
</script>

<script>
  $('select[name="delivery"]').on('change', function() {
      let deliveryValues = $(this).val().split('__')
      let deliveryCost = deliveryValues[0]
      let deliveryService = deliveryValues[1]

      if ($('#delivery-cost')) {
        $('#delivery-cost').remove()
      }

      $('#checkout-detail').append(
        `<p class="d-flex" id="delivery-cost">
          <span>Delivery</span>
          <span>${deliveryCost}</span>
        </p>`
      )

      $('input[name="delivery-cost"]').val(deliveryCost)
      $('input[name="delivery-service"]').val(`JNE ${deliveryService}`)
      let subtotal = parseInt($('span.total').text())
      let delivery = parseInt(deliveryCost)
      $('span.total').text(`${subtotal + delivery}`)
    })
</script>

@endsection