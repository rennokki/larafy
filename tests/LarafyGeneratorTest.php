<?php

namespace Rennokki\Larafy\Test;

use Rennokki\Larafy\LarafyGenerator;

class LarafyGeneratorTest extends TestCase
{
    public function testURIs()
    {
        $this->assertEquals(LarafyGenerator::URIForAlbum('123'), 'spotify:album:123');
        $this->assertEquals(LarafyGenerator::URIForTrack('123'), 'spotify:track:123');
        $this->assertEquals(LarafyGenerator::URIForArtist('123'), 'spotify:artist:123');
    }

    public function testURLs()
    {
        $this->assertEquals(LarafyGenerator::URLForAlbum('123'), 'https://open.spotify.com/album/123');
        $this->assertEquals(LarafyGenerator::URLForPlaylist('123'), 'https://open.spotify.com/playlist/123');
        $this->assertEquals(LarafyGenerator::URLForTrack('123'), 'https://open.spotify.com/track/123');
        $this->assertEquals(LarafyGenerator::URLForArtist('123'), 'https://open.spotify.com/artist/123');
    }
}
