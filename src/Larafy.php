<?php

namespace Rennokki\Larafy;

use Rennokki\Larafy\Traits\AlbumsTrait;
use Rennokki\Larafy\Traits\BrowseTrait;
use Rennokki\Larafy\Traits\TracksTrait;
use Rennokki\Larafy\Traits\ArtistsTrait;
use Rennokki\Larafy\Traits\RequestTrait;
use Rennokki\Larafy\Traits\PlaylistsTrait;

class Larafy
{
    use AlbumsTrait, BrowseTrait, TracksTrait,
        ArtistsTrait, RequestTrait, PlaylistsTrait;

    protected $clientId;
    protected $clientSecret;
    public $market = 'US';
    public $locale = 'en_US';

    const SPOTIFY_API_URL = 'https://api.spotify.com/v1';

    public function __construct($clientId = null, $clientSecret = null)
    {
        $this->clientId = ($clientId) ?: config('services.spotify.client_id');
        $this->clientSecret = ($clientSecret) ?: config('services.spotify.client_secret');

        $this->generateClientCredentialsToken();

        return $this;
    }

    public function setMarket(string $market)
    {
        $this->market = $market;

        return $this;
    }

    public function setLocale(string $locale)
    {
        $this->locale = $locale;

        return $this;
    }
}
