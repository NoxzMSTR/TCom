<div class="col-xl-9 col-wd-9gdot5">
    <!-- Shop-control-bar Title -->
    <div class="flex-center-between mb-3">
        <h3 class="font-size-25 mb-0">Shop</h3>
        <p class="font-size-14 text-gray-90 mb-0">Showing 1–25 of 56 results</p>
    </div>
    <!-- End shop-control-bar Title -->
    <!-- Shop-control-bar -->
    <div class="bg-gray-1 flex-center-between borders-radius-9 py-1">
        <div class="d-xl-none">
            <!-- Account Sidebar Toggle Button -->
            <a id="sidebarNavToggler1" class="btn btn-sm py-1 font-weight-normal" href="javascript:;" role="button"
                aria-controls="sidebarContent1" aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarContent1"
                data-unfold-type="css-animation" data-unfold-animation-in="fadeInLeft"
                data-unfold-animation-out="fadeOutLeft" data-unfold-duration="500">
                <i class="fas fa-sliders-h"></i> <span class="ml-1">Filters</span>
            </a>
            <!-- End Account Sidebar Toggle Button -->
        </div>
        <div class="px-3 d-none d-xl-block">
            <ul class="nav nav-tab-shop" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1"
                        role="tab" aria-controls="pills-one-example1" aria-selected="false">
                        <div class="d-md-flex justify-content-md-center align-items-md-center">
                            <i class="fa fa-th"></i>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
        <div class="d-flex">

            <!-- Select -->
            <select class="form-control mr-3" wire:model.live.debounce.300ms='filter.sort'
                data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                <option value="0" selected>Default sorting</option>
                <option value="1">Sort by popularity</option>
                {{-- <option value="2">Sort by average rating</option> --}}
                <option value="3">Sort by latest</option>
                <option value="4">Sort by price: low to high</option>
                <option value="5">Sort by price: high to low</option>
            </select>
            <!-- End Select -->


            <!-- Select -->
            <select class="form-control" wire:model.live.debounce.300ms='filter.totalPages'
                data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                <option value="20" selected>Show 20</option>
                <option value="40">Show 40</option>
                <option value="60">Show 60</option>
            </select>
            <!-- End Select -->

        </div>
        {{-- <nav class="px-3 flex-horizontal-center text-gray-20 d-none d-xl-flex">
            <form method="post" class="min-width-50 mr-1">
                <input size="2" min="1" max="3" step="1" type="number"
                    class="form-control text-center px-2 height-35" value="1">
            </form> of 3
            <a class="text-gray-30 font-size-20 ml-2" href="#">→</a>
        </nav> --}}
    </div>
    <!-- End Shop-control-bar -->
    <!-- Shop Body -->
    <!-- Tab Content -->
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel"
            aria-labelledby="pills-one-example1-tab" data-target-group="groups">
            <ul class="row list-unstyled products-group no-gutters">
                @foreach ($products as $key => $product)
                    <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                        <div class="product-item__outer h-100">
                            <div class="product-item__inner px-xl-4 p-3">
                                <div class="product-item__body pb-xl-2">
                                    <div class="mb-2"><a href="../shop/product-categories-7-column-full-width.html"
                                            class="font-size-12 text-gray-5">{{ $product->categories->name }}</a></div>
                                    <h5 class="mb-1 product-item__title"><a
                                            href="{{ route('public.product', [$product->id, $product->name]) }}"
                                            class="text-blue font-weight-bold">{{ $product->name }}</a></h5>
                                    <div class="mb-2">
                                        <a href="{{ route('public.product', [$product->id, $product->name]) }}"
                                            class="d-block text-center"><img class="img-fluid"
                                                src="{{ $product->thumbnail }}" alt="Image Description"></a>
                                    </div>
                                    <div class="flex-center-between mb-1">
                                        @php
                                            if (isset($default_currency)) {
                                                $price = currency_format($product->amount, $default_currency);
                                                $discount = 0;
                                                $amount = $product->amount;
                                                if ($product->discountType == 1) {
                                                    $discount = ($amount / 100) * $product->discountData;
                                                    $discount = $amount - $discount;
                                                    $discount = currency_format($discount, $default_currency);
                                                } elseif ($product->discountType == 2) {
                                                    $discount = $product->discountData;
                                                    $discount = currency_format($discount, $default_currency);
                                                }
                                            } else {
                                                $discount = 0;
                                                $price = $product->amount;
                                            }

                                        @endphp
                                        <div class="prodcut-price">
                                            @if ($discount)
                                                <div class="d-flex align-items-baseline flex-wrap">
                                                    <ins class="text-decoration-none">{{ $discount }}</ins>
                                                    <del class="ml-2 text-gray-6">{{ $price }}</del>
                                                </div>
                                            @else
                                                <div class="d-flex align-items-baseline flex-wrap">
                                                    <ins class="text-decoration-none">{{ $price }}</ins>
                                                </div>
                                            @endif

                                        </div>
                                        <div class="d-none d-xl-block prodcut-add-cart">
                                            <a wire:click="$dispatchTo('public.cart.global-cart', 'add-to-cart', { product: {{ $product->id }} })"
                                                class="btn-add-cart btn-primary transition-3d-hover"><i
                                                    class="ec ec-add-to-cart cursor-pointer-on "></i></a>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="product-item__footer">
                                    <div class="border-top pt-2 flex-center-between flex-wrap">
                                        <a href="../shop/compare.html" class="text-gray-6 font-size-13"><i
                                                class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                        <a href="../shop/wishlist.html" class="text-gray-6 font-size-13"><i
                                                class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </li>
                @endforeach


            </ul>
        </div>
    </div>
    <!-- End Tab Content -->
    <!-- End Shop Body -->
    <!-- Shop Pagination -->
    {{ $products->links('livewire.public.partials.shop.pagination') }}

    <!-- End Shop Pagination -->
</div>
