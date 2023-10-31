<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class DropOldProductsWithoutTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drop-old-products-without-tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Удаление устаревших продуктов, у которых нет тегов';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Product::query()
            ->where('created_at', '<', now()->subWeeks(3))
            ->whereDoesntHave('tags')
            ->delete();
    }
}
