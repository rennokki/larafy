<?php

namespace Rennokki\Larafy\Traits;

use Carbon\Carbon;

trait PlaylistsTrait
{
    /**
     * Get a playlist based on ID.
     *
     * @param string $playlistId
     * @return string The JSON response.
     */
    public function getPlaylist(string $playlistId)
    {
        $json = $this->get()->request('/playlists/'.$playlistId, [
            'market' => $this->market,
        ]);

        return $json;
    }

    /**
     * Get tracks from a playlist.
     *
     * @param string $playlistId
     * @param int $limit
     * @param int $offset
     * @return string The JSON response.
     */
    public function getPlaylistTracks(string $playlistId, int $limit = 10, int $offset = 0)
    {
        $json = $this->get()->request('/playlists/'.$playlistId.'/tracks', [
            'market' => $this->market,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $json;
    }

    /**
     * Get featured playlists from a specific time.
     *
     * @param null|string|\Carbon\Carbon $timestamp
     * @param int $limit
     * @param int $offset
     * @return string The JSON response.
     */
    public function getFeaturedPlaylists($timestamp = null, int $limit = 10, int $offset = 0)
    {
        $timestamp = ($timestamp) ?: Carbon::now();

        $json = $this->get()->request('/browse/featured-playlists', [
            'country' => $this->market,
            'locale' => $this->locale,
            'timestamp' => Carbon::parse($timestamp)->toIso8601String(),
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $json->playlists;
    }

    /**
     * Search playlists based on a query.
     *
     * @param string $query
     * @param int $limit
     * @param int $offset
     * @return string The JSON response.
     */
    public function searchPlaylists(string $query, int $limit = 10, int $offset = 0)
    {
        $json = $this->get()->request('/search', [
            'q' => $query,
            'type' => 'playlist',
            'market' => $this->market,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $json->playlists;
    }
}
