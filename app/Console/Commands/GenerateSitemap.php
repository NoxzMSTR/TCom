<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Manually create sitemap
        $sitemap = SitemapGenerator::create(env('APP_URL'))->getSitemap();

        // Static pages
        $sitemap->add('/');
        $sitemap->add('/shop');
        $sitemap->add('/shop/checkout');
        $sitemap->add('/shop/cart');
        $sitemap->add('/about-us');
        $sitemap->add('/contact-us');
        $sitemap->add('/privacy-policy');
        $sitemap->add('/refund-policy');
        $sitemap->add('/terms-&-conditions');
        $sitemap->add('/shipping-policy');
        $sitemap->add('/cancellation-policy');
        $sitemap->add('/my-account');
        $sitemap->add('/my-orders');

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}