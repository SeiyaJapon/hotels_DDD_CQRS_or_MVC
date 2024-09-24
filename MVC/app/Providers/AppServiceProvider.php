<?php

namespace App\Providers;

use App\Repository\HotelRepository;
use App\Repository\HotelRepositoryInterface;
use App\Services\CsvParser;
use App\Services\FileParserContext;
use App\Services\FileParserStrategy;
use App\Services\JsonParser;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(HotelRepositoryInterface::class, HotelRepository::class);

        $this->app->singleton(FileParserStrategy::class, function ($app) {
            if (env('PARSER_TYPE') === 'csv') {
                return new CsvParser();
            }
            return new JsonParser();
        });
        $this->app->singleton(FileParserContext::class, function ($app) {
            return new FileParserContext($app->make(FileParserStrategy::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
