<?php

namespace Tkaratug\TrelloTile;

use Livewire\Component;

class TrelloTileComponent extends Component
{
    protected static $showTile = null;

    public $position;

    public $count = 5;

    public function render()
    {
        $showTile = isset(static::$showTile)
            ? (static::$showTile)()
            : true;

        return view('dashboard-trello-tile::tile', [
            'showTile' => $showTile,
            'cards' => collect(TrelloTileStore::make()->trelloCards())->take($this->count),
            'refreshIntervalInSeconds' => config('dashboard.tiles.trello.refresh_interval_in_seconds') ?? 60,
        ]);
    }

    public static function showTile(callable $callable): void
    {
        static::$showTile = $callable;
    }
}
