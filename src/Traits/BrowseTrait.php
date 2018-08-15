<?php

namespace Rennokki\Larafy\Traits;

use Rennokki\Larafy\LarafySeed;

trait BrowseTrait
{
    /**
     * Get the list of genre seeds.
     *
     * @return array
     */
    public function getGenreSeeds()
    {
        $json = $this->get()->request('/recommendations/available-genre-seeds');

        return $json->genres;
    }

    /**
     * Get categories from the Browse section.
     *
     * @param int $limit
     * @param int $offset
     * @return string The JSON response.
     */
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

    /**
     * Get category details from Browse.
     *
     * @param string $categoryId
     * @return string The JSON response.
     */
    public function getBrowseCategory(string $categoryId)
    {
        $json = $this->get()->request('/browse/categories/'.$categoryId, [
            'country' => $this->market,
            'locale' => $this->locale,
        ]);

        return $json;
    }

    /**
     * Get playlists from a specific Browse category.
     *
     * @param string $categoryId
     * @param int $limit
     * @param int $offset
     * @return string The JSON response.
     */
    public function getCategoryPlaylists(string $categoryId, int $limit = 10, int $offset = 0)
    {
        $json = $this->get()->request('/browse/categories/'.$categoryId.'/playlists', [
            'country' => $this->market,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $json->playlists;
    }

    /**
     * Get new albums releases.
     *
     * @param int $limit
     * @param int $offset
     * @return string The JSON response.
     */
    public function getNewReleases(int $limit = 10, int $offset = 0)
    {
        $json = $this->get()->request('/browse/new-releases', [
            'country' => $this->market,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $json->albums;
    }

    /**
     * Get track recommendations based on seeds.
     *
     * @param \Rennokki\Larafy\LarafySeed $seed
     * @param int $limit
     */
    public function getRecommendations(LarafySeed $seed, int $limit = 10)
    {
        $json = $this->get()->request('/recommendations', array_merge([
            'limit' => $limit,
            'market' => $this->market,
        ], $seed->getArrayForAPI()));

        return $json->tracks;
    }
}
