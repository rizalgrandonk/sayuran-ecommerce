@extends('layouts.main')

@section('content')

<div class="hero-wrap hero-bread" style="background-image: url({{ asset('home-asset/images/bg_1.jpg') }});">
  <div class="container-fluid" style="background-color: rgba(0, 0, 0, 0.2); padding: 15em 0;">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-10 ftco-animate text-center">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home</a></span> <span>Cart</span>
        </p>
        <h1 class="mb-0 display-3 text-light">Cart</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row">
      <div class="col-md-12 ftco-animate">
        <div class="cart-list">
          <table class="table">
            <thead class="thead-primary">
              <tr class="text-center">
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>Product name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($cart as $product)
              <tr class="text-center">
                <td class="product-remove">
                  <form action="{{ route('cart.delete') }}" method="POST">
                    @csrf

                    <input type="hidden" name="rowId" value="{{ $product->rowId }}">
                    <button type="submit" class="form-control" style="cursor: pointer;">
                      <span class="ion-ios-close"></span>
                    </button>
                  </form>
                </td>

                <td class="image-prod">
                  <div class="img" style="background-image:url({{ $product->options['image'] }});">
                  </div>
                </td>

                <td class="product-name">
                  <h3>{{ $product->name }}</h3>
                </td>

                <td class="price">Rp
                  {{ number_format($product->price, 0, ',', '.') }}</td>

                <td class="quantity">
                  <form action="{{ route('cart.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="rowId" value="{{ $product->rowId }}">

                    <div class="input-group mb-3">
                      <input type="number" name="quantity" class="quantity form-control input-number"
                        value="{{ $product->qty }}" min="1" max="100">
                    </div>
                    <button type="submit" class="btn btn-primary py-2">Save</button>
                  </form>
                </td>

                <td class="total">
                  Rp
                  {{ number_format($product->price * $product->qty, 0, ',', '.') }}
                </td>
              </tr><!-- END TR-->

              @empty
              <tr class="text-center">
                <td class="product-name">
                  <h4>Cart Empty</h4>
                </td>
              </tr>
              @endforelse

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row justify-content-end">
      <div class="col-lg-5 mt-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
          <h3>Cart Totals</h3>
          <p class="d-flex">
            <span>Subtotal</span>
            <span class="text-right">
              Rp {{ number_format($subtotal, 0, ',', '.') }}
            </span>
          </p>
          <hr>
          <p class="d-flex total-price">
            <span>Total</span>
            <span class="text-right">
              Rp {{ number_format($total, 0, ',', '.') }}
            </span>
          </p>
        </div>
        <p class="text-center">
          <a href="{{ route('admin.checkout.index') }}" class="btn btn-primary py-3 px-4">
            Proceed to Checkout
          </a>
        </p>
      </div>
    </div>
  </div>
</section>

@endsection