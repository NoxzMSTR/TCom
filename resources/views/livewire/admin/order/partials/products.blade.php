<div class="card card-flush py-4">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h2>Select Products</h2>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <div class="d-flex flex-column gap-10">
            <!--begin::Input group-->
            <div>
                <!--begin::Label-->
                <label class="form-label">Add products to this order</label>
                <!--end::Label-->

                <!--begin::Selected products-->
                <div class="row row-cols-1 row-cols-xl-3 row-cols-md-2 border border-dashed rounded pt-3 pb-1 px-2 mb-5 mh-300px overflow-scroll"
                    id="">

                    @forelse ($products as $key => $product)
                        @php
                            $variations = [];
                            if (isset($product['variations'])) {
                                foreach ($product['variations'] as $vKey => $variation) {
                                    if (isset(PRODUCT_VARIATIONS[$variation['type']])) {
                                        $variations[PRODUCT_VARIATIONS[$variation['type']]][] = $variation;
                                    }
                                }
                            }

                        @endphp

                        <div class="col my-2">
                            <div
                                class="d-flex align-items-center border border-dashed rounded p-3 bg-body position-relative">
                                <div class="ms-5">
                                    <!--begin::Title-->
                                    <p class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $product['name'] }}</p>
                                    <!--end::Title-->


                                    <div class="fw-semibold fs-7">Price
                                    </div>

                                    <input class="form-control form-control-sm" placeholder="Price" type="number"
                                        wire:model='products.{{ $key }}.amount'>

                                    @error('products.' . $key . '.amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    <div class="fw-semibold fs-7">Qty
                                    </div>

                                    <input class="form-control form-control-sm" placeholder="Qty" type="number"
                                        wire:model.fill='products.{{ $key }}.qty' value="1">

                                    @error('products.' . $key . '.qty')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    @foreach ($variations as $type => $variationData)
                                        <div class="fw-semibold fs-7">Select {{ $type }} </div>
                                        <select class="form-select mb-2"
                                            wire:model.fill='products.{{ $key }}.variationID'>>
                                            <option value="0">None</option>
                                            @foreach ($variationData as $vKey => $value)
                                                <option value="{{ $value['id'] }}"
                                                    {{ isset($product['variationID']) ? 'selected' : '' }}>
                                                    {{ $value['data'] }}</option>
                                            @endforeach
                                        </select>

                                        @error('products.' . $key . '.variationID')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    @endforeach

                                </div>
                                <span wire:click='deleteProduct({{ $key }})'
                                    class="position-absolute top-0 start-100 translate-middle badge badge-circle badge-danger cursor-pointer">x</span>
                            </div>


                        </div>
                    @empty
                        <!--begin::Empty message-->
                        <span class="w-100 text-muted ">Select one or more products from the list below by
                            ticking the checkbox.</span>
                        <!--end::Empty message-->
                    @endforelse
                    @error('products')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <!--begin::Selected products-->

                <!--begin::Total price-->
                <div class="fw-bold fs-4">
                    Total Cost:
                    <span id="kt_ecommerce_edit_order_total_price">
                        0.00
                    </span>
                </div>
                <!--end::Total price-->
            </div>
            <!--end::Input group-->

            <!--begin::Separator-->
            <div class="separator"></div>
            <!--end::Separator-->

            <!--begin::Search products-->
            <div class="d-flex align-items-center position-relative mb-n7 ">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4"><span class="path1"></span><span
                        class="path2"></span></i> <input type="text" wire:model.live='search'
                    class="form-control form-control-solid w-100 w-lg-50 ps-12" placeholder="Search Products">
            </div>
            <!--end::Search products-->

            <!--begin::Table-->
            @if ($search)
                <div class="dt-container dt-bootstrap5 dt-empty-footer">
                    <div class="table-responsive">
                        <div class="dt-scroll">
                            <div class="dt-scroll-head"
                                style="overflow: hidden; position: relative; border: 0px; width: 100%;">
                                <div class="dt-scroll-headInner" style="box-sizing: content-box; padding-right: 12px;">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable"
                                        style="margin-left: 0px;">
                                        <thead>
                                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0"
                                                role="row">

                                                <th data-dt-column="1" rowspan="1" colspan="1"
                                                    aria-label="Product: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">Product</span><span
                                                        class="dt-column-order"></span>
                                                </th>
                                                <th class="text-end pe-5" data-dt-column="2" rowspan="1"
                                                    colspan="1" aria-label="Qty Remaining: Activate to sort"
                                                    tabindex="0"><span class="dt-column-title" role="button">Qty
                                                        Remaining</span><span class="dt-column-order"></span></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="dt-scroll-body" style="position: relative; overflow: auto; max-height: 400px;">
                                <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable"
                                    style="width: 100%;">

                                    <tbody class="fw-semibold text-gray-600">
                                        @forelse ($this->searchData as $key => $value)
                                            <tr class="border-bottom border-dashed border-gray-300 border-hover border-top cursor-pointer rounded-3"
                                                wire:click='setProduct({{ $value }})'>
                                                <td>
                                                    @php
                                                        $thumbnail = asset('mAssets/media/avatars/thumbnail.jpg');
                                                        if ($value->thumbnail) {
                                                            $thumbnail = $value->thumbnail;
                                                        }
                                                    @endphp
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Thumbnail-->
                                                        <div class="symbol symbol-50px">
                                                            <span class="symbol-label"
                                                                style="background-image:url({{ $thumbnail }});"></span>
                                                        </div>
                                                        <!--end::Thumbnail-->

                                                        <div class="ms-5">
                                                            <!--begin::Title-->
                                                            <p class="text-gray-800 text-hover-primary fs-5 fw-bold">
                                                                {{ $value->name }}</p>
                                                            <!--end::Title-->

                                                            <!--begin::Price-->
                                                            <div class="fw-semibold fs-7">Price:
                                                                <span>{{ number_format($value->amount, 2, '.', '') }}</span>
                                                            </div>
                                                            <!--end::Price-->

                                                            <!--begin::SKU-->
                                                            <div class="text-muted fs-7">SKU: {{ $value->sku }}</div>
                                                            <!--end::SKU-->
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end pe-5 dt-type-numeric">
                                                    <span class="fw-bold ms-3">{{ $value->qty }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td></td>
                                                <td colspan="2">No Products Found</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            @endif

            <!--end::Table-->
        </div>
    </div>
    <!--end::Card header-->
</div>
