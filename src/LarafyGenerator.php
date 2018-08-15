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
        return 'spotify:album:'.$albumId;
    }

    /**
     * Generate an URI format for track.
     *
     * @param string $trackId
     * @return string
     */
    public static function URIForTrack($trackId)
    {
        return 'spotify:track:'.$trackId;
    }

    /**
     * Generate an URI format for artist.
     *
     * @param string $artistId
     * @return string
     */
    public static function URIForArtist($artistId)
    {
        return 'spotify:artist:'.$artistId;
    }

    /**
     * Generate an URL for an album.
     *
     * @param string $albumId
     * @return string
     */
    public static function URLForAlbum($albumId)
    {
        return 'https://open.spotify.com/album/'.$albumId;
    }

    /**
     * Generate an URL for a playlist.
     *
     * @param string $playlistId
     * @return string
     */
    public static function URLForPlaylist($playlistId)
    {
        return 'https://open.spotify.com/playlist/'.$playlistId;
    }

    /**
     * Generate an URL for a track.
     *
     * @param string $trackId
     * @return string
     */
    public static function URLForTrack($trackId)
    {
        return 'https://open.spotify.com/track/'.$trackId;
    }

    /**
     * Generate an URL for an artist.
     *
     * @param string $artistId
     * @return string
     */
    public static function URLForArtist($artistId)
    {
        return 'https://open.spotify.com/artist/'.$artistId;
    }
}
