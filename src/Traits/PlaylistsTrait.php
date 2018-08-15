<?php

namespace Rennokki\Larafy\Traits;

use Carbon\Carbon;

trait PlaylistsTrait
{
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

    public function getPlaylist(string $playlistId)
    {
        $json = $this->get()->request('/playlists/'.$playlistId, [
            'market' => $this->market,
        ]);

        return $json;
    }

    public function getPlaylistTracks(string $playlistId, int $limit = 10, int $offset = 0)
    {
        $json = $this->get()->request('/playlists/'.$playlistId.'/tracks', [
            'market' => $this->market,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $json;
    }

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
}
