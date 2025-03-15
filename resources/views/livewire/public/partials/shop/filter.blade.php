<div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
    <div class="mb-6">
        <div class="border-bottom border-color-1 mb-5">
            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Filters</h3>
        </div>
        <div class="border-bottom pb-4 mb-4">
            <h4 class="font-size-14 mb-3 font-weight-bold">Brands</h4>
            @php
                $exBrands = [];
                foreach ($brands as $key => $value) {
                    if ($key > 5) {
                        $exBrands[1][] = $value;
                    } else {
                        $exBrands[0][] = $value;
                    }
                }
            @endphp
            @if (isset($exBrands[0]))
                <!-- Checkboxes -->
                @foreach ($exBrands[0] as $key => $value)
                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input"
                                wire:model='filter.brand.{{ $value->id }}' id="brand{{ $value->id }}"
                                value="{{ $value->id }}">
                            <label class="custom-control-label" for="brand{{ $value->id }}">{{ $value->name }}
                                <span class="text-gray-25 font-size-12 font-weight-normal">
                                    ({{ $value->products_count }})
                                </span>
                            </label>
                        </div>
                    </div>
                @endforeach
                <!-- End Checkboxes -->
            @endif

            @if (isset($exBrands[1]))
                <!-- View More - Collapse -->
                <div class="collapse" id="collapseBrand">
                    @foreach ($exBrands[1] as $key => $value)
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="brand{{ $value->id }}"
                                    wire:model='filter.brand.{{ $value->id }}' value="{{ $value->id }}">
                                <label class="custom-control-label" for="brand{{ $value->id }}">{{ $value->name }}
                                    <span class="text-gray-25 font-size-12 font-weight-normal">
                                        ({{ $value->products_count }})
                                    </span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- End View More - Collapse -->

                <!-- Link -->
                <a class="link link-collapse small font-size-13 text-gray-27 d-inline-flex mt-2" data-toggle="collapse"
                    href="#collapseBrand" role="button" aria-expanded="false" aria-controls="collapseBrand">
                    <span class="link__icon text-gray-27 bg-white">
                        <span class="link__icon-inner">+</span>
                    </span>
                    <span class="link-collapse__default">Show more</span>
                    <span class="link-collapse__active">Show less</span>
                </a>
                <!-- End Link -->
            @endif

        </div>
        @php
            $exVariations = [];
            foreach ($variations as $key => $value) {
                if ($value->type !== '') {
                    if ($key > 3) {
                        $exVariations[$value->type][1][] = $value;
                    } else {
                        $exVariations[$value->type][0][] = $value;
                    }
                }
            }
        @endphp

        @foreach ($exVariations as $type => $typeData)
            <div class="border-bottom pb-4 mb-4">
                <h4 class="font-size-14 mb-3 font-weight-bold">
                    {{ isset(PRODUCT_VARIATIONS[$type]) ? PRODUCT_VARIATIONS[$type] : '-' }}</h4>
                @if (isset($typeData[1]))
                    <!-- Checkboxes -->
                    @foreach ($typeData[0] as $key => $value)
                        <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"
                                    id="category{{ md5($value->data) }}"
                                    wire:model='filter.variation.{{ $type }}.{{ $value->data }}'
                                    value="{{ $value->data }}">
                                <label class="custom-control-label"
                                    for="category{{ md5($value->data) }}">{{ $value->data }}
                                    <span class="text-gray-25 font-size-12 font-weight-normal">
                                        ({{ $value->products_count }})
                                    </span></label>
                            </div>
                        </div>
                    @endforeach
                    <!-- End Checkboxes -->
                @endif
                @if (isset($typeData[1]))
                    <!-- View More - Collapse -->
                    <div class="collapse" id="collapse{{ PRODUCT_VARIATIONS[$type] }}">
                        @foreach ($typeData[1] as $key => $value)
                            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input"
                                        id="category{{ md5($value->data) }}"
                                        wire:model='filter.variation.{{ $type }}.{{ $value->data }}'
                                        value="{{ $value->data }}">
                                    <label class="custom-control-label"
                                        for="category{{ md5($value->data) }}">{{ $value->data }} <span
                                            class="text-gray-25 font-size-12 font-weight-normal">
                                            ({{ $value->products_count }})
                                        </span></label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- End View More - Collapse -->

                    <!-- Link -->
                    <a class="link link-collapse small font-size-13 text-gray-27 d-inline-flex mt-2"
                        data-toggle="collapse" href="#collapse{{ PRODUCT_VARIATIONS[$type] }}" role="button"
                        aria-expanded="false" aria-controls="collapse{{ PRODUCT_VARIATIONS[$type] }}">
                        <span class="link__icon text-gray-27 bg-white">
                            <span class="link__icon-inner">+</span>
                        </span>
                        <span class="link-collapse__default">Show more</span>
                        <span class="link-collapse__active">Show less</span>
                    </a>
                    <!-- End Link -->
                @endif

            </div>
        @endforeach

        <div class="border-bottom pb-4 mb-4">
            <h4 class="font-size-14 mb-3 font-weight-bold">Set your price range</h4>
            <!-- Checkboxes -->
            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                <div class="align-items-center input-group-append" style="gap: 15px;">
                    <label class="form-label" for="Min">
                        Min
                    </label>
                    <input type="number" class="form-control form-control-sm" id="min"
                        wire:model='filter.price.min' placeholder="Enter Min Price">

                </div>
            </div>
            <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                <div class="align-items-center input-group-append" style="gap: 15px;">
                    <label class="form-label" for="max">
                        Max
                    </label>
                    <input type="number" class="form-control form-control-sm" id="max"
                        wire:model='filter.price.max' placeholder="Enter Max Price">

                </div>
            </div>
            <!-- End Checkboxes -->


        </div>
        <button type="button" wire:click='setFilter(true)'
            class="btn px-4 btn-primary-dark-w py-2 rounded-lg">Filter</button>
    </div>
</div>
