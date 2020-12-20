<?php

namespace Tkaratug\TrelloTile;

use Illuminate\Console\Command;

class FetchTrelloCardsCommand extends Command
{
    protected $signature = 'dashboard:fetch-trello-cards';

    protected $description = 'Fetch Trello Cards Of The List';

    protected TrelloApi $trello;

    /**
     * FetchTrelloCardsCommand constructor.
     *
     * @param TrelloApi $trello
     */
    public function __construct(TrelloApi $trello)
    {
        parent::__construct();
        $this->trello = $trello;
    }

    /**
     * Fetch data from Trello.
     *
     */
    public function handle()
    {
        $this->info('Fetching cards from Trello...');

        $response = collect($this->trello->getCards(config('dashboard.tiles.trello.list_id')));

        $cards = [];
        foreach ($response as $item) {
            $cards[] = [
                'cardId' => $item['id'],
                'closed' => $item['closed'],
                'dateLastActivity' => $item['dateLastActivity'],
                'due' => $item['due'],
                'name' => $item['name'],
                'shortLink' => $item['shortLink'],
                'members' => $this->getMembers($item['idMembers']),
                'checklists' => $this->getChecklists($item['idChecklists']),
                'labels' => $item['labels'],
                'shortUrl' => $item['shortUrl'],
            ];
        }

        TrelloTileStore::make()->setTrelloCards($cards);

        $this->info('All done!');
    }

    /**
     * Get member details from Trello.
     *
     * @param array $members
     * @return array
     */
    private function getMembers(array $members): array
    {
        $memberList = [];
        foreach ($members as $member) {
            $response = $this->trello->getMember($member);
            $memberList[] = [
              'id' => $response['id'],
              'username' => $response['username'],
              'avatarUrl' => $response['avatarUrl'],
              'url' => $response['url'],
            ];
        }

        return $memberList;
    }

    /**
     * Fetch checklist details from Trello.
     *
     * @param array $checklists
     * @return array
     */
    private function getChecklists(array $checklists): array
    {
        $checkList = [];
        foreach ($checklists as $checklist) {
          $response = $this->trello->getChecklist($checklist);
          $checkItems = collect($response['checkItems']);
          $checkList[] = [
            'id' => $response['id'],
            'name' => $response['name'],
            'incomplete' => $checkItems->filter(fn ($item) => $item['state'] === 'incomplete')->count(),
            'total' => $checkItems->count(),
          ];
        }

        return $checkList;
    }
}
