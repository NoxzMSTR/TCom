<div>
    <div class="container">
        <div class="mb-4 mb-md-6 text-center">
            <h1>Site Map</h1>
        </div>
        <div class="mb-8">
            <div class="row no-gutters ec-store-directory align-items-start">
                <ul class="col-md-3 border-top border-color-1 mb-4 mb-md-0">
                    <li><a href="{{ route('public.home') }}">Home</a>
                        <ul>
                            <li><a href="{{ route('public.shop') }}">Shop</a></li>
                            <li><a href="{{ route('public.cart') }}">Cart</a></li>
                            <li><a href="{{ route('public.checkout') }}">Checkout</a></li>
                            <li><a href="{{ route('public.about-us') }}">About Us</a></li>
                            <li><a href="{{ route('public.contact-us') }}">Contact Us</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="col-md-3 border-top border-color-1 mb-4 mb-md-0">
                    <li><strong>Documents</strong>
                        <ul>
                            <li><a href="{{ route('public.terms-n-conditions') }}">Terms & Conditions</a></li>
                            <li><a href="{{ route('public.privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('public.refund-policy') }}">Refund Policy</a></li>
                            <li><a href="{{ route('public.cancellation-policy') }}">Cancellation Policy</a></li>
                            <li><a href="{{ route('public.shipping-policy') }}">Shipping Policy</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="col-md-3 border-top border-color-1 mb-4 mb-md-0">
                    <li><strong>Accounts</strong>
                        <ul>
                            <li><a href="{{ route('public.account') }}">My Account</a></li>
                            <li><a href="{{ route('public.orders') }}">My Orders</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>

    </div>
</div>
