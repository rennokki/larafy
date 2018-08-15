<?php

namespace Rennokki\Larafy\Traits;

trait ArtistsTrait
{
    public function getArtists($artistsIds)
    {
        if (is_array($artistsIds)) {
            $artistsIds = collect($artistsIds)->implode(',');
        }

        $json = $this->get()->request('/artists', [
            'ids' => $artistsIds,
        ]);

        return $json->artists;
    }

    public function getArtist(string $artistId)
    {
        $json = $this->get()->request('/artists/'.$artistId);

        return $json;
    }

    public function getArtistAlbums(string $artistId, int $limit = 10, int $offset = 0, $includeGroups = ['single', 'appears_on'])
    {
        if (is_array($includeGroups)) {
            $includeGroups = collect($includeGroups)->implode(',');
        }

        return $this->get()->request('/artists/'.$artistId.'/albums', [
            'include_groups' => $includeGroups,
            'market' => $this->market,
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    public function getArtistTopTracks(string $artistId)
    {
        return $this->get()->request('/artists/'.$artistId.'/top-tracks', [
            'country' => $this->market,
        ]);
    }

    public function getArtistRelatedArtists(string $artistId)
    {
        return $this->get()->request('/artists/'.$artistId.'/related-artists');
    }

    public function searchArtists(string $query, int $limit = 10, int $offset = 0)
    {
        $json = $this->get()->request('/search', [
            'q' => $query,
            'type' => 'artist',
            'market' => $this->market,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $json->artists;
    }
}
