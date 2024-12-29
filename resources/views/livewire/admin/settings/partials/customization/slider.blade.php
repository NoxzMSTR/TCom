<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Sliders</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div class="collapse show">
        <!--begin::Card body-->
        <div class="card-body border-top p-9">

            <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                <!--begin::Repeater-->
                <div id="variations">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div data-repeater-list="variations" class="d-flex flex-column gap-3">
                            @foreach ($sliders as $key => $slider)
                                <div class="align-items-center d-flex gap-2 justify-content-between">
                                    @if (isset($slider['image']) && $slider['image'] !== null && $slider['image'] !== '')
                                        <div>
                                            <label class="form-check-image">
                                                <div class="form-check-wrapper">
                                                    <img class="h-175px" src="{{ $slider['image']->temporaryUrl() }}" />
                                                </div>
                                            </label>
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    wire:model='sliders.{{ $key }}.setBackground' />
                                                <span class="form-check-label fw-semibold text-muted">
                                                    Make it Background
                                                </span>
                                            </label>
                                        </div>
                                    @elseif(isset($slider['showImage']))
                                        <div>
                                            <label class="form-check-image">
                                                <div class="form-check-wrapper">
                                                    <img class="h-175px" src="{{ $slider['showImage'] }}" />
                                                </div>
                                            </label>
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    wire:model='sliders.{{ $key }}.setBackground' />
                                                <span class="form-check-label fw-semibold text-muted">
                                                    Make it Background
                                                </span>
                                            </label>
                                        </div>
                                    @endif

                                    <div class="w-100">
                                        <div data-repeater-item
                                            class="form-group d-flex flex-wrap flex-md-nowrap align-items-center gap-5">

                                            <div class="w-100 d-flex flex-wrap gap-5 flex-column">
                                                <!--begin::Input-->
                                                <input type="text" class="form-control "
                                                    wire:model='sliders.{{ $key }}.title'
                                                    placeholder="Enter Title">
                                                <!--end::Input-->
                                                @error('sliders.' . $key . '.title')
                                                    <span class="text-danger fw-bold">{{ $message }}</span>
                                                @enderror
                                                <!--begin::Input-->
                                                <div class="position-relative">

                                                    <input type="text" class="form-control "
                                                        wire:model.live.fill='sliders.{{ $key }}.product'
                                                        placeholder="Search & Enter Product">

                                                    <!--end::Input-->
                                                    @if (!empty($this->searchData($key)))
                                                        <div
                                                            class="bg-white list-group rounded-top-0 w-full z-index-3 p-5 scroll-y w-100 mh-200px mh-lg-350px position-absolute">
                                                            @foreach ($this->searchData($key) as $pKey => $data)
                                                                <!--begin::Item-->
                                                                <div class="d-flex text-dark text-hover-primary align-items-center justify-content-between cursor-pointer"
                                                                    wire:click='selectProductForSlider({{ $key }},{{ json_encode([$data->id => $data->name]) }})'>
                                                                    <!--begin::Title-->
                                                                    <div
                                                                        class="d-flex flex-column justify-content-start fw-semibold">
                                                                        <span
                                                                            class="fs-6 fw-semibold">{{ $data->name }}</span>
                                                                    </div>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Item-->
                                                                <div class="separator my-3"></div>
                                                                @php
                                                                    $hasData = true;
                                                                @endphp
                                                            @endforeach
                                                            @if (!$hasData)
                                                                <div class="list-item">No results!</div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                                <!--begin::Input-->
                                                <textarea wire:model='sliders.{{ $key }}.description' id="" cols="30" rows="1"
                                                    class="form-control " placeholder="Enter Description"></textarea>
                                                <!--end::Input-->
                                            </div>

                                            <button type="button" wire:click='deleteSlider({{ $key }})'
                                                class="bg-transparent btn btn-flush btn-icon btn-light-danger btn-sm">
                                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                        class="path2"></span></i>
                                            </button>
                                        </div>
                                        <label for="sliders{{ $key }}image"
                                            class="dropzone dz-clickable h-100 mt-4 py-2 w-100 text-start"
                                            id="kt_ecommerce_add_product_media">
                                            <!--begin::Message-->
                                            <div class="dz-message align-items-center needsclick">
                                                <!--begin::Icon-->
                                                <i class="ki-duotone ki-file-up text-primary fs-3x"><span
                                                        class="path1"></span><span class="path2"></span></i>
                                                <!--end::Icon-->
                                                <!--begin::Info-->
                                                <div class="ms-4">
                                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Click to
                                                        upload.</h3>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            @error('sliders.' . $key . '.image')
                                                <span class="text-danger fw-bold">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input id="sliders{{ $key }}image" type="file"
                                            wire:model="sliders.{{ $key }}.image" hidden>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <!--end::Form group-->

                    <!--begin::Form group-->
                    <div class="form-group mt-5">
                        <button wire:click='addSlider()' type="button" class="btn btn-sm btn-light-primary">
                            <i class="ki-duotone ki-plus fs-2"></i> Add Slider
                        </button>
                    </div>
                    <!--end::Form group-->
                </div>
                <!--end::Repeater-->
            </div>

        </div>
        <!--end::Card body-->

        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button wire:click='saveSlider' class="btn btn-primary" id="kt_account_profile_details_submit">Save
                Changes</button>
        </div>
        <!--end::Actions-->
        <input type="hidden">

    </div>
    <!--end::Content-->
</div>
