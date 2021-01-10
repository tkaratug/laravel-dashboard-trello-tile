<x-dashboard-tile
    :position="$position"
    :show="$showTile"
    :refresh-interval="$refreshIntervalInSeconds"
    class="grid grid-rows-auto-1 gap-2 h-full"
>
    <div class="grid grid-rows-auto-1 h-full">
        <div class="flex w-full items-center justify-center">
            <div class="text-2xl">
                <h1 class="font-medium text-dimmed text-sm uppercase tracking-wide tabular-nums">
                    Tasks on Trello
                </h1>
            </div>
        </div>

        <div class="self-center | grid gap-8" style="grid-auto-rows: auto;">
            <div class="grid gap-2">
                <div class="w-full flex flex-col justify-left font-sans overflow-y-auto h-64">
                        <div class="text-sm mt-2">
                            @foreach($cards as $card)
                            <div class="mt-1 py-2 border-b border-grey">
                                <a href="{{ $card['shortUrl'] }}" target="_blank" class="hover:text-blue-600">
                                    {{ $card['name'] }}
                                </a>
                                <div class="mt-2 flex justify-between items-start">
                                    <span class="flex space-x-2 items-center">
                                    @if ($card['due'])
                                        <span class="text-xs flex items-center">
                                            <svg class="h-3 fill-current text-gray-600 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm1 12v-6h-2v8h7v-2h-5z"/></svg>
                                            <span class="{{ \Carbon\Carbon::make($card['due'])->isPast() ? 'text-red-600': '' }}">
                                                {{ \Carbon\Carbon::make($card['due'])->toDateString() }}
                                            </span>
                                        </span>
                                    @endif
                                    @forelse ($card['checklists'] as $checklist)
                                    <span class="text-xs flex items-center">
                                        <svg class="h-3 fill-current text-gray-600 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11 17l-5-5.299 1.399-1.43 3.574 3.736 6.572-7.007 1.455 1.403-8 8.597zm11-15v20h-20v-20h20zm2-2h-24v24h24v-24z"/></svg>
                                        {{ $checklist['total'] - $checklist['incomplete'] }}/{{ $checklist['total'] }}
                                    </span>
                                    @empty
                                    @endforelse
                                    </span>
                                    @foreach($card['members'] as $member)
                                    <span class="text-xs text-blue-600">
                                        <a href="{{ $member['url'] }}" target="_blank">{{ '@'.$member['username'] }}</a>
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-tile>
