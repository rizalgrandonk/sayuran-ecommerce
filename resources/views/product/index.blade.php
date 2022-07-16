@extends('layouts.main')

@section('content')
  <div class="hero-wrap hero-bread"
    style="background-image: url({{ asset('home-asset/images/bg_1.jpg') }});">
    <div class="container-fluid"
      style="background-color: rgba(0, 0, 0, 0.2); padding: 15em 0;">
      <div
        class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-10 ftco-animate text-center">
          <p class="breadcrumbs"><span class="mr-2"><a
                href="{{ route('home') }}">Home</a></span> <span>Products</span>
          </p>
          <h1 class="mb-0 display-3 text-light">Products</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section">
    <div class="container">
      <div class="row">
        @forelse ($products as $product)
          <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
              @if ($product->image)
                <a href="{{ route('product.show', $product) }}"
                  class="img-prod"><img class="img-fluid"
                    src="{{ $product->image }}" alt="{{ $product->name }}">
                  <div class="overlay"></div>
                </a>
              @else
                <a href="{{ route('product.show', $product) }}"
                  class="img-prod"><img class="img-fluid"
                    src="{{ asset('images/product-image/product-default.jpg') }}"
                    alt="{{ $product->name }}">
                  <div class="overlay"></div>
                </a>
              @endif
              <div class="text py-3 pb-4 px-3 text-center">
                <h3><a href="#">{{ $product->name }}</a></h3>
                <div class="d-flex">
                  <div class="pricing">
                    <p class="price">
                      <span class="price-sale">Rp
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
        @empty
          <h2>Empty</h2>
        @endforelse
      </div>
    </div>
  </section>
@endsection
