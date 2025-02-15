<div>
    @php
        $variations = [];
        $hasVariations = false;
        foreach ($product->variations as $key => $variation) {
            if ($variation->type !== '') {
                if ($variation->thumbnail) {
                    $variations[PRODUCT_VARIATIONS[$variation->type]]['thumbs'][] = $variation;
                } else {
                    $variations[PRODUCT_VARIATIONS[$variation->type]]['options'][] = $variation;
                }
            }
        }
        $hasVariations = count($variations);
    @endphp

    <div class="container" x-data="{
        default_currency: @js($default_currency),
        product: @js($product),
        qty: $wire.entangle('qty'),
        hasVariations: @js($hasVariations),
        validateVariation: @js($hasVariations),
        variations: {{ json_encode($variations) }},
        price: 0,
        discount: 0,
        formatCurrency(amount, currencyCode = 'PKR') {
            const currencySymbols = {
                AED: 'د.إ', // UAE Dirham
                AFN: '؋', // Afghan Afghani
                ALL: 'L', // Albanian Lek
                AMD: '֏', // Armenian Dram
                ANG: 'ƒ', // Netherlands Antillean Guilder
                AOA: 'Kz', // Angolan Kwanza
                ARS: '$', // Argentine Peso
                AUD: 'A$', // Australian Dollar
                AWG: 'ƒ', // Aruban Florin
                AZN: '₼', // Azerbaijani Manat
                BAM: 'KM', // Bosnia-Herzegovina Convertible Mark
                BBD: 'Bds$', // Barbadian Dollar
                BDT: '৳', // Bangladeshi Taka
                BGN: 'лв', // Bulgarian Lev
                BHD: '.د.ب', // Bahraini Dinar
                BIF: 'FBu', // Burundian Franc
                BMD: 'BD$', // Bermudian Dollar
                BND: 'B$', // Brunei Dollar
                BOB: 'Bs.', // Bolivian Boliviano
                BRL: 'R$', // Brazilian Real
                BSD: 'B$', // Bahamian Dollar
                BTN: 'Nu.', // Bhutanese Ngultrum
                BWP: 'P', // Botswana Pula
                BYN: 'Br', // Belarusian Ruble
                BZD: 'BZ$', // Belize Dollar
                CAD: 'C$', // Canadian Dollar
                CDF: 'FC', // Congolese Franc
                CHF: 'CHF', // Swiss Franc
                CLP: '$', // Chilean Peso
                CNY: '¥', // Chinese Yuan
                COP: '$', // Colombian Peso
                CRC: '₡', // Costa Rican Colón
                CUP: '₱', // Cuban Peso
                CVE: 'Esc', // Cape Verdean Escudo
                CZK: 'Kč', // Czech Koruna
                DJF: 'Fdj', // Djiboutian Franc
                DKK: 'kr', // Danish Krone
                DOP: 'RD$', // Dominican Peso
                DZD: 'دج', // Algerian Dinar
                EGP: 'E£', // Egyptian Pound
                ERN: 'Nfk', // Eritrean Nakfa
                ETB: 'Br', // Ethiopian Birr
                EUR: '€', // Euro
                FJD: 'FJ$', // Fijian Dollar
                FKP: '£', // Falkland Islands Pound
                GBP: '£', // British Pound
                GEL: '₾', // Georgian Lari
                GHS: 'GH₵', // Ghanaian Cedi
                GIP: '£', // Gibraltar Pound
                GMD: 'D', // Gambian Dalasi
                GNF: 'FG', // Guinean Franc
                GTQ: 'Q', // Guatemalan Quetzal
                GYD: 'GY$', // Guyanese Dollar
                HKD: 'HK$', // Hong Kong Dollar
                HNL: 'L', // Honduran Lempira
                HRK: 'kn', // Croatian Kuna
                HTG: 'G', // Haitian Gourde
                HUF: 'Ft', // Hungarian Forint
                IDR: 'Rp', // Indonesian Rupiah
                ILS: '₪', // Israeli New Shekel
                INR: '₹', // Indian Rupee
                IQD: 'ع.د', // Iraqi Dinar
                IRR: '﷼', // Iranian Rial
                ISK: 'kr', // Icelandic Króna
                JMD: 'J$', // Jamaican Dollar
                JOD: 'JD', // Jordanian Dinar
                JPY: '¥', // Japanese Yen
                KES: 'KSh', // Kenyan Shilling
                KGS: 'с', // Kyrgyzstani Som
                KHR: '៛', // Cambodian Riel
                KMF: 'CF', // Comorian Franc
                KPW: '₩', // North Korean Won
                KRW: '₩', // South Korean Won
                KWD: 'KD', // Kuwaiti Dinar
                KYD: 'CI$', // Cayman Islands Dollar
                KZT: '₸', // Kazakhstani Tenge
                LAK: '₭', // Lao Kip
                LBP: 'ل.ل', // Lebanese Pound
                LKR: 'Rs', // Sri Lankan Rupee
                LRD: 'L$', // Liberian Dollar
                LSL: 'L', // Lesotho Loti
                LYD: 'LD', // Libyan Dinar
                MAD: 'د.م.', // Moroccan Dirham
                MDL: 'L', // Moldovan Leu
                MGA: 'Ar', // Malagasy Ariary
                MKD: 'ден', // Macedonian Denar
                MMK: 'K', // Myanmar Kyat
                MNT: '₮', // Mongolian Tögrög
                MOP: 'MOP$', // Macanese Pataca
                MUR: '₨', // Mauritian Rupee
                MVR: 'Rf', // Maldivian Rufiyaa
                MWK: 'MK', // Malawian Kwacha
                MXN: '$', // Mexican Peso
                MYR: 'RM', // Malaysian Ringgit
                MZN: 'MT', // Mozambican Metical
                NAD: 'N$', // Namibian Dollar
                NGN: '₦', // Nigerian Naira
                NIO: 'C$', // Nicaraguan Córdoba
                NOK: 'kr', // Norwegian Krone
                NPR: 'Rs', // Nepalese Rupee
                NZD: 'NZ$', // New Zealand Dollar
                OMR: '﷼', // Omani Rial
                PAB: 'B/.', // Panamanian Balboa
                PEN: 'S/.', // Peruvian Sol
                PGK: 'K', // Papua New Guinean Kina
                PHP: '₱', // Philippine Peso
                PKR: '₨', // Pakistani Rupee
                PLN: 'zł', // Polish Złoty
                PYG: '₲', // Paraguayan Guaraní
                QAR: '﷼', // Qatari Riyal
                RON: 'lei', // Romanian Leu
                RSD: 'дин', // Serbian Dinar
                RUB: '₽', // Russian Ruble
                RWF: 'FRw', // Rwandan Franc
                SAR: '﷼', // Saudi Riyal
                SBD: 'SI$', // Solomon Islands Dollar
                SCR: '₨', // Seychellois Rupee
                SDG: 'ج.س', // Sudanese Pound
                SEK: 'kr', // Swedish Krona
                SGD: 'S$', // Singapore Dollar
                SYP: '£', // Syrian Pound
                THB: '฿', // Thai Baht
                TRY: '₺', // Turkish Lira
                TWD: 'NT$', // New Taiwan Dollar
                USD: '$', // US Dollar
                VND: '₫', // Vietnamese Đồng
                ZAR: 'R' // South African Rand
            };
    
            let symbol = currencySymbols[currencyCode] || currencyCode;
            return symbol + Number(amount).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        },
        afterAmount(selectedVars) {
            var vars = {};
            var self = this;
            var amount = 0;
            var final = this.processAmount();
    
            $.each(this.variations, function(type, nVars) {
                $.each(nVars, function(index, nvariation) {
                    $.each(nvariation, function(index, variation) {
                        if (selectedVars[variation.id] && variation.hasPrice) {
                            vars[variation.id] = variation;
                            amount += final / 100 * variation.hasPrice;
                        }
                    });
                });
            });
    
            final = final + amount;
    
            if (self.discount) {
                self.discount = self.formatCurrency(final, self.default_currency);
            } else {
                self.price = self.formatCurrency(final, self.default_currency);
            }
    
            return final;
        },
        selectedVars(event) {
            var classes = 'border border-primary border-width-3';
            var elem = $(event.target);
            var hasClass = $(event.target).attr('name');
            $('.' + hasClass).removeClass(classes);
            if (elem.is(':checked')) {
                elem.parent().addClass(classes);
            }
        },
        validateVars() {
            var i = 0;
            var self = this;
            var variations = {};
            var exVariations = {};
            $('[name*=\'variation-\']').each(function(index, element) {
                if ($(element).find('option').is(':selected') || $(element).is(':checked')) {
                    var id = $(element).attr('name');
                    var val = $(element).val();
                    variations[id] = val;
                    exVariations[val] = val;
                    i++
                }
            });
            if (i == this.hasVariations) {
                $('.add-to-cart-btn').removeClass('disabled')
                this.validateVariation = false;
                $wire.set('variations', variations, false);
            } else {
                $('.add-to-cart-btn').addClass('disabled')
                this.validateVariation = true;
            }
    
            var final = this.afterAmount(exVariations);
            $wire.set('final', final, false);
        },
        async addToCart() {
            $('.add-to-cart-btn').addClass('disabled');
    
            await $wire.addToCart();
    
            $('.add-to-cart-btn').removeClass('disabled');
    
            this.qty = 1;
    
            $('[class*=\'variation-\']').each(function(index, element) {
                var classes = 'border border-primary border-width-3';
                $(element).prop('checked', false);
                $(element).removeClass(classes);
            });
    
            if (this.hasVariations) {
                this.validateVariation = true;
            }
        },
        processAmount() {
            this.price = this.product.amount * this.qty;
            this.price = this.formatCurrency(this.price, this.default_currency);
            var discount = 0;
            var amount = this.product.amount;
            if (this.product.discountType == 1) {
                discount = (amount / 100) * this.product.discountData;
                discount = amount - discount;
            } else if (this.product.discountType == 2) {
                discount = this.product.discountData;
            }
            this.discount = this.formatCurrency(discount, this.default_currency);;
            if (discount) {
                return discount * this.qty;
            }
            return amount * this.qty;
        },
        extractCurrency(amount) {
            let number = amount.replace(/[^\d.-]/g, ''); // Remove non-numeric characters except dot and minus
            return parseFloat(number);
        },
    
        init() {
            this.validateVars();
        }
    }">
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
                        <div class="mb-4">
                            <template x-if="discount">
                                <div class="d-flex align-items-baseline">
                                    <ins class="font-size-36 text-decoration-none" x-text="discount"></ins>
                                    <del class="font-size-20 ml-2 text-gray-6" x-text="price"></del>
                                </div>
                            </template>
                            <template x-if="!discount">
                                <div class="d-flex align-items-baseline">
                                    <ins class="font-size-36 text-decoration-none" x-text="price"></ins>
                                </div>
                            </template>
                        </div>

                        <div class="d-flex flex-wrap" style="gap: 20px">
                            <template x-for="(variation, type) in variations" :key="type">
                                <div class="border-top border-bottom py-3 mb-4">
                                    <template x-if="variation.thumbs">
                                        <div>
                                            <h6 class="font-size-14 font-weight-bolder" x-text="type"></h6>
                                            <div class="d-flex flex-wrap" style="gap: 20px">
                                                <label :for="'variation-0'" :class="'variation-' + type"
                                                    class="media border border-primary border-width-3">

                                                    <div class="width-75 height-75">
                                                        <img class="img-fluid object-fit-cover" :src="product.thumbnail"
                                                            alt="Image Description">
                                                    </div>

                                                    <input hidden :id="'variation-0'" type="radio" checked
                                                        :value="0" :name="'variation-' + type"
                                                        @change="selectedVars($event),validateVars()">
                                                </label>
                                                <template x-for="(value, key) in variation.thumbs"
                                                    :key="value.id">
                                                    <label :for="'variation-' + value.id" :class="'variation-' + type"
                                                        class="media">

                                                        <div class="width-75 height-75">
                                                            <img class="img-fluid object-fit-cover"
                                                                :src="value.thumbnail" alt="Image Description">
                                                        </div>

                                                        <input hidden :id="'variation-' + value.id" type="radio"
                                                            :value="value.id" :name="'variation-' + type"
                                                            @change="selectedVars($event),validateVars()">
                                                    </label>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                    <template x-if="variation.options">
                                        <div>
                                            <h6 class="font-size-14 font-weight-bolder" x-text="type"></h6>
                                            <select :name="'variation-' + type" @change="validateVars()"
                                                class="js-select selectpicker dropdown-select"
                                                data-style="btn-sm bg-white font-weight-normal py-2 border">
                                                <option value="0">Stock</option>
                                                <template x-for="(option, key) in variation.options"
                                                    :key="key">
                                                    <option :value="option.id" x-text="option.data"></option>
                                                </template>
                                            </select>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </div>

                        <div class="d-md-flex align-items-end mb-3">
                            <div class="max-width-150 mb-4 mb-md-0">
                                <h6 class="font-size-14 font-weight-bolder">Quantity</h6>
                                <!-- Quantity -->
                                <div class="border rounded-pill py-2 px-3 border-color-1">
                                    <div class="js-quantity row align-items-center">
                                        <div class="col">
                                            <input x-model="qty"
                                                class="js-result form-control h-auto border-0 rounded p-0 shadow-none"
                                                type="text" value="1">
                                        </div>
                                        <div class="col-auto pr-1">
                                            <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                href="javascript:;" @click="qty == 1?qty = 1:qty--;validateVars()">
                                                <small class="fas fa-minus btn-icon__inner"></small>
                                            </a>
                                            <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                href="javascript:;" @click="qty++;validateVars()">
                                                <small class="fas fa-plus btn-icon__inner"></small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Quantity -->
                            </div>
                            <div class="ml-md-3">
                                <a @click="addToCart()" href="javascript:;"
                                    class="btn px-5 btn-primary-dark transition-3d-hover add-to-cart-btn"><i
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
                            href="#product-specs-tab" role="tab" aria-controls="Jpills-four-example1"
                            aria-selected="false">Specification</a>
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

                    @include('livewire.public.partials.product.specification')

                    @include('livewire.public.partials.product.reviews')

                </div>
            </div>
            <!-- End Tab Content -->
        </div>
        <!-- End Single Product Tab -->

    </div>
</div>
