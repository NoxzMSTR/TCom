<div>
    <!-- Slider Section -->
    @include('components.slider')
    <!-- End Slider Section -->
    <div class="container">
        <!-- Banner -->
        @include('livewire.public.partials.home.banner')
        <!-- End Banner -->
        <!-- Deals-and-tabs -->
        @include('livewire.public.partials.home.deals')
        <!-- End Deals-and-tabs -->
    </div>
    <!-- Products-4-1-4 -->
    @include('livewire.public.partials.home.product-grid')
    <!-- End Products-4-1-4 -->
    <div class="container">
        <!-- Prodcut-cards-carousel -->
        @include('livewire.public.partials.home.product-slider')
        <!-- End Prodcut-cards-carousel -->
        <!-- Full banner -->
        @include('livewire.public.partials.home.full-banner')
        <!-- End Full banner -->
        <!-- Recently viewed -->
        @include('livewire.public.partials.home.recent-view')
        <!-- End Recently viewed -->
        <!-- Brand Carousel -->
        @include('livewire.public.partials.home.brand')
        <!-- End Brand Carousel -->
    </div>
</div>
@script
    <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "WebSite",
  "name": "TechBottle",
  "url": "https://techbottle.pk/",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://techbottle.pk/shop?category=Keyboards%20%26%20Mice{search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
@endscript
