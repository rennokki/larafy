<?php

namespace Rennokki\Larafy;

use GuzzleHttp\Client;
use Rennokki\Larafy\Traits\AlbumsTrait;
use Rennokki\Larafy\Traits\ArtistsTrait;
use Rennokki\Larafy\Traits\AuthTrait;
use Rennokki\Larafy\Traits\BrowseTrait;
use Rennokki\Larafy\Traits\PlaylistsTrait;
use Rennokki\Larafy\Traits\RequestTrait;
use Rennokki\Larafy\Traits\TracksTrait;
use Rennokki\Larafy\Traits\UserTrait;

class Larafy
{
    use AlbumsTrait, BrowseTrait, TracksTrait,
        ArtistsTrait, RequestTrait, PlaylistsTrait,
        UserTrait, AuthTrait;

    private $tokenClient;
    private $apiClient;

    protected $clientId;
    protected $clientSecret;

    public $market = 'US';
    public $locale = 'en_US';

    const SPOTIFY_TOKEN_URL = 'https://accounts.spotify.com/api/token/';
    const SPOTIFY_API_URL = 'https://api.spotify.com/v1/';
    const AUTHORIZATION_URL = 'https://accounts.spotify.com/authorize';


    public function __construct($clientId = null, $clientSecret = null)
    {
        $this->clientId = ($clientId) ?: config('services.spotify.client_id');
        $this->clientSecret = ($clientSecret) ?: config('services.spotify.client_secret');

        $this->setupClients();
    }


    private function setupClients()
    {
        $this->tokenClient = new Client([
            'base_uri' => self::SPOTIFY_TOKEN_URL,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accepts' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
            ],
        ]);

        $this->apiClient = new Client([
            'base_uri' => self::SPOTIFY_API_URL,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accepts' => 'application/json',
            ],
        ]);
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
