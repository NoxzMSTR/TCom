<div class="card mb-5 mb-xl-10" x-data="{

    init() {
        var self = this;

        $('#availableCities').val($wire.availableCities).trigger('change');

        self.deliveryCities = self.availableCities;

        $('#availableCities').on('select2:select', function(e) {
            self.deliveryCities = $(this).val();

            console.log($(this).val());

            $wire.set('availableCities', $(this).val(), false);
            $.each(self.deliveryCities, function(index, city) {
                if (!self.sameDayDelivery[city]) {
                    self.sameDayDelivery[city] = {};
                    self.sameDayDelivery[city][0] = new Proxy({ 'from': '00:00', 'to': '00:00' }, {});
                }
                if (!self.deliveryTime[city]) {
                    self.deliveryTime[city] = new Proxy({ 'from': '00:00', 'to': '00:00' }, {});
                }
            });
        });
        $('#availableCities').on('select2:unselect', function(e) {
            var city = e.params.data.id;
            self.deliveryCities = $(this).val();
            $wire.set('availableCities', self.deliveryCities, false);
            if (self.deliveryTime[city]) {
                delete self.sameDayDelivery[city];
                delete self.deliveryTime[city];
            }
        });
    }
}">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">General</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Content-->
    <div id="kt_account_settings_profile_details" class="collapse show">
        <!--begin::Form-->

        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Avaiable For City</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-8 fv-row" wire:ignore>
                    <select x-model='availableCities' aria-label="Select cities" id="availableCities"
                        data-control="select2" data-placeholder="Select cities.."
                        class="form-select form-select-solid form-select-lg cities" tabindex="-1" multiple>
                        <option value="">Select
                            cities..</option>
                        @foreach ($this->cities as $key => $value)
                            <option value="{{ $value->name }}"
                                {{ $value->name == $defaultCurrency ? 'selected' : '' }}>
                                {{ $value->name }}</option>
                        @endforeach
                    </select>
                    <div class="mt-3 d-flex gap-3 flex-wrap">
                        <template x-for="(city, index) in deliveryCities" :key="index">
                            <div class="form-check">
                                <input x-model="deliveryOn" class="form-check-input" type="checkbox"
                                    :value="city" :id="'select-' + city" />
                                <label class="form-check-label" :for="'select-' + city" x-text="'Delivery On '+city">

                                </label>
                            </div>
                        </template>
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">Default Currency</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <select wire:model.fill='defaultCurrency' aria-label="Select a Currency" data-control="select2"
                        data-placeholder="Select a currency.."
                        class="form-select form-select-solid form-select-lg currency" tabindex="-1" aria-hidden="true">
                        <option value="">Select a
                            currency..</option>
                        @foreach ($this->currencies as $key => $value)
                            <option value="{{ $value['code'] }}"
                                {{ $value['code'] == $defaultCurrency ? 'selected' : '' }}>{!! $value['symbol'] !!} -
                                {{ $value['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Card body-->

        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button wire:click='saveGeneral' onclick="KTApp.showPageLoading();" class="btn btn-primary"
                id="kt_account_profile_details_submit">Save
                Changes</button>
        </div>
        <!--end::Actions-->
        <input type="hidden">

        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
