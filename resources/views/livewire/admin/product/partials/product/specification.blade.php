<div class="tab-pane fade" id="product_specification" role="tab-panel" wire:ignore.self>
    <div class="d-flex flex-column gap-7 gap-lg-10" x-data="{
        specification: $wire.entangle('specification'),
        addSpecification() {
            var index = this.specification.length;
            this.specification[index] = {
                title: '',
                data: [{ name: '', value: '' }]
            };
        },
        deleteSpecification(index) {
            this.specification.splice(index, 1);
        },
        addField(index) {
            var dIndex = this.specification[index].data.length;
            this.specification[index].data[dIndex] = { name: '', value: '' };
        },
        deleteField(index, dIndex) {
            this.specification[index].data.splice(dIndex, 1);
        },
        init() {
            if (this.specification.length == 0) {
                this.specification[0] = {
                    title: '',
                    data: [{ name: '', value: '' }]
                };
            }
    
        }
    }">
        <!--begin::Media-->
        <div class="card card-flush py-4 ">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>Specificaiton</h2>
                </div>
                <div class="card-toolbar">
                    <button @click='addSpecification()' type="button" class="btn btn-sm btn-light-primary">
                        <i class="ki-duotone ki-plus fs-2"></i> Add specificaiton
                    </button>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0">
                <template x-for="(spec, index) in specification" :key="index">
                    <div class="card card-flush py-4 mb-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title flex-column w-100">
                                <!--begin::Label-->
                                <label class="form-label">Specificaiton Title</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" class="form-control" x-model="spec.title" placeholder="Title">
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <div class="">
                                <!--begin::Label-->
                                <label class="form-label">Specificaiton Fields</label>
                                <!--end::Label-->

                                <!--begin::Repeater-->
                                <div>
                                    <template x-for="(data, dIndex) in spec.data" :key="dIndex">
                                        <!--begin::Form group-->
                                        <div class="form-group mb-2">
                                            <div class="d-flex flex-column gap-3">

                                                <div class="form-group d-flex flex-wrap align-items-center gap-5"
                                                    style="">
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control flex-equal"
                                                        x-model="data.name" placeholder="Name">
                                                    <!--end::Input-->

                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control flex-equal"
                                                        x-model="data.value" placeholder="Value">
                                                    <!--end::Input-->

                                                    <button type="button" @click="deleteField(index,dIndex)"
                                                        class="btn btn-sm btn-icon btn-light-danger">
                                                        <i class="ki-duotone ki-cross fs-1"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Form group-->
                                    </template>
                                    <!--begin::Form group-->
                                    <div class="d-flex form-group gap-2 justify-content-between mt-5">
                                        <button type="button" class="btn btn-sm btn-light-primary"
                                            @click="addField(index)">
                                            <i class="ki-duotone ki-plus fs-2"></i> Add another field
                                        </button>
                                        <button type="button" @click="deleteSpecification(index)"
                                            class="btn btn-sm btn-light-danger">
                                            Delete
                                        </button>
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <!--end::Repeater-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card header-->
                    </div>
                </template>
            </div>
            <!--end::Card header-->
        </div>
        <!--end::Media-->
    </div>
</div>
