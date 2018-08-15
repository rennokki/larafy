<?php

namespace Rennokki\Larafy\Test;

use Rennokki\Larafy\Larafy;

class TracksTest extends TestCase
{
    public function testGetTracks()
    {
        $search = $this->api->searchTracks('Fade to Black', 15);
        $tracks = collect($search->items);
        $tracksIds = $tracks->pluck('id')->toArray();

        $tracks = $this->api->getTracks($tracksIds);
        $firstTrack = collect($tracks)->first();

        $track = $this->api->getTrack($firstTrack->id);
        $this->assertEquals($track->id, $firstTrack->id);
    }
}