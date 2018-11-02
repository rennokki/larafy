<?php

namespace Rennokki\Larafy\Traits;

use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
use Rennokki\Larafy\Exceptions\SpotifyTokenException;

function encodeURIComponent($str)
{
    $revert = array('%21' => '!', '%2A' => '*', '%27' => "'", '%28' => '(', '%29' => ')');
    return strtr(rawurlencode($str), $revert);
}

trait AuthTrait
{
    protected $accessToken;
    protected $refreshToken;
    protected $expireDate;


    /**
     * Request a general app token. This token can't be used to fetch user related information.
     *
     * @return mixed|string
     * @throws SpotifyTokenException
     */
    public function requestAppToken()
    {
        return $this->requestToken([
            'grant_type' => 'client_credentials',
        ]);
    }


    /**
     * Returns the authorization url to request an auth token
     *
     * @param array $scopes
     * @param $redirectUrl
     * @return string
     */
    public function getAuthorizationURL($scopes = [], $redirectUrl)
    {
        $scopes = encodeURIComponent(join(' ', $scopes));
        $redirectUrl = encodeURIComponent($redirectUrl);

        return config('larafy.authorization_url') . "?response_type=code&client_id={$this->clientId}&scope={$scopes}&redirect_uri={$redirectUrl}";
    }


    /**
     * Exchange the auth token for an access token
     *
     * @param $authCode
     * @param $redirectUrl
     * @return mixed|string
     * @throws SpotifyTokenException
     */
    public function requestUserToken($authCode, $redirectUrl)
    {
        return $this->requestToken([
            'grant_type' => 'authorization_code',
            'code' => $authCode,
            'redirect_uri' => $redirectUrl,
        ]);
    }


    private function refreshToken()
    {
        if (!$this->refreshToken) {
            return $this->requestAppToken();
        }

        return $this->requestToken([
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->refreshToken,
        ]);
    }


    private function requestToken($params)
    {
        try {
            $request = $this->tokenClient->post('', [
                'form_params' => $params,
            ]);
        } catch (ClientException $e) {
            $response = $e->getResponse()->getBody()->getContents();
            $response = json_decode($response);

            throw new SpotifyTokenException("Failed to request Spotify token: {$response->error_description}", $response->error);
        }

        $response = json_decode($request->getBody());

        $this->accessToken = $response->access_token;
        $this->expireDate = Carbon::now();
        $this->expireDate->addSeconds($response->expires_in);

        if (isset($response->refresh_token)) {
            $this->refreshToken = $response->refresh_token;
        }

        return $response;
    }


    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }


    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }
}
