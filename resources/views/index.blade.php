@extends('layouts.main')

@section('content')

<div class="hero-wrap hero-bread" style="background-image: url({{ asset('home-asset/images/bg_3.jpg') }});">
  <div class="container-fluid" style="background-color: rgba(0, 0, 0, 0.2); padding: 15em 0;">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-12 ftco-animate text-center">
        <h1 class="mb-2 text-light">100% Fresh &amp; Organic Foods</h1>
        <h2 class="subheading mb-4 text-light">We deliver organic vegetables</h2>
        <p><a href="{{ route('product.index') }}" class="btn btn-primary">
            Shop Now
          </a></p>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section">
  <div class="container">
    <div class="row no-gutters ftco-services">
      <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
            <span class="flaticon-shipped"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Shipping</h3>
            <span>To Your Home</span>
          </div>
        </div>
      </div>
      <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
            <span class="flaticon-diet"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Always Fresh</h3>
            <span>Product Well Package</span>
          </div>
        </div>
      </div>
      <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
            <span class="flaticon-award"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Superior Quality</h3>
            <span>Quality Products</span>
          </div>
        </div>
      </div>
      <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
            <span class="flaticon-customer-service"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Support</h3>
            <span>24/7 Support</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-category ftco-no-pt">
  <div class="container">
    <div class="row justify-content-center">
      @foreach ($latestCategories as $category)
      <div class="col-md-4">
        <a href="{{ route('product.index', ['category' => $category->slug]) }}"
          class="category-wrap ftco-animate img mb-4 d-flex align-items-end"
          style="background-image: url({{ asset('storage/category-image/category-default.jpg') }})">
          <div class="text px-3 py-1">
            <h2 class="mb-0 text-white">{{ $category->name }}
            </h2>
          </div>
        </a>
      </div>
      @endforeach
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
          <a href="{{ route('product.show', $product) }}" class="img-prod"><img class="img-fluid"
              src="{{ asset('storage/' . $product->image) }}" alt="Colorlib Template"
              style="min-height:260px;max-height:260px;width:100%;object-fit: cover;">
            <div class="overlay"></div>
          </a>
          @else
          <a href="{{ route('product.show', $product) }}" class="img-prod"><img class="img-fluid"
              src="{{ asset('storage/product-image/product-default.jpg') }}" alt="Colorlib Template"
              style="min-height:260px;max-height:260px;width:100%;object-fit: cover;">
            <div class="overlay"></div>
          </a>
          @endif

          <div class="text py-3 pb-4 px-3 text-center">
            <h3><a href="{{ route('product.show', $product) }}">{{ $product->name }}</a>
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
                  <input type="hidden" name="product_id" value="{{ $product->id }}">

                  <button type="submit" class="buy-now d-flex justify-content-center align-items-center mx-1 ">
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

<section class="ftco-section img" style="background-image: url({{ asset('home-asset/images/bg_3.jpg') }});">
  <div class="container">
    <div class="row justify-content-end">
      <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">
        <span class="subheading">Best Deal For You</span>
        <h2 class="mb-4">Get fresh fruits and vegetables</h2>
        <a href="{{ route('product.index') }}" class="btn btn-primary">
          View Products
        </a>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section testimony-section">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 heading-section ftco-animate text-center">
        <span class="subheading">Testimony</span>
        <h2 class="mb-4">Our satisfied customer says</h2>
        <p>Solusi Menyediakan Hidangan Rumah Dalam Waktu Singkat</p>
      </div>
    </div>
    <div class="row ftco-animate">
      <div class="col-md-12">
        <div class="carousel-testimony owl-carousel">
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url({{ asset('home-asset/images/testi-5.PNG') }})">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5 pl-4 line">Sangat membantu dalam mempercepat
                  proses memasak.</p>
                <p class="name">Shendy Mega Rahmawati</p>
                <span class="position">Dosen</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url({{ asset('home-asset/images/testi-6.PNG') }});">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5 pl-4 line">Lebih diperbanyak lagi variasi
                  produknya, so far so good.</p>
                <p class="name">Ellista Dya Nastiti</p>
                <span class="position">Apoteker</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url({{ asset('home-asset/images/testi-3.PNG') }});">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5 pl-4 line">Pengantaran rapi dan kurirnya sopan.
                </p>
                <p class="name">Yuniar Purnama Wati</p>
                <span class="position">Ibu Rumah Tangga</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url({{ asset('home-asset/images/testi-4.PNG') }})">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5 pl-4 line">Paket menunya membantu banget,
                  tinggal cemplung terus ikutin resep yang dilampirin deh.</p>
                <p class="name">Desi R Patagiling</p>
                <span class="position">Supervisor</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url({{ asset('home-asset/images/testi-2.PNG') }})">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5 pl-4 line">Potongan sayurnya rapi, nice shot.
                </p>
                <p class="name">Anggi Akbar Reza</p>
                <span class="position">Supervisor</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

{{-- Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint asperiores quod ullam sapiente ducimus ab veritatis
natus doloribus praesentium, tempora repellat voluptatem! Nostrum illum ad eaque quis architecto, incidunt
voluptatum.Eum, amet? Necessitatibus, minima atque? Dolor accusantium provident vitae adipisci velit dicta porro
mollitia cumque consequatur in recusandae nemo, quisquam odit tempora delectus, dolore maxime doloribus suscipit odio
asperiores molestiae! --}}