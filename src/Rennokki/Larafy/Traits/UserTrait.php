<?php

namespace Rennokki\Larafy\Traits;

trait UserTrait
{
    /**
     * Get detailed profile information about the current user.
     *
     * @param string $playlistId
     * @return string The JSON response.
     */
    public function getCurrentUserProfile()
    {
        return $this->get('me');
    }


    /**
     * Return the followed artists
     *
     * @param int $limit
     * @param string|NULL $after
     * @return string The JSON response
     */
    public function getFollowedArtists(int $limit = 10, string $after = NULL)
    {
        $options = [
            'type' => 'artist',
            'limit' => $limit,
        ];

        if (isset($after)) {
            $options['after'] = $after;
        }

        return $this->get('me/following', $options);
    }


    /**
     * Get the current user’s top tracks based on calculated affinity.
     *
     * @param int $limit
     * @param int $offset
     * @param string $timeRange
     * @return mixed
     */
    public function getTopTracks(int $limit = 10, int $offset = 0, string $timeRange = 'medium_term')
    {
        return $this->get('me/top/tracks', [
            'limit' => $limit,
            'offset' => $offset,
            'time_range' => $timeRange,
        ]);
    }


    /**
     * Get the current user’s top artists based on calculated affinity.
     *
     * @param int $limit
     * @param int $offset
     * @param string $timeRange
     * @return mixed
     */
    public function getTopArtists(int $limit = 10, int $offset = 0, string $timeRange = 'medium_term')
    {
        return $this->get('me/top/artists', [
            'limit' => $limit,
            'offset' => $offset,
            'time_range' => $timeRange,
        ]);
    }
}
