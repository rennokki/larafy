<?php

namespace Rennokki\Larafy\Test;

class ArtistsTest extends TestCase
{
    public function testGetArtists()
    {
        $search = $this->api->searchArtists('Metallica', 15);
        $artists = collect($search->items);
        $artistsIds = $artists->pluck('id')->toArray();

        $artists = $this->api->getArtists($artistsIds);
        $firstArtist = collect($artists)->first();

        $artist = $this->api->getArtist($firstArtist->id);
        $this->assertEquals($artist->id, $firstArtist->id);

        $artistAlbums = $this->api->getArtistAlbums($firstArtist->id, 15, 5);
        $artistTopTracks = $this->api->getArtistTopTracks($firstArtist->id, 15, 5);
        $artistRelatedArtists = $this->api->getArtistRelatedArtists($firstArtist->id);
    }
}
