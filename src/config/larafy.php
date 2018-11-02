<?php

return [
    'market' => 'US',
    'locale' => 'en_US',

    'api_url' => 'https://api.spotify.com/v1/',
    'authorization_url' => 'https://accounts.spotify.com/authorize',
    'request_token_url' => 'https://accounts.spotify.com/api/token/',

	'consumer_key' => env('SPOTIFY_KEY', ''),
	'consumer_secret' => env('SPOTIFY_SECRET', ''),
];
