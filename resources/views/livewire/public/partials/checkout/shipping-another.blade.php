<div class="card border-0">
    <div id="shopCartHeadingFour" class="custom-control custom-checkbox d-flex align-items-center">
        <input type="checkbox" class="custom-control-input" id="shippingdiffrentAddress" name="shippingdiffrentAddress"
            wire:model='shippingdiffrentAddress'>
        <label class="custom-control-label form-label" for="shippingdiffrentAddress" data-toggle="collapse"
            data-target="#shopCartfour" aria-expanded="false" aria-controls="shopCartfour">
            Ship to a different address?
        </label>
    </div>
    <div wire:ignore.self id="shopCartfour" class="collapse mt-5" aria-labelledby="shopCartHeadingFour"
        data-parent="#shopCartAccordion3" style="">
        <!-- Shipping Form -->
        <div class="row">
            <div class="col-md-12">
                <!-- Input -->
                <div class="js-form-message mb-6">
                    <label class="form-label">
                        Full name
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="firstName" placeholder="Name" aria-label="Name"
                        required="" data-msg="Please enter your frist name." data-error-class="u-has-error"
                        data-success-class="u-has-success" autocomplete="off" wire:model='shipping.name'>
                    @error('shipping.name')
                        <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                    @enderror
                </div>
                <!-- End Input -->
            </div>

            <div class="w-100"></div>

            <div class="col-md-12">
                <!-- Input -->
                <div class="js-form-message mb-6">
                    <label class="form-label">
                        Company name (optional)
                    </label>
                    <input type="text" class="form-control" name="companyName" placeholder="Company Name"
                        aria-label="Company Name" data-msg="Please enter a company name." data-error-class="u-has-error"
                        data-success-class="u-has-success" wire:model='shipping.company'>
                </div>
                <!-- End Input -->
            </div>

            <div class="col-md-12">
                <!-- Input -->
                <div class="js-form-message mb-6">
                    <label class="form-label">
                        Country
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-control js-select selectpicker dropdown-select" required=""
                        data-msg="Please select country." data-error-class="u-has-error"
                        data-success-class="u-has-success" data-live-search="true"
                        data-style="form-control border-color-1 font-weight-normal" wire:model.fill='shipping.country'>
                        <option value="">Select country</option>
                        <option value="PK" selected>Pakistan</option>
                    </select>
                    @error('shipping.country')
                        <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                    @enderror
                </div>
                <!-- End Input -->
            </div>

            <div class="col-md-8">
                <!-- Input -->
                <div class="js-form-message mb-6">
                    <label class="form-label">
                        Street address
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="streetAddress" placeholder="Address"
                        aria-label="470 Lucy Forks" required="" data-msg="Please enter a valid address."
                        data-error-class="u-has-error" data-success-class="u-has-success" wire:model='shipping.address'>
                    @error('shipping.address')
                        <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                    @enderror
                </div>
                <!-- End Input -->
            </div>

            <div class="col-md-4">
                <!-- Input -->
                <div class="js-form-message mb-6">
                    <label class="form-label">
                        Apt, suite, etc.
                    </label>
                    <input type="text" class="form-control" placeholder="Optional Address" aria-label="YC7B 3UT"
                        data-msg="Please enter a valid address." data-error-class="u-has-error"
                        data-success-class="u-has-success" wire:model='shipping.address2'>

                </div>
                <!-- End Input -->
            </div>

            <div class="col-md-6">
                <!-- Input -->
                <div class="js-form-message mb-6">
                    <label class="form-label">
                        City
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="cityAddress" placeholder="City" readonly
                        value="Sialkot" aria-label="London" required="" data-msg="Please enter a valid address."
                        data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off"
                        wire:model.fill='shipping.city'>
                    @error('shipping.city')
                        <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                    @enderror
                </div>
                <!-- End Input -->
            </div>

            <div class="col-md-6">
                <!-- Input -->
                <div class="js-form-message mb-6">
                    <label class="form-label">
                        Postcode/Zip
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="postcode" placeholder="99999"
                        aria-label="99999" required="" data-msg="Please enter a postcode or zip code."
                        data-error-class="u-has-error" data-success-class="u-has-success"
                        wire:model='shipping.postcode'>
                    @error('shipping.postcode')
                        <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                    @enderror
                </div>
                <!-- End Input -->
            </div>

            <div class="w-100"></div>

            <div class="col-md-12">
                <!-- Input -->
                <div class="js-form-message mb-6">
                    <label class="form-label">
                        State
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-control js-select selectpicker dropdown-select" required=""
                        data-msg="Please select state." data-error-class="u-has-error"
                        data-success-class="u-has-success" data-live-search="true"
                        data-style="form-control border-color-1 font-weight-normal" wire:model.fill='shipping.state'>
                        <option value="">Select state</option>
                        <option value="PJB" selected>Punjab</option>
                    </select>
                    @error('shipping.state')
                        <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                    @enderror
                </div>
                <!-- End Input -->
            </div>

            <div class="col-md-6">
                <!-- Input -->
                <div class="js-form-message mb-6">
                    <label class="form-label">
                        Email address
                        <span class="text-danger">*</span>
                    </label>
                    <input type="email" class="form-control" name="emailAddress" placeholder="Email"
                        aria-label="jackwayley@gmail.com" required=""
                        data-msg="Please enter a valid email address." data-error-class="u-has-error"
                        data-success-class="u-has-success" wire:model='shipping.email'>
                    @error('shipping.email')
                        <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                    @enderror
                </div>
                <!-- End Input -->
            </div>

            <div class="col-md-6">
                <!-- Input -->
                <div class="js-form-message mb-6">
                    <label class="form-label">
                        Phone
                    </label>
                    <input type="text" class="form-control" placeholder="Phone" aria-label="+1 (062) 109-9222"
                        data-msg="Please enter your last name." data-error-class="u-has-error"
                        data-success-class="u-has-success" wire:model='shipping.phone'>
                    @error('shipping.phone')
                        <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
                    @enderror
                </div>
                <!-- End Input -->
            </div>

            <div class="w-100"></div>
        </div>
        <!-- End Shipping Form -->
    </div>
</div>
