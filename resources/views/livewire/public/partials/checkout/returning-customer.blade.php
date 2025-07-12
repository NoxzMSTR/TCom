<div id="shopCartAccordion" class="accordion rounded mb-5">
    <!-- Card -->
    <div class="card border-0">
        <div id="shopCartHeadingOne" class="alert alert-primary mb-0" role="alert">
            Returning customer? <a href="#" class="alert-link" data-toggle="collapse" data-target="#shopCartOne"
                aria-expanded="false" aria-controls="shopCartOne">Click here to
                login</a>
        </div>
        <div id="shopCartOne" class="collapse border border-top-0 p-4" aria-labelledby="shopCartHeadingOne"
            data-parent="#shopCartAccordion" x-data="{
                email: $wire.entangle('email'),
                async login() {
                    $('input, select, button').attr('disabled', true);
                    await $wire.login();
                    $('input, select, button').attr('disabled', false);
                },
                init() {
                    $wire.on('account-notification', (e) => {
                        Swal.fire({
                            title: e.title,
                            text: e.message,
                            icon: e.type
                        });
                    });
                }
            }">
            <!-- Form -->

            <!-- Title -->
            <div class="mb-5">
                <p class="text-gray-90 mb-2">Welcome back! Sign in to your account.</p>
                <p class="text-gray-90">If you have shopped with us before, please enter your details below.
                    If you are a new customer, please proceed to the Billing & Shipping section.</p>
            </div>
            <!-- End Title -->

            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Group -->
                    <div class="js-form-message form-group">
                        <label class="form-label" for="signinSrEmailExample3">Email address</label>
                        <input type="email" class="form-control" x-model="email" id="signinSrEmailExample3"
                            placeholder="Email address" aria-label="Email address" required
                            data-msg="Please enter a valid email address." data-error-class="u-has-error"
                            data-success-class="u-has-success">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Form Group -->
                </div>
            </div>

            <!-- Button -->
            <div class="mb-1">
                <div class="mb-3">
                    <button @click="login" type="button" class="btn btn-primary-dark-w px-5">Login</button>
                </div>
            </div>
            <!-- End Button -->

            <!-- End Form -->
        </div>
    </div>
    <!-- End Card -->
</div>
