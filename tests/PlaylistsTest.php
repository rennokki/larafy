<?php

namespace Rennokki\Larafy\Test;

class PlaylistsTest extends TestCase
{
    public function testGetPlaylists()
    {
        $search = $this->api->searchPlaylists('This Is Metallica', 15);
        $playlists = collect($search->items);

        $firstPlaylist = collect($playlists)->first();

        $playlist = $this->api->getPlaylist($firstPlaylist->id);
        $this->assertEquals($playlist->id, $firstPlaylist->id);

        $playlistTracks = $this->api->getPlaylistTracks($firstPlaylist->id, 15, 5);
    }

    public function testGetFeaturedPlaylists()
    {
        $playlists = $this->api->getFeaturedPlaylists();
        $this->assertTrue(count($playlists->items) > 0);
    }
}
