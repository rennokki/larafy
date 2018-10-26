<?php

namespace Rennokki\Larafy\Traits;

use Carbon\Carbon;

trait UserTrait
{
    public function getCurrentUserProfile() 
    {
        return $this->get('me');
    }

    public function getFollowedArtists(int $limit = 20, string $after = NULL) 
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

    public function getTopTracks(int $limit = 20, int $offset = 0, string $timeRange = 'medium_term') 
    {
        return $this->get('me/top/tracks', [
            'limit' => $limit,
            'offset' => $offset,
            'time_range' => $timeRange,
        ]);
    }

    public function getTopArtists(int $limit = 20, int $offset = 0, string $timeRange = 'medium_term') 
    {
        return $this->get('me/top/artists', [
            'limit' => $limit,
            'offset' => $offset,
            'time_range' => $timeRange,
        ]);
    }
}
