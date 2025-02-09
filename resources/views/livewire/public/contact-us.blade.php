<div>
    <div class="container">
        <div class="row mb-10">
            <div class="col-lg-7 col-xl-6 mb-8 mb-lg-0">
                <div class="mr-xl-6">
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title mb-0 pb-2 font-size-25">Leave us a Message</h3>
                    </div>
                    <p class="max-width-830-xl text-gray-90">We’re here to help! Whether you have questions, need
                        support, or just want to share feedback, feel free to reach out. You can contact us through the
                        form below, send us an email, or give us a call. Our team is dedicated to responding promptly
                        and ensuring your concerns are addressed.

                        We look forward to hearing from you!</p>
                    <form wire:submit="submit">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Input -->
                                <div class="js-form-message mb-4 @error('name') u-has-error @enderror">
                                    <label class="form-label">
                                        Full name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" wire:model="name" placeholder="Name"
                                        aria-label="" data-error-class="u-has-error" data-success-class="u-has-success"
                                        autocomplete="off">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End Input -->

                            </div>

                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-4  @error('email') u-has-error @enderror">
                                    <label class="form-label">
                                        Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" wire:model="email" placeholder="Email"
                                        aria-label="" data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End Input -->

                            </div>
                            <div class="col-md-6">
                                <!-- Input -->
                                <div class="js-form-message mb-4  @error('phone') u-has-error @enderror">
                                    <label class="form-label">
                                        Phone
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" wire:model="phone" placeholder="Phone"
                                        aria-label="" data-msg="Please enter your last name."
                                        data-error-class="u-has-error" data-success-class="u-has-success">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End Input -->

                            </div>

                            <div class="col-md-12">
                                <!-- Input -->
                                <div class="js-form-message mb-4  @error('subject') u-has-error @enderror">
                                    <label class="form-label">
                                        Subject
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" wire:model="subject"
                                        placeholder="Subject" aria-label="" data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                    @error('subject')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- End Input -->

                            </div>
                            <div class="col-md-12">
                                <div class="js-form-message mb-4  @error('message') u-has-error @enderror">
                                    <label class="form-label">
                                        Your Message
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="input-group">
                                        <textarea class="form-control p-5" rows="4" wire:model="message" placeholder="Message"></textarea>
                                    </div>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary-dark-w px-5">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 col-xl-6">
                <div class="border-bottom border-color-1 mb-5">
                    <h3 class="section-title mb-0 pb-2 font-size-25">Our Address</h3>
                </div>
                <address class="mb-6 text-lh-23">
                    {{ isset(system_config['address']['value']) ? system_config['address']['value'] : '-' }}
                    <div class="">Phone: <a
                            href="tel:{{ isset(system_config['phone']['value']) ? system_config['phone']['value'] : '-' }}"
                            class="text-blue text-decoration-on">{{ isset(system_config['phone']['value']) ? system_config['phone']['value'] : '-' }},
                        </a></div>
                    <div class="">Email: <a
                            href="mailto:{{ isset(system_config['email']['value']) ? system_config['email']['value'] : '-' }}"
                            class="text-blue text-decoration-on">{{ isset(system_config['email']['value']) ? system_config['email']['value'] : '-' }}</a>
                    </div>
                </address>
            </div>
        </div>
    </div>
</div>
