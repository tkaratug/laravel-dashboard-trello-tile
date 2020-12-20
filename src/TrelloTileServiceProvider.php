<?php

namespace Tkaratug\TrelloTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class TrelloTileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Livewire::component('trello-tile', TrelloTileComponent::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchTrelloCardsCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dashboard-trello-tile'),
        ], 'dashboard-trello-tile-views');
        
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-trello-tile');
    }
}
