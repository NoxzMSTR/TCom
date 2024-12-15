<div>
    <div class="container">
        <!-- Single Product Body -->
        <div class="mb-xl-14 mb-6">
            <div class="row">
                <div class="col-md-5 mb-4 mb-md-0">
                    <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2" data-infinite="true"
                        data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
                        data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
                        data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
                        data-nav-for="#sliderSyncingThumb">
                        @foreach ($product->assets as $key => $asset)
                            <div class="js-slide">
                                <img class="img-fluid" src="{{ asset($asset->path) }}" alt="Image Description">
                            </div>
                        @endforeach

                    </div>

                    <div id="sliderSyncingThumb"
                        class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off"
                        data-infinite="true" data-slides-show="5" data-is-thumbs="true"
                        data-nav-for="#sliderSyncingNav">
                        @foreach ($product->assets as $key => $asset)
                            <div class="js-slide" style="cursor: pointer;">
                                <img class="img-fluid" src="{{ asset($asset->path) }}" alt="Image Description">
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-7 mb-md-6 mb-lg-0">
                    <div class="mb-2">
                        <div class="border-bottom mb-3 pb-md-1 pb-3">
                            <a href="#"
                                class="font-size-12 text-gray-5 mb-2 d-inline-block">{{ $product->categories->name }}</a>
                            <h2 class="font-size-25 text-lh-1dot2">{{ $product->name }}</h2>
                            <div class="mb-2">
                                <a class="d-inline-flex align-items-center small font-size-15 text-lh-1" href="#">
                                    <div class="text-warning mr-2">
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="far fa-star text-muted"></small>
                                    </div>
                                    <span class="text-secondary font-size-13">(3 customer reviews)</span>
                                </a>
                            </div>
                            <div class="d-md-flex align-items-center">
                                @if ($product->brand)
                                    <a href="#" class="max-width-10 ml-n2 mb-2 mb-md-0 d-block"><img
                                            class="img-fluid" src="{{ $product->brand->thumbnail }}"
                                            alt="Image Description"></a>
                                @endif
                                @if ($product->qty)
                                    <div class="ml-md-3 text-gray-9 font-size-14">Availability: <span
                                            class="text-green font-weight-bold">{{ $product->qty }} in stock</span>
                                    </div>
                                @else
                                    <div class="ml-md-3 text-danger font-size-14">Out of stock</div>
                                @endif

                            </div>
                        </div>
                        {{-- <div class="flex-horizontal-center flex-wrap mb-4">
                            <a href="#" class="text-gray-6 font-size-13 mr-2"><i
                                    class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                            <a href="#" class="text-gray-6 font-size-13 ml-2"><i
                                    class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                        </div> --}}
                        <div class="mb-2">
                            {!! $product->shortDescription !!}
                        </div>

                        <p><strong>SKU</strong>: {{ $product->sku }}</p>
                        @php
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
                        @endphp
                        <div class="mb-4">
                            @if ($discount)
                                <div class="d-flex align-items-baseline">
                                    <ins class="font-size-36 text-decoration-none">{{ $discount }}</ins>
                                    <del class="font-size-20 ml-2 text-gray-6">{{ $price }}</del>
                                </div>
                            @else
                                <div class="d-flex align-items-baseline">
                                    <ins class="font-size-36 text-decoration-none">{{ $price }}</ins>
                                </div>
                            @endif

                        </div>
                        @php
                            $variations = [];
                            foreach ($product->variations as $key => $variation) {
                                $variations[PRODUCT_VARIATIONS[$variation->type]][] = $variation;
                            }
                        @endphp
                        <div class="d-flex flex-wrap" style="gap: 20px">
                            @foreach ($variations as $type => $variation)
                                <div class="border-top border-bottom py-3 mb-4">
                                    <div class="d-flex align-items-center">
                                        <h6 class="font-size-14 mb-0">{{ $type }}</h6>
                                        <!-- Select -->
                                        <select class="js-select selectpicker dropdown-select ml-3"
                                            data-style="btn-sm bg-white font-weight-normal py-2 border">
                                            <option value="">None</option>
                                            @foreach ($variation as $key => $value)
                                                <option value="{{ $value->data }}">{{ $value->data }}</option>
                                            @endforeach

                                        </select>
                                        <!-- End Select -->
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-md-flex align-items-end mb-3">
                            <div class="max-width-150 mb-4 mb-md-0">
                                <h6 class="font-size-14">Quantity</h6>
                                <!-- Quantity -->
                                <div class="border rounded-pill py-2 px-3 border-color-1">
                                    <div class="js-quantity row align-items-center">
                                        <div class="col">
                                            <input
                                                class="js-result form-control h-auto border-0 rounded p-0 shadow-none"
                                                type="text" value="1">
                                        </div>
                                        <div class="col-auto pr-1">
                                            <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                href="javascript:;">
                                                <small class="fas fa-minus btn-icon__inner"></small>
                                            </a>
                                            <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                href="javascript:;">
                                                <small class="fas fa-plus btn-icon__inner"></small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Quantity -->
                            </div>
                            <div class="ml-md-3">
                                <a wire:click="$dispatchTo('public.cart.global-cart', 'add-to-cart', { product: {{ $product->id }} })"
                                    href="javascript:;" class="btn px-5 btn-primary-dark transition-3d-hover"><i
                                        class="ec ec-add-to-cart cursor-pointer-on  mr-2 font-size-20"></i> Add to
                                    Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Product Body -->
        <!-- Single Product Tab -->
        <div class="mb-8">
            <div class="position-relative position-md-static px-md-6">
                <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0"
                    id="pills-tab-8" role="tablist">
                    <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                        <a class="nav-link active" id="Jpills-two-example1-tab" data-toggle="pill"
                            href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1"
                            aria-selected="false">Description</a>
                    </li>
                    <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                        <a class="nav-link" id="Jpills-four-example1-tab" data-toggle="pill"
                            href="#Jpills-four-example1" role="tab" aria-controls="Jpills-four-example1"
                            aria-selected="false">Reviews</a>
                    </li>
                </ul>
            </div>
            <!-- Tab Content -->
            <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                <div class="tab-content" id="Jpills-tabContent">

                    @include('livewire.public.partials.product.description')

                    @include('livewire.public.partials.product.reviews')

                </div>
            </div>
            <!-- End Tab Content -->
        </div>
        <!-- End Single Product Tab -->

    </div>
</div>
