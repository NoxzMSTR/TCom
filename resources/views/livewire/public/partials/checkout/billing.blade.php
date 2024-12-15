<div class="row">
    <div class="col-md-12">
        <!-- Input -->
        <div class="js-form-message mb-6">
            <label class="form-label">
                Full name
                <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" name="name" placeholder="Name" aria-label="Jack" required=""
                data-msg="Please enter your frist name." data-error-class="u-has-error"
                data-success-class="u-has-success" autocomplete="off" wire:model='billing.name'>
            @error('billing.name')
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
                data-success-class="u-has-success" wire:model='billing.company'>
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
                data-msg="Please select country." data-error-class="u-has-error" data-success-class="u-has-success"
                data-live-search="true" data-style="form-control border-color-1 font-weight-normal"
                wire:model.fill='billing.country'>
                <option value="">Select country</option>
                <option value="PK" selected>Pakistan</option>
            </select>
            @error('billing.country')
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
                data-error-class="u-has-error" data-success-class="u-has-success" wire:model='billing.address'>
            @error('billing.address')
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
            <input type="text" class="form-control" placeholder="Optional address" aria-label="YC7B 3UT"
                data-msg="Please enter a valid address." data-error-class="u-has-error"
                data-success-class="u-has-success" wire:model='billing.address2'>
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
            <input type="text" readonly class="form-control" name="cityAddress" value="Sialkot" placeholder="Sialkot"
                aria-label="Sialkot" required="" data-msg="Please enter a valid address."
                data-error-class="u-has-error" data-success-class="u-has-success" autocomplete="off"
                wire:model.fill='billing.city'>
            @error('billing.city')
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
            <input type="text" class="form-control" name="postcode" placeholder="99999" aria-label="99999"
                required="" data-msg="Please enter a postcode or zip code." data-error-class="u-has-error"
                data-success-class="u-has-success" wire:model='billing.postcode'>
            @error('billing.postcode')
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
                data-msg="Please select state." data-error-class="u-has-error" data-success-class="u-has-success"
                data-live-search="true" data-style="form-control border-color-1 font-weight-normal"
                wire:model.fill='billing.state'>
                <option value="">Select state</option>
                <option value="PJB" selected>Punjab</option>
            </select>
            @error('billing.state')
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
                aria-label="jackwayley@gmail.com" required="" data-msg="Please enter a valid email address."
                data-error-class="u-has-error" data-success-class="u-has-success" wire:model='billing.email'>
            @error('billing.email')
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
                data-success-class="u-has-success" wire:model='billing.phone'>
            @error('billing.phone')
                <div class="text-danger" style="font-weight: 700;">{{ $message }}</div>
            @enderror
        </div>
        <!-- End Input -->
    </div>

    <div class="w-100"></div>
</div>
