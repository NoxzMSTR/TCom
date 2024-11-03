<div class="tab-pane fade" id="product_media" role="tab-panel" wire:ignore.self>
    <div class="d-flex flex-column gap-7 gap-lg-10">
        <!--begin::Media-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>Media</h2>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <div class="fv-row mb-2">
                    <!--begin::Dropzone-->
                    <label for="assets" class="dropzone dz-clickable w-100" id="kt_ecommerce_add_product_media">
                        <!--begin::Message-->
                        <div class="dz-message needsclick">
                            <!--begin::Icon-->
                            <i class="ki-duotone ki-file-up text-primary fs-3x"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <!--end::Icon-->
                            <!--begin::Info-->
                            <div class="ms-4">
                                <h3 class="fs-5 fw-bold text-gray-900 mb-1">Click to
                                    upload.</h3>
                                <span class="fs-7 fw-semibold text-gray-500">Upload up to 10
                                    files</span>
                            </div>
                            <!--end::Info-->
                        </div>
                    </label>
                    <!--end::Dropzone-->
                </div>
                <!--end::Input group-->
                <input id="assets" type="file" wire:model="assets" multiple hidden>

                @error('assets')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('assets.*')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <!--begin::Row-->
                <div class="d-flex flex-wrap gap-3" data-kt-buttons="true"
                    data-kt-buttons-target=".form-check-image, .form-check-input">
                    @foreach ($assets as $key => $asset)
                        @if ($asset)
                            <!--begin::Col-->
                            <label class="form-check-image">
                                <div class="form-check-wrapper">
                                    <img class="w-125px" src="{{ $asset->temporaryUrl() }}" />
                                </div>
                            </label>
                            <!--end::Col-->
                        @endif
                    @endforeach

                </div>
                <!--end::Row-->


                <!--end::Row-->
                <!--begin::Description-->
                <div class="text-muted fs-7">Set the product media gallery.</div>
                <!--end::Description-->

                @if ($hasAssets)
                    <div class="separator border-primary my-10"></div>
                    <!--begin::Row-->
                    <div class="d-flex flex-wrap gap-3" data-kt-buttons="true"
                        data-kt-buttons-target=".form-check-image, .form-check-input">
                        @foreach ($hasAssets as $key => $asset)
                            @if ($asset)
                                <!--begin::Col-->
                                <label class="form-check-image position-relative overflow-visible">
                                    <div class="form-check-wrapper ">
                                        <img class="w-125px" src="{{ asset($asset->path) }}" />
                                    </div>
                                    <span wire:click='deleteAsset({{ $asset->id }})'
                                        class="position-absolute top-0 start-100 translate-middle  badge badge-circle badge-danger cursor-pointer">x</span>
                                    <div class="form-check form-check-custom form-check-solid mb-2">
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" value="1" name="default"
                                                {{ $asset->isDefault ? 'checked' : '' }}
                                                wire:click='setDefaultAsset({{ $asset->id }})' />
                                        </label>
                                        <label class="form-check-label">
                                            Default
                                        </label>
                                    </div>
                                </label>
                                <!--end::Col-->
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
            <!--end::Card header-->
        </div>
        <!--end::Media-->
    </div>
</div>
