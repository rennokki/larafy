<?php

namespace Rennokki\Larafy\Traits;

trait AlbumsTrait
{
    public function getAlbums($albumsIds)
    {
        if (is_array($albumsIds)) {
            $albumsIds = collect($albumsIds)->implode(',');
        }

        $json = $this->get()->request('/albums', [
            'ids' => $albumsIds,
            'market' => $this->market,
        ]);

        return $json->albums;
    }

    public function getAlbum(string $albumId)
    {
        $json = $this->get()->request('/albums/'.$albumId, [
            'market' => $this->market,
        ]);

        return $json;
    }

    public function getAlbumTracks(string $albumId, int $limit = 10, int $offset = 0)
    {
        $json = $this->get()->request('/albums/'.$albumId.'/tracks', [
            'market' => $this->market,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $json;
    }

    public function searchAlbums(string $query, int $limit = 10, int $offset = 0)
    {
        $json = $this->get()->request('/search', [
            'q' => $query,
            'type' => 'album',
            'market' => $this->market,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $json->albums;
    }
}
