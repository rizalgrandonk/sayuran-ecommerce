<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
    <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
            <div class="col-md-6">
                <h2 style="font-size: 22px;" class="mb-0">Start Today</h2>
                <span>Get the best quality product</span>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Register Now</a>
            </div>
        </div>
    </div>
</section>
<footer class="ftco-footer ftco-section">
    <div class="container">
        <div class="row">
            <div class="mouse">
                <a href="#" class="mouse-icon">
                    <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span>
                    </div>
                </a>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md">
                <div class="ftco-footer-widget">
                    <h2 class="ftco-heading-2">SOK KABEH</h2>
                    <p>Perfect solution for your cooking session</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                        <li class="ftco-animate"><a href="#"><span class="icon-whatsapp"></span></a></li>
                        <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md">
                <div class="ftco-footer-widget text-right">
                    <h2 class="ftco-heading-2">Menu</h2>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('product.index') }}" class="py-2 d-block">Shop</a>
                        </li>
                        <li><a href="{{ route('about') }}" class="py-2 d-block">About</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="ftco-footer-widget py-3 border-top">
                    <p class="mb-0 text-muted text-center">
                        &copy; Sok Kabeh 2021
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>