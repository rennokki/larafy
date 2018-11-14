<?php

namespace Rennokki\Larafy\Traits;

use GuzzleHttp\Exception\ClientException;
use Rennokki\Larafy\Exceptions\SpotifyResponseException;

trait RequestTrait
{
    /**
     * Set the request method to GET.
     *
     * @return \Rennokki\Larafy\Larafy
     */
    public function get(string $endpoint, array $query = [])
    {
        return $this->request('GET', $endpoint, [
            'query' => $query
        ]);
    }


    /**
     * Set the request method to POST.
     *
     * @return \Rennokki\Larafy\Larafy
     */
    public function post(string $endpoint, array $query = [], array $body = [])
    {
        return $this->request('POST', $endpoint, [
            'query' => $query,
            'body' => $body,
        ]);
    }


    /**
     * Set the request method to PUT.
     *
     * @return \Rennokki\Larafy\Larafy
     */
    public function put(string $endpoint, array $query = [], array $body = [])
    {
        return $this->request('PUT', $endpoint, [
            'query' => $query,
            'body' => $body,
        ]);
    }


    /**
     * Set the request method to DELETE.
     *
     * @return \Rennokki\Larafy\Larafy
     */
    public function delete(string $endpoint, array $query = [], array $body = [])
    {
        return $this->request('DELETE', $endpoint, [
            'query' => $query,
            'body' => $body,
        ]);
    }


    /**
     * Launch a request to the API.
     *
     * @param string $endpoint
     * @param array $data
     * @return string The decoded JSON response from the server.
     */
    public function request(string $method, string $endpoint, array $options = [])
    {
        if ($this->expireDate && $this->expireDate->isPast()) {
            $this->refreshToken();
        }

        try {
            $request = $this->apiClient->request($method, $endpoint, array_merge($options, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->accessToken,
                ],
            ]));
        } catch (ClientException $exception) {
            $response = $exception->getResponse()->getBody()->getContents();
            $response = json_decode($response);

            throw new SpotifyResponseException("Failed to complete Spotify request: {$response->error->message}", $response->error->status);
        }

        return json_decode($request->getBody());
    }
}
