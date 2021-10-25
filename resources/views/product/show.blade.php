@extends('layouts.main')

@section('content')

  <section class="ftco-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mb-5 ftco-animate">
          @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
              class="img-fluid" alt="{{ $product->name }}">
          @else
            <img src="{{ asset('storage/product-image/product-default.jpg') }}"
              class="img-fluid" alt="{{ $product->name }}">
          @endif
        </div>

        <div class="col-lg-6 product-details pl-md-5 ftco-animate">
          <h3>{{ $product->name }}</h3>
          <div class="rating d-flex">
            <p class="text-left">
              <a href="#" class="mr-2" style="color: #000;">500 <span
                  style="color: #bbb;">Sold</span></a>
            </p>
          </div>
          <p class="price"><span>Rp
              {{ number_format($product->price, 0, ',', '.') }}</span></p>
          <p>
            {{ $product->detail }}
          </p>

          @if ($cart->where('id', $product->id)->count())
            <h5>Already In Cart</h5>
          @else

            <form action="{{ route('cart.store') }}" method="POST">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">

              <div class="row mt-4">
                <div class="input-group col-md-6 d-flex mb-3">
                  <span class="input-group-btn mr-2">
                    <button type="button" class="quantity-left-minus btn"
                      data-type="minus" data-field="">
                      <i class="ion-ios-remove"></i>
                    </button>
                  </span>
                  <input type="text" id="quantity" value="1" name="quantity"
                    class="form-control input-number" min="1" max="100">
                  <span class="input-group-btn ml-2">
                    <button type="button" class="quantity-right-plus btn"
                      data-type="plus" data-field="">
                      <i class="ion-ios-add"></i>
                    </button>
                  </span>
                </div>
              </div>
              <p>
                <button type="submit" class="btn btn-black py-3 px-5">
                  Add to Cart
                </button>
              </p>
            </form>

          @endif
        </div>


      </div>
    </div>
  </section>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-3 pb-3">
        <div class="col-md-12 heading-section text-center ftco-animate">
          <span class="subheading">Latest Products</span>
          <h2 class="mb-4">Our Products</h2>
          <p>Solusi Menyediakan Hidangan Rumah Dalam Waktu Singkat</p>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">

        @foreach ($latestProducts as $product)
          <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
              @if ($product->image)
                <a href="{{ route('product.show', $product) }}"
                  class="img-prod"><img class="img-fluid"
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="Colorlib Template"
                    style="min-height:260px;max-height:260px;width:100%;">
                  <div class="overlay"></div>
                </a>
              @else
                <a href="{{ route('product.show', $product) }}"
                  class="img-prod"><img class="img-fluid"
                    src="{{ asset('storage/product-image/product-default.jpg') }}"
                    alt="Colorlib Template"
                    style="min-height:260px;max-height:260px;width:100%;">
                  <div class="overlay"></div>
                </a>
              @endif

              <div class="text py-3 pb-4 px-3 text-center">
                <h3><a
                    href="{{ route('product.show', $product) }}">{{ $product->name }}</a>
                </h3>
                <div class="d-flex">
                  <div class="pricing" style="text-align:center;">
                    <p class="price"><span>Rp
                        {{ number_format($product->price, 0, ',', '.') }}</span>
                    </p>
                  </div>
                </div>
                @if (!$cart->where('id', $product->id)->count())
                  <div class="bottom-area d-flex px-3">
                    <div class="m-auto d-flex">
                      <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="product_id"
                          value="{{ $product->id }}">

                        <button type="submit"
                          class="buy-now d-flex justify-content-center align-items-center mx-1 ">
                          <span><i class="ion-ios-cart"></i> Add To Cart</span>
                        </button>
                      </form>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </section>

@endsection

@section('script')

  <script>
    $(document).ready(function() {

      var quantity = 0;
      $('.quantity-right-plus').click(function(e) {

        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());

        // If is not undefined

        $('#quantity').val(quantity + 1);


        // Increment

      });

      $('.quantity-left-minus').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());

        // If is not undefined

        // Increment
        if (quantity > 0) {
          $('#quantity').val(quantity - 1);
        }
      });
    });
  </script>

@endsection
