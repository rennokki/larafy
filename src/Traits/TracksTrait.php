<?php

namespace Rennokki\Larafy\Traits;

trait TracksTrait
{
    public function getTracks($tracksIds)
    {
        if (is_array($tracksIds)) {
            $tracksIds = collect($tracksIds)->implode(',');
        }

        $json = $this->get()->request('/tracks', [
            'ids' => $tracksIds,
        ]);

        return $json->tracks;
    }

    public function getTrack(string $trackId)
    {
        $json = $this->get()->request('/tracks/'.$trackId, [
            'market' => $this->market,
        ]);

        return $json;
    }

    public function searchTracks(string $query, int $limit = 10, int $offset = 0)
    {
        $json = $this->get()->request('/search', [
            'q' => $query,
            'type' => 'track',
            'market' => $this->market,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $json->tracks;
    }
}
