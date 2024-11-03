<div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
    <!--begin::Thumbnail settings-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>Thumbnail</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body text-center pt-0">
            <!--begin::Image input placeholder-->
            <style>
                .image-input-placeholder {
                    background-image: url('{{ $showThumbnail ? $showThumbnail : asset('mAssets/media/avatars/thumbnail.jpg') }}');
                }

                [data-bs-theme="dark"] .image-input-placeholder {
                    background-image: url('{{ $showThumbnail ? $showThumbnail : asset('mAssets/media/avatars/thumbnail.jpg') }}');
                }
            </style>
            <!--end::Image input placeholder-->

            <!--begin::Image input-->
            <div class="image-input image-input-empty" data-kt-image-input="true">
                <!--begin::Image preview wrapper-->
                <div class="image-input-wrapper image-input-placeholder w-125px h-125px"></div>
                <!--end::Image preview wrapper-->

                <!--begin::Edit button-->
                <label
                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                    title="Change avatar">
                    <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                    <!--begin::Inputs-->
                    <input type="file" name="avatar" wire:model='thumbnail' accept=".png, .jpg, .jpeg" />
                    <input type="hidden" name="avatar_remove" />
                    <!--end::Inputs-->
                </label>
                <!--end::Edit button-->

                <!--begin::Cancel button-->
                <span
                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                    title="Cancel avatar">
                    <i class="ki-outline ki-cross fs-3"></i>
                </span>
                <!--end::Cancel button-->

                <!--begin::Remove button-->
                <span
                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                    title="Remove avatar">
                    <i class="ki-outline ki-cross fs-3"></i>
                </span>
                <!--end::Remove button-->
            </div>
            <!--end::Image input-->

            @error('thumbnail')
                <br>
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <!--begin::Description-->
            <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image
                files are accepted</div>
            <!--end::Description-->


            <!--begin::Input group-->
            <div class="mb-10 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="required form-label">Category Name</label>
                <!--end::Label-->

                <!--begin::Input-->
                <input type="text" wire:model="name" class="form-control mb-2" placeholder="Category name"
                    value="">
                <!--end::Input-->

                <!--begin::Description-->
                <div class="text-muted fs-7">A category name is required.</div>
                <!--end::Description-->
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                </div>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="form-label">Category Description</label>
                <!--end::Label-->

                <!--begin::Input-->
                <textarea wire:model="description" cols="30" rows="10" class="form-control mb-2"></textarea>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="form-label">Category Meta Tags</label>
                <!--end::Label-->

                <!--begin::Input-->
                <input type="text" id="metatags" wire:model="tags" class="form-control mb-2 metatags"
                    placeholder="Meta tags name" value="">
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="required form-label">Parent Category</label>
                <!--end::Label-->

                <!--begin::Input-->
                <select class="form-select parentCategory" data-control="select2" wire:model='parent'
                    data-placeholder="Select Parent Category">
                    <option value="0" selected>Parent</option>
                    @foreach ($this->categories as $key => $cat)
                        <option value="{{ $key }}">{{ $cat }}</option>
                    @endforeach
                </select>
                <!--end::Input-->

                @error('parent')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Card body-->
        <div class="card-footer d-flex justify-content-end">

            @if ($category)
                <!--begin::Button-->
                <button wire:click='updateCategory' onclick="KTApp.showPageLoading();"
                    id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                    <span class="indicator-label">
                        Update
                    </span>
                    <span class="indicator-progress">
                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
                <!--end::Button-->
            @else
                <!--begin::Button-->
                <button wire:click='saveCategory' onclick="KTApp.showPageLoading();"
                    id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                    <span class="indicator-label">
                        Save
                    </span>
                    <span class="indicator-progress">
                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
                <!--end::Button-->
            @endif

        </div>
    </div>
    <!--end::Thumbnail settings-->

</div>
