<?php

namespace Rennokki\Larafy\Traits;

use Rennokki\Larafy\LarafySeed;

trait BrowseTrait
{
    public function getGenreSeeds()
    {
        $json = $this->get()->request('/recommendations/available-genre-seeds');

        return $json->genres;
    }

    public function getBrowseCategories(int $limit = 10, int $offset = 0)
    {
        $json = $this->get()->request('/browse/categories', [
            'country' => $this->market,
            'locale' => $this->locale,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $json->categories;
    }

    public function getBrowseCategory(string $categoryId)
    {
        $json = $this->get()->request('/browse/categories/'.$categoryId, [
            'country' => $this->market,
            'locale' => $this->locale,
        ]);

        return $json;
    }

    public function getCategoryPlaylists(string $categoryId, int $limit = 10, int $offset = 0)
    {
        $json = $this->get()->request('/browse/categories/'.$categoryId.'/playlists', [
            'country' => $this->market,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $json->playlists;
    }

    public function getNewReleases(int $limit = 10, int $offset = 0)
    {
        $json = $this->get()->request('/browse/new-releases', [
            'country' => $this->market,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $json->albums;
    }

    public function getRecommendations(LarafySeed $seed, int $limit = 10)
    {
        $json = $this->get()->request('/recommendations', array_merge([
            'limit' => $limit,
            'market' => $this->market,
        ], $seed->getArrayForAPI()));

        return $json->tracks;
    }
}
