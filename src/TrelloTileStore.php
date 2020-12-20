<?php

namespace Tkaratug\TrelloTile;

use Spatie\Dashboard\Models\Tile;

class TrelloTileStore
{
    private Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName('trelloCards');
    }

    public function setTrelloCards(array $cards): self
    {
        $this->tile->putData('trelloCards', $cards);

        return $this;
    }

    public function trelloCards(): array
    {
        return $this->tile->getData('trelloCards') ?? [];
    }
}