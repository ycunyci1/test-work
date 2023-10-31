<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
        Log::channel('old-products')->info('Начало удаления продуктов');
        try {
            Product::query()
                ->where('created_at', '<', now()->subWeeks(3))
                ->whereDoesntHave('tags')
                ->delete();
            Log::channel('old-products')->info('Старые продукты успешно удалены!');
        } catch (\Exception $exception) {
            Log::channel('old-products')->error('Ошибка: '.$exception->getMessage());
        }

    }
}
