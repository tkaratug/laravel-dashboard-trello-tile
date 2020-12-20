# Trello Tile

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

A tile for Laravel Dashboard that displays tasks from Trello.

![Laravel Dashboard Trello Tile](https://github.com/tkaratug/laravel-dashboard-trello-tile/blob/master/screenshot.png?raw=true)

## Install

Via Composer

```bash
$ composer require tkaratug/laravel-dashboard-trello-tile
```

## Usage

In the `dashboard` config file, you must add this configuration in the `tiles` key. The `list_id` should be any list id from Trello that you want to display on the dashboard.

```php
// in config/dashboard.php

return [
    // ...
    'tiles' => [
        'trello' => [
            'trello_key' => env('TRELLO_API_KEY'),
            'trello_token' => env('TRELLO_API_TOKEN'),
            'list_id' => env('TRELLO_LIST_ID'),
            'refresh_interval_in_seconds' => 30,
        ],
    ],
];
```

In `app\Console\Kernel.php` you should schedule the `Tkaratug\TrelloTile\Commands\FetchTrelloCardsCommand` to run every `x` minutes.

```php
// in app/console/Kernel.php

protected function schedule(Schedule $schedule)
{
    $schedule->command(\Tkaratug\TrelloTile\FetchTrelloCardsCommand::class)->everyThirtyMinutes();
}
```

In your dashboard view you use the `livewire:trello-tile` component.

```blade
<x-dashboard>
    <livewire:trello-tile position="a1" />
</x-dashboard>
```

You can specify the number of tasks you want to be displayed on your dashboard with `count` attribute.

```blade
<x-dashboard>
    <livewire:trello-tile position="a1" count="5" />
</x-dashboard>
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

```bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email security@voke.dev instead of using the issue tracker.

## Credits

- [Turan Karatuğ][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/tkaratug/laravel-dashboard-trello-tile.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/tkaratug/laravel-dashboard-trello-tile.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/tkaratug/laravel-dashboard-trello-tile
[link-downloads]: https://packagist.org/packages/tkaratug/laravel-dashboard-trello-tile
[link-author]: https://github.com/tkaratug
[link-contributors]: ../../contributors
