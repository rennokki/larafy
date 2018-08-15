<?php

namespace Rennokki\Larafy\Test;

use Rennokki\Larafy\LarafySeed;

class BrowseTest extends TestCase
{
    public function testGetGenresSeeds()
    {
        $seeds = $this->api->getGenreSeeds();
        $this->assertTrue(count($seeds) > 0);
    }

    public function testGetBrowseCategories()
    {
        $categories = $this->api->getBrowseCategories(15, 5);
        $this->assertEquals(count($categories->items), 15);

        $firstCategory = collect($categories->items)->first();

        $category = $this->api->getBrowseCategory($firstCategory->id);
        $this->assertEquals($category->id, $firstCategory->id);

        $playlists = $this->api->getCategoryPlaylists($firstCategory->id, 15, 5);
        $this->assertEquals(count($playlists->items), 15);
    }

    public function testGetNewReleases()
    {
        $releases = $this->api->getNewReleases(15, 5);
        $this->assertEquals(count($releases->items), 15);
    }

    public function testGetRecommendations()
    {
        $seed = (new LarafySeed)->setGenres(['death-metal', 'hard-rock', 'black-metal']);
        $recommendations = $this->api->getRecommendations($seed, 15);

        $this->assertEquals(count($recommendations), 15);
    }
}
