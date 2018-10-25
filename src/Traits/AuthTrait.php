<?php

namespace Rennokki\Larafy\Traits;

use Rennokki\Larafy\Exceptions\SpotifyAPIException;
use Rennokki\Larafy\Exceptions\SpotifyAuthorizationException;

use Carbon\Carbon;

function encodeURIComponent($str) {
    $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
    return strtr(rawurlencode($str), $revert);
}


trait AuthTrait
{
    protected $accessToken;
    protected $refreshToken;
    protected $expireDate;


    public function getAuthorizationURL($scopes = [], $redirectUrl)
    {
        $scopes = encodeURIComponent(join(' ', $scopes));
        $redirectUrl = encodeURIComponent($redirectUrl);

        return self::AUTHORIZATION_URL . "?response_type=code&client_id={$this->clientId}" . "&scope={$scopes}" . "&redirect_uri={$redirectUrl}";
    }


    public function requestAppToken() 
    {
        return $this->requestToken([
            'grant_type' => 'client_credentials',
        ]);
    }


    public function requestUserToken($authCode, $redirectUrl) 
    {
        return $this->requestToken([
            'grant_type' => 'authorization_code',
            'code' => $authCode,
            'redirect_uri' => $redirectUrl,
        ]);
    }


    public function refreshToken() {
        if (!$this->refreshToken) {
            return $this->requestAppToken();
        }

        return $this->requestToken([
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->refreshToken,
        ]);
    }


    private function requestToken($params) {
        try {
            $request = $this->tokenClient->post('', [
                'form_params' => $params,
            ]);

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new SpotifyAPIException(
                'Spotify API cannot generate the Client Credentials Token.', 
                json_decode($e->getResponse()->getBody()->getContents())
            );
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


    public function forget() 
    {
        $this->accessToken = null;
        $this->refreshToken = null;
        $this->expireDate = null;

        $this->requestAppToken();

    }
}
