<footer>
    <!-- Footer-newsletter -->
    <div class="bg-primary py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-md-3 mb-lg-0">
                    <div class="row align-items-center">
                        <div class="col-auto flex-horizontal-center">
                            <i class="ec ec-newsletter font-size-40"></i>
                            <h2 class="font-size-20 mb-0 ml-3">Sign up to Newsletter</h2>
                        </div>
                        <div class="col my-4 my-md-0">
                            <h5 class="font-size-15 ml-4 mb-0">...and receive <strong>$20 coupon for first
                                    shopping.</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Subscribe Form -->
                    <form class="js-validate js-form-message">
                        <label class="sr-only" for="subscribeSrEmail">Email address</label>
                        <div class="input-group input-group-pill">
                            <input type="email" class="form-control border-0 height-40" name="email"
                                id="subscribeSrEmail" placeholder="Email address" aria-label="Email address"
                                aria-describedby="subscribeButton" required
                                data-msg="Please enter a valid email address.">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-dark btn-sm-wide height-40 py-2"
                                    id="subscribeButton">Sign Up</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Subscribe Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer-newsletter -->
    @php
        $logoLight = isset(system_config['logoLight']['value'])
            ? system_config['logoLight']['value']
            : asset('mAssets/media/logos/logo.jpg');
        $logoDark = isset(system_config['logoDark']['value'])
            ? system_config['logoDark']['value']
            : asset('mAssets/media/logos/logo.jpg');
    @endphp
    <!-- Footer-bottom-widgets -->
    <div class="pt-8 pb-4 bg-gray-13">
        <div class="container mt-1">
            <div class="row">
                <div class="col-lg-10">
                    <div class="mb-6">
                        <a href="{{ route('public.home') }}" class="d-inline-block">
                            <img alt="Logo" src="{{ $logoLight }}" class="h-35px theme-light-show"
                                style="width:156px " />
                        </a>
                    </div>
                    <div class="mb-4">
                        <div class="row no-gutters">
                            <div class="col-auto">
                                <i class="ec ec-support text-primary font-size-56"></i>
                            </div>
                            <div class="col pl-3">
                                <div class="font-size-13 font-weight-light">Got questions? Call us 24/7!</div>
                                <a href="tel:{{ isset(system_config['phone']['value']) ? system_config['phone']['value'] : '-' }}"
                                    class="font-size-20 text-gray-90">{{ isset(system_config['phone']['value']) ? system_config['phone']['value'] : '-' }},
                                </a><a
                                    href="mailto:{{ isset(system_config['email']['value']) ? system_config['email']['value'] : '-' }}"
                                    class="font-size-20 text-gray-90">{{ isset(system_config['email']['value']) ? system_config['email']['value'] : '-' }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h6 class="mb-1 font-weight-bold">Contact info</h6>
                        <address class="">
                            {{ isset(system_config['address']['value']) ? system_config['address']['value'] : '-' }}
                        </address>
                    </div>
                    <div class="my-4 my-md-4">
                        <ul class="list-inline mb-0 opacity-7">
                            @if (isset(system_config['facebook']['value']))
                                <li class="list-inline-item mr-0">
                                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle"
                                        href="{{ system_config['facebook']['value'] }}">
                                        <span class="fab fa-facebook-f btn-icon__inner"></span>
                                    </a>
                                </li>
                            @endif
                            @if (isset(system_config['google']['value']))
                                <li class="list-inline-item mr-0">
                                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle"
                                        href="{{ system_config['google']['value'] }}">
                                        <span class="fab fa-google btn-icon__inner"></span>
                                    </a>
                                </li>
                            @endif
                            @if (isset(system_config['instagram']['value']))
                                <li class="list-inline-item mr-0">
                                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle"
                                        href="{{ system_config['instagram']['value'] }}">
                                        <span class="fab fa-instagram btn-icon__inner"></span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-12 col-md mb-4 mb-md-0">
                            <h6 class="mb-3 font-weight-bold">Customer Care</h6>
                            <!-- List Group -->
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                <li><a class="list-group-item list-group-item-action" href="../shop/my-account.html">My
                                        Account</a></li>
                                <li><a class="list-group-item list-group-item-action"
                                        href="../shop/track-your-order.html">Order Tracking</a></li>
                                <li><a class="list-group-item list-group-item-action" href="../shop/wishlist.html">Terms
                                        & Conditions</a></li>
                                <li><a class="list-group-item list-group-item-action"
                                        href="../home/terms-and-conditions.html">Contact Us</a></li>
                                <li><a class="list-group-item list-group-item-action"
                                        href="../home/terms-and-conditions.html">About us</a></li>
                                <li><a class="list-group-item list-group-item-action" href="../home/faq.html">Privacy
                                        Policy</a>
                                </li>

                            </ul>
                            <!-- End List Group -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer-bottom-widgets -->
    <!-- Footer-copy-right -->
    <div class="bg-gray-14 py-2">
        <div class="container">
            <div class="flex-center-between d-block d-md-flex">
                <div class="mb-3 mb-md-0">© <a href="{{ route('public.home') }}"
                        class="font-weight-bold text-gray-90">{{ isset(system_config['name']['value']) ? system_config['name']['value'] : '-' }}</a>
                    - All
                    rights Reserved</div>

            </div>
        </div>
    </div>
    <!-- End Footer-copy-right -->
</footer>
