<div>
    <div class="u-sidebar__scroller">
        <div class="u-sidebar__container">
            <div class="js-scrollbar u-header-sidebar__footer-offset pb-3">
                <!-- Toggle Button -->
                <div class="d-flex align-items-center pt-4 px-7">
                    <button type="button" class="close ml-auto" aria-controls="sidebarContent" aria-haspopup="true"
                        aria-expanded="false" data-unfold-event="click" data-unfold-hide-on-scroll="false"
                        data-unfold-target="#sidebarContent" data-unfold-type="css-animation"
                        data-unfold-animation-in="fadeInRight" data-unfold-animation-out="fadeOutRight"
                        data-unfold-duration="500">
                        <i class="ec ec-close-remove"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->

                <!-- Content -->
                <div class="js-scrollbar u-sidebar__body" wire:ignore>
                    <div class="u-sidebar__content u-header-sidebar__content" x-data="{
                        email: $wire.entangle('email'),
                        errorMessage: null,
                        mailSent: false,
                        showRegForm() {
                            $('#signup').show();
                            $('#signup').attr('style', 'opacity: 1;');
                            $('#login').hide();
                    
                        },
                        showLogForm() {
                            $('#login').show();
                            $('#login').attr('style', 'opacity: 1;');
                            $('#signup').hide();
                    
                        },
                        login() {
                            $wire.login();
                        },
                        register() {
                            $wire.register();
                        },
                        init() {
                            $wire.on('login-error-message', (e) => {
                                if (e.messages) {
                                    this.errorMessage = e.messages.email[0];
                                } else {
                                    this.errorMessage = null;
                                }
                            });
                            $wire.on('mail-sent', (e) => {
                                this.mailSent = true;
                                setTimeout(() => {
                                    this.mailSent = false;
                                }, 1500);
                            });
                        }
                    }">

                        <!-- Login -->
                        <div id="login" data-target-group="idForm">
                            <!-- Title -->
                            <header class="text-center mb-7">
                                <h2 class="h4 mb-0">Welcome Back!</h2>
                                <p>Login to manage your account.</p>
                            </header>
                            <!-- End Title -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <div class="js-form-message js-focus-state">
                                    <label class="sr-only" for="signinEmail">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="signinEmailLabel">
                                                <span class="fas fa-user"></span>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control" x-model="email" id="signinEmail"
                                            placeholder="Email" aria-label="Email" aria-describedby="signinEmailLabel"
                                            required data-msg="Please enter a valid email address."
                                            data-error-class="u-has-error" data-success-class="u-has-success">
                                        <template x-if='errorMessage'>
                                            <span class="text-danger w-100" x-text="errorMessage"></span>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <!-- End Form Group -->
                            <div x-show="mailSent" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-90"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-90" class="text-success">
                                Mail has been sent to your email successfully!
                            </div>
                            <div class="mb-2">
                                <button @click="login" type="button"
                                    class="btn btn-block btn-sm btn-primary transition-3d-hover">Login</button>
                            </div>

                            <div class="text-center mb-4">
                                <span class="small text-muted">Do not have an account?</span>
                                <a wire:ignore.self @click="showRegForm" class="js-animation-link small text-dark"
                                    href="javascript:;" data-target="#signup" data-link-group="idForm"
                                    data-animation-in="slideInUp">Signup
                                </a>
                            </div>
                        </div>

                        <!-- Signup -->
                        <div id="signup" style="display: none; opacity: 0;" data-target-group="idForm">
                            <!-- Title -->
                            <header class="text-center mb-7">
                                <h2 class="h4 mb-0">Welcome to Electro.</h2>
                                <p>Fill out the form to get started.</p>
                            </header>
                            <!-- End Title -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <div class="js-form-message js-focus-state">
                                    <label class="sr-only" for="signupEmail">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="signupEmailLabel">
                                                <span class="fas fa-user"></span>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control" x-model="email" id="signupEmail"
                                            placeholder="Email" aria-label="Email" aria-describedby="signupEmailLabel"
                                            required data-msg="Please enter a valid email address."
                                            data-error-class="u-has-error" data-success-class="u-has-success">
                                    </div>
                                </div>
                            </div>
                            <!-- End Input -->
                            <div x-show="mailSent" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-90"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-90" class="text-success">
                                Mail has been sent to your email successfully!
                            </div>

                            <div class="mb-2">
                                <button type="submit" @click="register"
                                    class="btn btn-block btn-sm btn-primary transition-3d-hover">Get
                                    Started</button>
                            </div>

                            <div class="text-center mb-4">
                                <span class="small text-muted">Already have an account?</span>
                                <a wire:ignore.self @click="showLogForm" class="js-animation-link small text-dark"
                                    href="javascript:;" data-target="#login" data-link-group="idForm"
                                    data-animation-in="slideInUp">Login
                                </a>
                            </div>

                        </div>
                        <!-- End Signup -->

                    </div>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </div>
</div>
