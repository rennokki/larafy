<?php

namespace Rennokki\Larafy\Traits;

use Carbon\Carbon;
use Rennokki\Larafy\Exceptions\SpotifyAPIException;
use Rennokki\Larafy\Exceptions\SpotifyAuthorizationException;

trait RequestTrait
{
    protected $requestMethod;
    protected $bearerToken;
    protected $clientCredentialsToken;
    protected $clientCredentialsExpirationDate;

    protected static $apiTokenUrl = 'https://accounts.spotify.com/api/token';

    /**
     * Set the request method to GET.
     *
     * @return \Rennokki\Larafy\Larafy
     */
    public function get()
    {
        $this->requestMethod = 'GET';

        return $this;
    }

    /**
     * Set the request method to POST.
     *
     * @return \Rennokki\Larafy\Larafy
     */
    public function post()
    {
        $this->requestMethod = 'POST';

        return $this;
    }

    /**
     * Set the request method to PUT.
     *
     * @return \Rennokki\Larafy\Larafy
     */
    public function put()
    {
        $this->requestMethod = 'PUT';

        return $this;
    }

    /**
     * Set the request method to DELETE.
     *
     * @return \Rennokki\Larafy\Larafy
     */
    public function delete()
    {
        $this->requestMethod = 'DELETE';

        return $this;
    }

    /**
     * Get the authorization token that should be used
     * to authenticate the requests. It either is Bearer Token
     * given from Login Flow or just a client credentials token
     * which is generated whenever is needed.
     *
     * @return string
     */
    public function getAuthorizationToken()
    {
        if ($this->bearerToken) {
            return $this->bearerToken;
        }

        return $this->clientCredentialsToken;
    }

    /**
     * Sets a Bearer Token. If a Bearer Token exists,
     * it will be used with priority over a client credentials token.
     *
     * @return \Rennokki\Larafy\Larafy
     */
    public function withBearerToken(string $bearerToken)
    {
        $this->bearerToken = $bearerToken;

        return $this;
    }

    /**
     * Launch a request to the API.
     *
     * @param string $endpoint
     * @param array $data
     * @return string The decoded JSON response from the server.
     */
    public function request(string $endpoint, array $data = [])
    {
        if ($this->clientCredentialsExpirationDate && $this->clientCredentialsExpirationDate->isPast()) {
            $this->generateClientCredentialsToken();
        }

        $client = new \GuzzleHttp\Client();

        try {
            $request = $client->request($this->requestMethod, Self::SPOTIFY_API_URL.$endpoint.'?'.http_build_query($data), [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accepts' => 'application/json',
                    'Authorization' => 'Bearer '.$this->getAuthorizationToken(),
                ],
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new SpotifyAPIException('Spotify returned other than 200 OK.', json_decode($e->getResponse()->getBody()->getContents()));
        }

        return json_decode($request->getBody());
    }

    /**
     * Generate a Client Credentials Token.
     *
     * @return \Rennokki\Larafy\Larafy
     */
    protected function generateClientCredentialsToken()
    {
        $client = new \GuzzleHttp\Client();

        try {
            $request = $client->request('POST', Self::$apiTokenUrl, [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accepts' => 'application/json',
                    'Authorization' => 'Basic '.base64_encode($this->clientId.':'.$this->clientSecret),
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new SpotifyAPIException('Spotify API cannot generate the Client Credentials Token.', json_decode($e->getResponse()->getBody()->getContents()));
        }

        $response = json_decode($request->getBody());

        $this->clientCredentialsToken = $response->access_token;
        $this->clientCredentialsExpirationDate = Carbon::now()->addSeconds($response->expires_in);

        return $this;
    }

    /**
     * Throws exception if User Bearer Token is not provided.
     *
     * @return void
     */
    private function usesOnlyUserToken()
    {
        if (! $this->bearerToken) {
            throw new SpotifyAuthorizationException('This endpoint needs User Authorization. Read more on https://developer.spotify.com/documentation/general/guides/authorization-guide.');
        }
    }
}
