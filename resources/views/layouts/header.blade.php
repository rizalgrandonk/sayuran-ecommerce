<div class="py-1 bg-primary">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center">
                            <span class="icon-phone2"></span>
                        </div>
                        <span class="text">+62 812-9163-4919</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center">
                            <span class="icon-paper-plane"></span>
                        </div>
                        <span class="text">trikurniawan02091998@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Sok Kabeh</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>

                <li class="nav-item {{ Request::routeIs('product*') ? 'active' : '' }}">
                    <a href="{{ route('product.index') }}" class="nav-link">Shop</a>
                </li>
                <li class="nav-item {{ Request::routeIs('about') ? 'active' : '' }}">
                    <a href="{{ route('about') }}" class="nav-link">About</a>
                </li>

                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">{{ auth()->user()->firstname }}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="{{ route('admin.profile.transaction') }}">Order
                            Transaction</a>
                        <a class="dropdown-item" href="{{ route('admin.profile.index') }}">Profile</a>
                        <form action="{{ route('admin.logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item" style="cursor: pointer">
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
                @endauth

                @guest
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                @endguest

                <li class="nav-item cta cta-colored">
                    <a href="{{ route('cart.index') }}" class="nav-link">
                        <span class="icon-shopping_cart"></span>
                        <span id="cart-count">
                            [{{ Gloudemans\Shoppingcart\Facades\Cart::content()->count() }}]
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>