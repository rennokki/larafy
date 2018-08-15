<?php

namespace Rennokki\Larafy\Traits;

trait AlbumsTrait
{
    /**
     * Get albums based on IDs.
     *
     * @param string|array $albumsIds
     * @return string The JSON response.
     */
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

    /**
     * Get an album based on ID.
     *
     * @param string $albumId
     * @return string The JSON response.
     */
    public function getAlbum(string $albumId)
    {
        $json = $this->get()->request('/albums/'.$albumId, [
            'market' => $this->market,
        ]);

        return $json;
    }

    /**
     * Get tracks from an album.
     *
     * @param string $albumId
     * @param int $limit
     * @param int $offset
     * @return string The JSON response.
     */
    public function getAlbumTracks(string $albumId, int $limit = 10, int $offset = 0)
    {
        $json = $this->get()->request('/albums/'.$albumId.'/tracks', [
            'market' => $this->market,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $json;
    }

    /**
     * Search albums based on a query.
     *
     * @param string $query
     * @param int $limit
     * @param int $offset
     * @return string The JSON response.
     */
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
