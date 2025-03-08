<div>
    @php
        $feedbackChart = [];
        foreach ($reviews as $key => $review) {
            $feedbackChart[$review->rating][] = $review;
        }

        $totalWeightedScore = 0;
        $totalReviews = 0;

        foreach ($feedbackChart as $stars => $data) {
            $totalWeightedScore += $stars * count($data);
            $totalReviews += count($data);
        }

        $overallRating = $totalReviews > 0 ? $totalWeightedScore / $totalReviews : 0;
        krsort($feedbackChart);

        $maxRatedReview = count($feedbackChart) ? count(max($feedbackChart)) : 0;
    @endphp
    <div class="row mb-8">
        <div class="col-md-6">
            <div class="mb-3">
                <h3 class="font-size-18 mb-6">Reviews</h3>
                <h2 class="font-size-30 font-weight-bold text-lh-1 mb-0">{{ number_format($overallRating, 1) }}</h2>
                <div class="text-lh-1">Overall</div>
            </div>

            <!-- Ratings -->
            <ul class="list-unstyled">
                @foreach ($feedbackChart as $stars => $rvs)
                    <li class="py-1">
                        <a class="row align-items-center mx-gutters-2 font-size-1" href="javascript:;">
                            <div class="col-auto mb-2 mb-md-0">
                                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                                    <small class="{{ $stars >= 1 ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                    <small class="{{ $stars >= 2 ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                    <small class="{{ $stars >= 3 ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                    <small class="{{ $stars >= 4 ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                    <small class="{{ $stars >= 5 ? 'fas fa-star' : 'far fa-star text-muted' }}"></small>
                                </div>
                            </div>
                            <div class="col-auto mb-2 mb-md-0">
                                @php
                                    $percent = floor((count($rvs) / $maxRatedReview) * 100);
                                @endphp
                                <div class="progress ml-xl-5" style="height: 10px; width: 200px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $percent }}%;"
                                        aria-valuenow="{{ $percent }}" aria-valuemin="0"
                                        aria-valuemax="{{ $percent }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto text-right">
                                <span class="text-gray-90">{{ count($rvs) }}</span>
                            </div>
                        </a>
                    </li>
                @endforeach

            </ul>
            <!-- End Ratings -->
        </div>
        <div class="col-md-6">
            <h3 class="font-size-18 mb-5">Add a review</h3>
            <!-- Form -->
            <div x-data="{
                review: null,
                name: null,
                email: null,
                feedback: null,
                setReview(number) {
                    if (number !== this.review) {
                        this.review = number;
                    } else if (number == this.review) {
                        this.review = null;
                    }
                },
                async submit() {
                    $('.btn').attr('disabled', true);
            
                    $wire.set('name', this.name, false);
                    $wire.set('email', this.email, false);
                    $wire.set('feedback', this.feedback, false);
                    $wire.set('review', this.review, false);
            
                    await $wire.submit();
            
                    this.name = null;
                    this.email = null;
                    this.feedback = null;
                    this.review = null;
            
                    $('.btn').attr('disabled', false);
            
                },
                init() {
                    $wire.on('review-notification', (e) => {
                        Swal.fire({
                            title: e.title,
                            text: e.message,
                            icon: e.type
                        });
                    });
                }
            }">
                <div class="row align-items-center mb-4">
                    <div class="col-md-4 col-lg-3">
                        <label for="rating" class="form-label mb-0">Your Review <span
                                class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-8 col-lg-9">

                        <div class="text-warning text-ls-n2 font-size-16">
                            <small @click="setReview(1)" class="far fa-star cursor-pointer-on font-size-24"
                                :class="review < 1 ? 'text-muted' : ''"></small>
                            <small @click="setReview(2)" class="far fa-star cursor-pointer-on font-size-24"
                                :class="review < 2 ? 'text-muted' : ''"></small>
                            <small @click="setReview(3)" class="far fa-star cursor-pointer-on font-size-24"
                                :class="review < 3 ? 'text-muted' : ''"></small>
                            <small @click="setReview(4)" class="far fa-star cursor-pointer-on font-size-24"
                                :class="review < 4 ? 'text-muted' : ''"></small>
                            <small @click="setReview(5)" class="far fa-star cursor-pointer-on font-size-24"
                                :class="review < 5 ? 'text-muted' : ''"></small>
                        </div>
                        @error('review')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="js-form-message form-group mb-3 row">
                    <div class="col-md-4 col-lg-3">
                        <label for="descriptionTextarea" class="form-label">Your Feedback</label>
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <textarea x-model="feedback" class="form-control" rows="3" id="descriptionTextarea"
                            data-msg="Please enter your message." data-error-class="u-has-error" data-success-class="u-has-success"></textarea>
                    </div>
                </div>
                <div class="js-form-message form-group mb-3 row">
                    <div class="col-md-4 col-lg-3">
                        <label for="inputName" class="form-label">Name <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <input x-model="name" type="text" class="form-control" name="name" id="inputName"
                            aria-label="Alex Hecker" required data-msg="Please enter your name."
                            data-error-class="u-has-error" data-success-class="u-has-success">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="js-form-message form-group mb-3 row">
                    <div class="col-md-4 col-lg-3">
                        <label for="emailAddress" class="form-label">Email <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <input @input="isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)" x-model="email"
                            type="email" class="form-control" name="emailAddress" id="emailAddress"
                            aria-label="alexhecker@pixeel.com" required data-msg="Please enter a valid email address."
                            data-error-class="u-has-error" data-success-class="u-has-success">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="offset-md-4 offset-lg-3 col-auto">
                        <button @click="submit" type="submit" id="reviewBtn"
                            class=" btn btn-primary-dark btn-wide transition-3d-hover">Add
                            Review</button>
                    </div>
                </div>
            </div>

            <!-- End Form -->
        </div>
    </div>
    @foreach ($reviews as $key => $review)
        <!-- Review -->
        <div class="border-bottom border-color-1 pb-4 mb-4">
            <!-- Review Rating -->
            <div class="d-flex justify-content-between align-items-center text-secondary font-size-1 mb-2">
                <div class="text-warning text-ls-n2 font-size-16" style="width: 80px;">
                    <small class="fas fa-star {{ $review->rating < 1 ? 'text-muted' : '' }}"></small>
                    <small class="fas fa-star {{ $review->rating < 2 ? 'text-muted' : '' }}"></small>
                    <small class="fas fa-star {{ $review->rating < 3 ? 'text-muted' : '' }}"></small>
                    <small class="fas fa-star {{ $review->rating < 4 ? 'text-muted' : '' }}"></small>
                    <small class="fas fa-star {{ $review->rating < 5 ? 'text-muted' : '' }}"></small>
                </div>
            </div>
            <!-- End Review Rating -->

            <p class="text-gray-90">{{ $review->feedback }}</p>

            <!-- Reviewer -->
            <div class="mb-2">
                <strong>{{ $review->name }}</strong>
                <span class="font-size-13 text-gray-23">- {{ $review->created_at->format('F d-Y') }}</span>
            </div>
            <!-- End Reviewer -->
        </div>
        <!-- End Review -->
    @endforeach


</div>
