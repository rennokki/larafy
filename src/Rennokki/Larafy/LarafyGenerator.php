<?php

namespace Rennokki\Larafy;

class LarafyGenerator
{
    /**
     * Generate an URI format for album.
     *
     * @param string $albumId
     * @return string
     */
    public static function URIForAlbum($albumId)
    {
        return 'spotify:album:' . $albumId;
    }


    /**
     * Generate an URI format for track.
     *
     * @param string $trackId
     * @return string
     */
    public static function URIForTrack($trackId)
    {
        return 'spotify:track:' . $trackId;
    }


    /**
     * Generate an URI format for artist.
     *
     * @param string $artistId
     * @return string
     */
    public static function URIForArtist($artistId)
    {
        return 'spotify:artist:' . $artistId;
    }


    /**
     * Generate an URL for an album.
     *
     * @param string $albumId
     * @return string
     */
    public static function URLForAlbum($albumId)
    {
        return 'https://open.spotify.com/album/' . $albumId;
    }


    /**
     * Generate an URL for a playlist.
     *
     * @param string $playlistId
     * @return string
     */
    public static function URLForPlaylist($playlistId)
    {
        return 'https://open.spotify.com/playlist/' . $playlistId;
    }


    /**
     * Generate an URL for a track.
     *
     * @param string $trackId
     * @return string
     */
    public static function URLForTrack($trackId)
    {
        return 'https://open.spotify.com/track/' . $trackId;
    }


    /**
     * Generate an URL for an artist.
     *
     * @param string $artistId
     * @return string
     */
    public static function URLForArtist($artistId)
    {
        return 'https://open.spotify.com/artist/' . $artistId;
    }


    /**
     * Generate an URL for an user.
     *
     * @param string $userId
     * @return string
     */
    public static function URLForUser($userId)
    {
        return 'https://open.spotify.com/user/' . $userId;
    }


    public static function parseSpotifyURI($uri)
    {
        $matches = [];
        if (!preg_match('/spotify:(album|artist|track):([a-zA-Z0-9]+)$/', $uri, $matches)) {
            return false;
        }

        return (object)[
            'type' => $matches[1],
            'id' => $matches[2],
        ];
    }


    public static function parseSpotifyURL($url)
    {
        $matches = [];
        if (!preg_match('/https:\/\/open.spotify.com\/(album|artist|track)\/([a-zA-Z0-9]+)$/', strtok($url, '?'), $matches)) {
            return false;
        }

        return (object)[
            'type' => $matches[1],
            'id' => $matches[2],
        ];
    }
}
