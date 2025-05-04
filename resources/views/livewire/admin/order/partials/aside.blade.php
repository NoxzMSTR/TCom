<div class="w-100 flex-lg-row-auto w-lg-300px mb-7 me-7 me-lg-10">
    <!--begin::Order details-->
    <div class="card card-flush py-4 mb-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>Order Details</h2>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body pt-0">
            <div class="d-flex flex-column gap-10">
                <!--begin::Input group-->
                <div class="fv-row">
                    <!--begin::Label-->
                    <label class="form-label">Order ID</label>
                    <!--end::Label-->

                    <!--begin::Auto-generated ID-->
                    <div class="fw-bold fs-3">#{{ $orderNo }}</div>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">Status</label>
                    <!--end::Label-->

                    <!--begin::Select2-->
                    <div class="d-flex gap-2" x-data="{
                        async sendMail() {
                            $('input,select').attr('disabled', true);
                            await $wire.sendMail();
                            $('input,select').attr('disabled', false);
                        }
                    }">
                        <select class="form-select mb-2 w-100" wire:model.fill='status'>>
                            @foreach (ORDER_STATUS as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <button @click="sendMail" class="btn btn-sm btn-primary">
                            <span class="indicator-label">
                                Send Mail
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Select2-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set the status of the order to process.</div>
                    <!--end::Description-->
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">Payment Method</label>
                    <!--end::Label-->

                    <!--begin::Select2-->
                    <select class="form-select mb-2" wire:model.fill='paymentMethod'>
                        <option value="">Select payment method</option>
                        @foreach (ORDER_PAYMENT_METHOD as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <!--end::Select2-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set the payment method of the order to process.</div>
                    <!--end::Description-->
                    @error('paymentMethod')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">Paid Status</label>
                    <!--end::Label-->

                    <!--begin::Select2-->
                    <select class="form-select mb-2" wire:model.fill='paidStatus'>>
                        @foreach (ORDER_PAID_STATUS as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <!--end::Select2-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set the paid status of the order to process.</div>
                    <!--end::Description-->
                    @error('paidStatus')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row fv-plugins-icon-container">
                    <!--begin::Label-->
                    <label class="required form-label">Order Date</label>
                    <!--end::Label-->

                    <!--begin::Editor-->
                    <input class="form-control mb-2 form-control input" placeholder="Select a date"
                        wire:model.fill='orderDate' type="date">
                    <!--end::Editor-->

                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set the date of the order to process.</div>
                    <!--end::Description-->
                    @error('orderDate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!--end::Input group-->
            </div>
        </div>
        <!--end::Card header-->
    </div>
    <!--end::Order details-->
    <!--begin::Order details-->
    <div class="card card-flush py-4">
        <!--begin::Card header-->
        <div class="card-header">
            <div class="card-title">
                <h2>Buyer Details</h2>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body pt-0">
            <div class="d-flex flex-column gap-5 gap-md-7">
                <!--begin::Input group-->
                <div class="d-flex flex-column flex-md-row gap-5">
                    <div class="fv-row flex-row-fluid">
                        <!--begin::Label-->
                        <label class="form-label">Buyer Type</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <select class="form-select mb-2" wire:model.fill='buyerType'>
                            @foreach (BUYER_TYPE as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach

                        </select>
                        <!--end::Input-->
                        @error('buyerType')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="d-flex flex-column flex-md-row gap-5">
                    <div class="fv-row flex-row-fluid">
                        <!--begin::Label-->
                        <label class="form-label">First Name</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input class="form-control"wire:model='buyerFirstName' placeholder="First Name" value="">
                        <!--end::Input-->
                        @error('buyerFirstName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex-row-fluid">
                        <!--begin::Label-->
                        <label class="form-label">Last Name</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input class="form-control" wire:model='buyerLastName' placeholder="Last Name">
                        <!--end::Input-->
                    </div>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex flex-column gap-5">
                    <div class="flex-row-fluid">
                        <!--begin::Label-->
                        <label class="form-label">Email</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input class="form-control" wire:model='buyerEmail' placeholder="Email" value="">
                        <!--end::Input-->
                        @error('buyerEmail')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="fv-row flex-row-fluid">
                        <!--begin::Label-->
                        <label class="form-label">Phone</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input class="form-control" wire:model='buyerPhone' placeholder="Phone" value="">
                        <!--end::Input-->
                        @error('buyerPhone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <!--end::Input group-->
            </div>
        </div>
        <!--end::Card header-->
    </div>
    <!--end::Order details-->
</div>
