<?php

namespace Tkaratug\TrelloTile;

use Illuminate\Support\Facades\Http;

class TrelloApi
{
    protected string $apiKey;

    protected string $apiToken;

    /**
     * TrelloApi constructor.
     */
    public function __construct()
    {
        $this->apiKey = config('dashboard.tiles.trello.trello_key');
        $this->apiToken = config('dashboard.tiles.trello.trello_token');
    }

    /**
     * Fetch cards from Trello.
     *
     * @param string $listId
     * @return mixed
     */
    public function getCards(string $listId)
    {
        return Http::get("https://api.trello.com/1/lists/{$listId}/cards", [
          'key'     => $this->apiKey,
          'token'   => $this->apiToken,
        ])->json();
    }

    /**
     * Fetch member from Trello.
     *
     * @param string $memberId
     * @return mixed
     */
    public function getMember(string $memberId)
    {
        return Http::get("https://api.trello.com/1/members/{$memberId}", [
          'key'     => $this->apiKey,
          'token'   => $this->apiToken,
        ])->json();
    }

    /**
     * Fetch checklist from Trello.
     *
     * @param string $checklistId
     * @return mixed
     */
    public function getChecklist(string $checklistId)
    {
        return Http::get("https://api.trello.com/1/checklist/{$checklistId}", [
          'key'     => $this->apiKey,
          'token'   => $this->apiToken,
        ])->json();
    }
}
