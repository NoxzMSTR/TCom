<?php

namespace App\Livewire\Public\Product;

use App\Models\Product\ProductFeedBack;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FeedBack extends Component
{
    public $productID;
    #[Validate('required|min:3', message: 'Please enter your full name.')]
    public $name;
    #[Validate('required|email', message: 'Please enter your valid email.')]
    public $email;
    public $feedback;
    #[Validate('required', message: 'Please Select a Rating ⭐')]
    public $review;

    public $reviews;

    public function mount()
    {
        $this->getReviews();
    }

    public function getReviews()
    {
        $this->reviews = ProductFeedBack::where('productID', $this->productID)->latest()->get();
    }

    public function submit()
    {
        $this->validate();

        $hasReview = ProductFeedBack::where('productID', $this->productID)->where('email', $this->email)->first();

        if (!$hasReview) {
            ProductFeedBack::create([
                'productID' => $this->productID,
                'name' => $this->name,
                'email' => $this->email,
                'rating' => $this->review,
                'feedback' => $this->feedback ?? '',
            ]);
            $this->dispatch('review-notification', type: 'success', title: 'Thank You for Your Review! 🎉', message: 'Your review has been successfully submitted! ⭐ We appreciate your feedback and value your support. Thanks for helping us improve! 😊');
        } else {
            $this->dispatch('review-notification', type: 'info', title: 'Review Already Submitted', message: 'It looks like you`ve already shared your feedback. ⭐ We truly appreciate your review and support! If you have any updates or additional thoughts, feel free to reach out. 😊');
        }

        $this->getReviews();
        $this->name = null;
        $this->email = null;
        $this->feedback = null;
        $this->review = null;
    }

    public function render()
    {
        return view('livewire.public.product.feed-back');
    }
}
