<?php

namespace App\Console\Commands;

use App\Models\Product\Categories;
use App\Models\Product\Products;
use Illuminate\Console\Command;

class Testing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:testing';

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

        // Categories::factory()->count(20)->parent()->make();
        Products::factory()->count(1000)->shortDesc()->create();
    }
}
