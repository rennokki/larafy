[![Build Status](https://travis-ci.org/rennokki/larafy.svg?branch=master)](https://travis-ci.org/rennokki/larafy)
[![codecov](https://codecov.io/gh/rennokki/larafy/branch/master/graph/badge.svg)](https://codecov.io/gh/rennokki/larafy/branch/master)
[![StyleCI](https://github.styleci.io/repos/144677749/shield?branch=master)](https://github.styleci.io/repos/143601238)
[![Latest Stable Version](https://poser.pugx.org/rennokki/larafy/v/stable)](https://packagist.org/packages/rennokki/larafy)
[![Total Downloads](https://poser.pugx.org/rennokki/larafy/downloads)](https://packagist.org/packages/rennokki/larafy)
[![Monthly Downloads](https://poser.pugx.org/rennokki/larafy/d/monthly)](https://packagist.org/packages/rennokki/larafy)
[![License](https://poser.pugx.org/rennokki/larafy/license)](https://packagist.org/packages/rennokki/larafy)

[![PayPal](https://img.shields.io/badge/PayPal-donate-blue.svg)](https://paypal.me/rennokki)

# Larafy
Larafy is a PHP API Wrapper for Spotify API. This wrapper is more oriented over Client Credentials authenticated endpoints and provides great interface and and eloquent way to search for tracks, seed genres or simply just provide custom tracks/albums listings for your users.

# Installation
Install the package:
```bash
$ composer require rennokki/larafy
```

If your Laravel version does not support package discovery, add this line in the `providers` array in your `config/app.php` file:
```php
Rennokki\Larafy\LarafyServiceProvider::class,
```

# Setting up the API
For this, you will need an APP ID and an APP SECRET from your Spotify API Dashboard.


For a cleaner approach, add the following to your `config/services.php` file:
```php
'spotify' => [
    'client_id' => env('SPOTIFY_KEY'),
    'client_secret' => env('SPOTIFY_SECRET'),
    'redirect' => env('SPOTIFY_REDIRECT_URI')
],
```

To use the API, you just pass no construct parameters to `Rennokki\Larafy\Larafy`:
```php
$api = new Larafy();
```

If you want to change the credentials on-demand, you can do so by declaring a new API instance with your App ID and your App Secret:
```php
use Rennokki\Larafy\Larafy;

$api = new Larafy('your_app_id_here', 'your_app_secret_here');
```

# Showcase
All requests throw exceptions, either if the data is invalid, either if the request is... bad.
To do so, there are provided two exceptions that can be caught:
* `\Rennokki\Larafy\Exceptions\SpotifyAPIException` - thrown when the API is authenticated correctly, but the data passed is invalid.
* `\Rennokki\Larafy\Exceptions\SpotifyAuthorizationException` - thrown when the API can't authenticate using credentials provided.

```php
try {
    $api->searchArtists('Lana del Rey');
} catch(\Rennokki\Larafy\Exceptions\SpotifyAuthorizationException $e) {
    // invalid ID & Secret provided
    $e->getAPIResponse(); // Get the JSON API response.
}
```

```php
try {
    $api->searchArtists('Lana del Rey', -30, -40);
} catch(\Rennokki\Larafy\Exceptions\SpotifyAPIException $e) {
    // invalid data sent
    $e->getAPIResponse(); // Get the JSON API response.
}
```

Since Spotify is related to music, it has some certain restrictions over markets and locales. This happens because, for example, some albums that are available in a country may not be available in other countries, such as the `AC/DC`'s `The Razor Edge` album, that has different versions across countries like `Austrialia` or the `US`.

To help give a better search over the market and, respectively, locales, use the `setMarket()` and `setLocale()` methods within the API instance. These are by default set to `US` and `en_US`. These are optional.

You can chain them:
```php
$api->setMarket('RO')->setLocale('ro_RO');
```

Or set them on demand:
```php
$api->setMarket('ES');
...
$api->setLocale('es_ES');
```

Some requests need an `offset` and a `limit`, which are optional and set by default to `0` and respectively `10`. The limit is how many results can be shown in the request and the offset indicates how many results to offset, starting from the first. See the next examples on how you can use this feature.

```php
$limit = 15;
$offset = 5;

$api->searchAlbums('Master of Puppets', $limit, $offset); // limit 15 with 5 offset.
```

When retrieving multiple data, you can either pass  an array or a string with comma-separated values:
```php
$api->getAlbums(['album_id_1', 'album_id_2', ...]);
$api->getAlbums('album_id_1,album_id_2,...');
```

When issuing requests on endpoints that might return more data, usually this is done by accessing the `items` property:
```php
$masterOfPuppets = $api->searchAlbums('Master of Puppets');
$masterOfPuppets->items; // this is the array with all results
```

For the `getArtistAlbums()` method, there is an option to search artist's albums based on the fact it is a single or the artist appears on that album. To do so, there is applied the same rule as the comma-separated values or array method.
```php
$api->getArtistAlbums('artist_id', $limit, $offset, ['single', 'appears_on']);
$api->getArtistAlbums('artist_id', $limit, $offset, ['single']);
$api->getArtistAlbums('artist_id', $limit, $offset, 'single');
$api->getArtistAlbums('artist_id', $limit, $offset, 'single,appears_on');
```

# API Usage
## Recommendations
Recommendations allows you to query up the Spotify API into getting something personalized. The [Recommendations endpoint](https://developer.spotify.com/documentation/web-api/reference/browse/get-recommendations) allows you to do that by seeding tracks, genres and artists and a bunch of adjustable properties such as energy, key and danceability to get personalized tracks for your users.

Before getting into it, make sure you are familiar with the [Recommendations Endpoint](https://developer.spotify.com/documentation/web-api/reference/browse/get-recommendations).

Each track has its own properties such as key, danceability, energy or loudness. To do so, the `\Rennokki\Larafy\LarafySeed` class helps you build your seed easier. Let's start with an example:
```php
$seed = (new LarafySeed)
    ->setGenres(['death-metal', 'hard-rock', 'black-metal'])
    ->setTargetValence(90.3)
    ->setSpeechiness(60.0, 90.0)
    ->setLoudness(80.0, 100.0)
    ->setLiveness(80.0, 100.0);

$tracks = $api->getRecommendations($seed, $limit);
foreach ($tracks->items as $track) {
    ...
}
```

In the previous example, we just have searched tracks from Death Metal, Hard Rock and Black Metal whose valence (the positivity; the higher, the more positive) is around `90.3`, and then we set some ranges for speechiness (the higher, the less musical it is: podcasts), loudness and liveness (the higher, the more chances it is a live performance).

To get the available seeds, you may use the `$api->getGenreSeeds()` to get a list of possible values for the `setGenres()` method.

There is a difference between:
* `set{property}($min, $max)`
* `setTarget{property}($value)`.

When setting up a range, it might vary between two values.
When setting up a target value, it just gets around it as much as possible.
[Read more about each seed here](https://developer.spotify.com/documentation/web-api/reference/browse/get-recommendations)

To add artists, tracks or genres, you may use:
```php
$seed->addArtist('artist_id');
$seed->addArtists(['artist_id_1', 'artist_id_2', ...']);
$seed->addArtists('artist_id_1,artist_id_2,...');
$seed->setArtists(['artist_id_1', 'artist_id_2', ...']); // overwrites
$seed->setArtists('artist_id_1,artist_id_2,...'); // overwrites

$seed->addTrack('track_id');
$seed->addTracks(['track_id_1', 'track_id_2', ...']);
$seed->addTracks('track_id_1,track_id_2,...');
$seed->setTracks(['track_id_1', 'track_id_2', ...']); // overwrites
$seed->setTracks('track_id_1,track_id_2,...'); // overwrites

$seed->addGenre('genre');
$seed->addGenres(['genre1', 'genre2', ...']);
$seed->addGenres('genre1,genre2,...');
$seed->setGenres(['genre1', 'genre2', ...']); // overwrites
$seed->setGenres('genre1,genre2,...'); // overwrites
```

For tunable properties of the songs, you can use the following methods:
```php
$seed->setAcousticness($min, $max); // float
$seed->setTargetAcousticness($target); // float

$seed->setDanceability($min, $max); // float
$seed->setTargetDanceability($target); // float

$seed->setEnergy($min, $max); // float
$seed->setTargetEnergy($target); // float

$seed->setInstrumentalness($min, $max); // float
$seed->setTargetInstrumentalness($target); // float

$seed->setKeys($min, $max); // int
$seed->setTargetKey($target); // int

$seed->setLiveness($min, $max); // float
$seed->setTargetLiveness($target); // float

$seed->setLoudness($min, $max); // float
$seed->setTargetLoudness($target); // float

$seed->setMode($min, $max); // int
$seed->setTargetMode($target); // int

$seed->setPopularity($min, $max); // float
$seed->setTargetPopularity($target); // float

$seed->setSpeechiness($min, $max); // float
$seed->setTargetSpeechiness($target); // float

$seed->setTempo($min, $max); // int
$seed->setTargetTempo($target); // int

$seed->setTimeSignature($min, $max); // int
$seed->setTargetTimeSignature($target); // int

$seed->setValence($min, $max); // float
$seed->setTargetValence($target); // float

$seed->setDuration($min, $max); // int, in seconds
$seed->setTargetDuration($target); // int, in seconds
```

**Note: While building your seed, you can chain how many properties you want.**

### Albums
[API Reference on Albums](https://developer.spotify.com/console/albums)

```php
// Search for albums.
$api->searchAlbums('Master of Puppets', $limit, $offset);

// Get an album using ID.
$api->getAlbum('album_id');

// Get more albums at once based on IDs.
$api->getAlbums(['id1', 'id2', ...]);
$api->getAlbums('id1,id2,...');

// Get album's tracks.
$api->getAlbumTracks('album_id', $limit, $offset);
```

### Tracks
[API Reference on Tracks](https://developer.spotify.com/console/tracks)

```php
// Search for tracks.
$api->searchTracks('Fade to Black', $limit, $offset);

// Get a track using ID.
$api->getTrack('track_id');

// Get more tracks at once based on IDs.
$api->getTracks(['id1', 'id2', ...]);
$api->getTracks('id1,id2,...');
```

### Artists
[API Reference on Artists](https://developer.spotify.com/console/artists)

```php
// Search for artists.
$api->searchArtists('Metallica', $limit, $offset);

// Get an artist using ID.
$api->getArtist('artist_id');

// Get more artists at once based on IDs.
$api->getArtists(['id1', 'id2', ...]);
$api->getArtists('id1,id2,...');

// Get artist's albums.
$api->getArtistAlbums('artist_id', $limit, $offset, ['single', 'appears_on']);

// Get artist's top tracks.
$api->getArtistTopTracks('artist_id');

// Get artist's related artists.
$api->getArtistRelatedArtists('artist_id');
```

### Playlists
[API Reference on Playlists](https://developer.spotify.com/console/playlists)

```php
// Search for playlists.
$api->searchPlaylists('This Is Metallica', $limit, $offset);

// Get a playlist using ID.
$api->getPlaylist('playlist_id');

// Get playlist's albums.
$api->getPlaylistTracks('playlist_id', $limit, $offset);

// Get featured playlists from a specific time.
$api->getFeaturedPlaylists(Carbon::now(), $limit, $offset);
$api->getFeaturedPlaylists('2018-05-19 00:00:00', $limit, $offset);
```

### Browse
[API Reference on Browse](https://developer.spotify.com/console/browse)

```php
// Get genre seeds.
$api->getGenreSeeds();

// Get all the Browse categories.
$api->getBrowseCategories($limit, $offset);

// Get details about one of the Browse's category.
$api->getBrowseCategory('mood');

// Get playlists from a Browse category.
$api->getCategoryPlaylists('mood', $limit, $offset);

// Get new albums releases.
$api->getNewReleases($limit, $offset);
```
