<?php

namespace Rennokki\Larafy\Test;

class AlbumsTest extends TestCase
{
    public function testGetAlbums()
    {
        $search = $this->api->searchAlbums('Master of Puppets', 15);
        $albums = collect($search->items);
        $albumsIds = $albums->pluck('id')->toArray();

        $albums = $this->api->getAlbums($albumsIds);
        $firstAlbum = collect($albums)->first();

        $album = $this->api->getAlbum($firstAlbum->id);
        $this->assertEquals($album->id, $firstAlbum->id);

        $albumTracks = $this->api->getAlbumTracks($firstAlbum->id, 15, 5);
    }
}
