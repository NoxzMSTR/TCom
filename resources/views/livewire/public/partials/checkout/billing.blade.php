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

    <div class="col-md-8">
        <!-- Input -->
        <div class="js-form-message mb-6">
            <label class="form-label">
                Street address
                <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control" name="streetAddress" placeholder="Address" x-model='address'
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
            <input type="text" class="form-control" placeholder="Apt, suite, etc." aria-label="YC7B 3UT"
                data-msg="Please enter a valid address." data-error-class="u-has-error"
                data-success-class="u-has-success" wire:model='billing.address2'>
        </div>
        <!-- End Input -->
    </div>

    <div class="col-md-12">
        <!-- Input -->
        <div class="js-form-message mb-6">
            <label class="form-label">
                City
                <span class="text-danger">*</span>
            </label>
            <select class="form-control js-select selectpicker dropdown-select" required=""
                data-msg="Please select city." data-error-class="u-has-error" data-success-class="u-has-success"
                data-live-search="true" data-style="form-control border-color-1 font-weight-normal"
                wire:model.fill='billing.city'>
                <option value="" disabled>Select city</option>
                @foreach ($cities as $key => $city)
                    <option value="{{ $city }}">{{ $city }}</option>
                @endforeach

            </select>
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
