<div id="shopCartAccordion" class="accordion rounded mb-5">
    <!-- Card -->
    <div class="card border-0">
        <div id="shopCartHeadingOne" class="alert alert-primary mb-0" role="alert">
            Returning customer? <a href="#" class="alert-link" data-toggle="collapse" data-target="#shopCartOne"
                aria-expanded="false" aria-controls="shopCartOne">Click here to
                login</a>
        </div>
        <div id="shopCartOne" class="collapse border border-top-0" aria-labelledby="shopCartHeadingOne"
            data-parent="#shopCartAccordion" style="">
            <!-- Form -->
            <form class="js-validate p-5">
                <!-- Title -->
                <div class="mb-5">
                    <p class="text-gray-90 mb-2">Welcome back! Sign in to your account.</p>
                    <p class="text-gray-90">If you have shopped with us before, please enter your details below.
                        If you are a new customer, please proceed to the Billing & Shipping section.</p>
                </div>
                <!-- End Title -->

                <div class="row">
                    <div class="col-lg-6">
                        <!-- Form Group -->
                        <div class="js-form-message form-group">
                            <label class="form-label" for="signinSrEmailExample3">Email address</label>
                            <input type="email" class="form-control" name="email" id="signinSrEmailExample3"
                                placeholder="Email address" aria-label="Email address" required
                                data-msg="Please enter a valid email address." data-error-class="u-has-error"
                                data-success-class="u-has-success">
                        </div>
                        <!-- End Form Group -->
                    </div>
                    <div class="col-lg-6">
                        <!-- Form Group -->
                        <div class="js-form-message form-group">
                            <label class="form-label" for="signinSrPasswordExample2">Password</label>
                            <input type="password" class="form-control" name="password" id="signinSrPasswordExample2"
                                placeholder="********" aria-label="********" required
                                data-msg="Your password is invalid. Please try again." data-error-class="u-has-error"
                                data-success-class="u-has-success">
                        </div>
                        <!-- End Form Group -->
                    </div>
                </div>

                <!-- Checkbox -->
                <div class="js-form-message mb-3">
                    <div class="custom-control custom-checkbox d-flex align-items-center">
                        <input type="checkbox" class="custom-control-input" id="rememberCheckbox"
                            name="rememberCheckbox" required data-error-class="u-has-error"
                            data-success-class="u-has-success">
                        <label class="custom-control-label form-label" for="rememberCheckbox">
                            Remember me
                        </label>
                    </div>
                </div>
                <!-- End Checkbox -->

                <!-- Button -->
                <div class="mb-1">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary-dark-w px-5">Login</button>
                    </div>
                    <div class="mb-2">
                        <a class="text-blue" href="#">Lost your password?</a>
                    </div>
                </div>
                <!-- End Button -->
            </form>
            <!-- End Form -->
        </div>
    </div>
    <!-- End Card -->
</div>
