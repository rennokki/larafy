<?php

namespace Rennokki\Larafy\Traits;

trait TracksTrait
{
    /**
     * Get tracks based on IDs.
     *
     * @param string|array $tracksIds
     * @return string The JSON response.
     */
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

    /**
     * Get a track based on ID.
     *
     * @param string $trackId
     * @return string The JSON response.
     */
    public function getTrack(string $trackId)
    {
        $json = $this->get()->request('/tracks/'.$trackId, [
            'market' => $this->market,
        ]);

        return $json;
    }

    /**
     * Search tracks based on a query.
     *
     * @param string $query
     * @param int $limit
     * @param int $offset
     * @return string The JSON response.
     */
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
