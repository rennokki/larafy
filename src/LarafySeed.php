<?php

namespace Rennokki\Larafy;

class LarafySeed
{
    public $artists = [];
    public $tracks = [];
    public $genres = [];

    public $acousticnessRange = [];
    public $targetAcousticness;

    public $danceabilityRange = [];
    public $targetDanceability;

    public $energyRange = [];
    public $targetEnergy;

    public $instrumentalnessRange = [];
    public $targetInstrumentalness;

    public $keyRange = [];
    public $targetKey;

    public $livenessRange = [];
    public $targetLiveness;

    public $loudnessRange = [];
    public $targetLoudness;

    public $modeRange = [];
    public $targetMode;

    public $popularityRange = [];
    public $targetPopularity;

    public $speechinessRange = [];
    public $targetSpeechiness;

    public $tempoRange = [];
    public $targetTempo;

    public $timeSignatureRange = [];
    public $targetTimeSignature;

    public $valenceRange = [];
    public $targetValence;

    public $durationRange = [];
    public $targetDuration;

    public function __construct()
    {
        $this->artists = collect($this->artists);
        $this->tracks = collect($this->tracks);
        $this->genres = collect($this->genres);

        $a = collect([1, 2, 3, 4]);
    }

    /**
     * Add an artist to the artists seeds.
     *
     * @param string $artistId
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function addArtist(string $artistId)
    {
        if (! $this->artists->contains($artistId)) {
            $this->artists->push($artistId);
        }

        return $this;
    }

    /**
     * Add artists to the artists seeds.
     *
     * @param string|array $artistsIds
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function addArtists($artistsIds)
    {
        if (is_array($artistsIds)) {
            $artistsIds = collect($artistsIds);
        }

        if (is_string($artistsIds)) {
            $artistsIds = collect(explode(',', $artistsIds));
        }

        $artistsIds->each(function ($item, $key) {
            $this->addArtist($item);
        });

        return $this;
    }

    /**
     * Set artists as seed.
     *
     * @param string|array $artistsIds
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setArtists($artistsIds)
    {
        if (is_array($artistsIds)) {
            $this->artists = collect($artistsIds);
        }

        if (is_string($artistsIds)) {
            $this->artists = collect(explode(',', $artistsIds));
        }

        return $this;
    }

    /**
     * Add track to the tracks seeds.
     *
     * @param string $trackId
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function addTrack(string $trackId)
    {
        if (! $this->tracks->contains($trackId)) {
            $this->tracks->push($trackId)->toArray();
        }

        return $this;
    }

    /**
     * Add tracks to the tracks seeds.
     *
     * @param string|array $tracksIds
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function addTracks($tracksIds)
    {
        if (is_array($tracksIds)) {
            $tracksIds = collect($tracksIds);
        }

        if (is_string($tracksIds)) {
            $tracksIds = collect(explode(',', $tracksIds));
        }

        $tracksIds->map(function ($item, $key) {
            $this->addTrack($item);
        });

        return $this;
    }

    /**
     * Set tracks as seed.
     *
     * @param string|array $tracksIds
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTracks($tracksIds)
    {
        if (is_array($tracksIds)) {
            $this->tracks = collect($tracksIds);
        }

        if (is_string($tracksIds)) {
            $this->tracks = collect(explode(',', $tracksIds));
        }

        return $this;
    }

    /**
     * Add genre to the genres seeds.
     *
     * @param string $genreId
     */
    public function addGenre(string $genreId)
    {
        if (! $this->genres->contains($genreId)) {
            $this->genres->push($genreId);
        }

        return $this;
    }

    /**
     * Add genres to the genres seeds.
     *
     * @param string|array $genresIds
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function addGenres($genresIds)
    {
        if (is_array($genresIds)) {
            $genresIds = collect($genresIds);
        }

        if (is_string($genresIds)) {
            $genresIds = collect(explode(',', $genresIds));
        }

        $genresIds->map(function ($item, $key) {
            $this->addGenre($item);
        });

        return $this;
    }

    /**
     * Set genres as seed.
     *
     * @param string|array $genresIds
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setGenres($genresIds)
    {
        if (is_array($genresIds)) {
            $this->genres = collect($genresIds);
        }

        if (is_string($genresIds)) {
            $this->genres = collect(explode(',', $genresIds));
        }

        return $this;
    }

    /**
     * Set acousticness range.
     *
     * @param float $min
     * @param float $max
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setAcousticness(float $min, float $max)
    {
        $this->acousticnessRange = [$min, $max];

        return $this;
    }

    /**
     * Set target acousticness.
     *
     * @param float $target
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTargetAcousticness(float $target)
    {
        $this->targetAcousticness = $target;

        return $this;
    }

    /**
     * Set danceability range.
     *
     * @param float $min
     * @param float $max
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setDanceability(float $min, float $max)
    {
        $this->danceabilityRange = [$min, $max];

        return $this;
    }

    /**
     * Set target danceability.
     *
     * @param float $target
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTargetDanceability(float $target)
    {
        $this->targetDanceability = $target;

        return $this;
    }

    /**
     * Set energy range.
     *
     * @param float $min
     * @param float $max
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setEnergy(float $min, float $max)
    {
        $this->energyRange = [$min, $max];

        return $this;
    }

    /**
     * Set target energy.
     *
     * @param float $target
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTargetEnergy(float $target)
    {
        $this->targetEnergy = $target;

        return $this;
    }

    /**
     * Set instrumentalness range.
     *
     * @param float $min
     * @param float $max
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setInstrumentalness(float $min, float $max)
    {
        $this->instrumentalnessRange = [$min, $max];

        return $this;
    }

    /**
     * Set target instrumentalness.
     *
     * @param float $target
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTargetInstrumentalness(float $target)
    {
        $this->targetInstrumentalness = $target;

        return $this;
    }

    /**
     * Set key range.
     *
     * @param int $min
     * @param int $max
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setKeys(int $min, int $max)
    {
        $this->keyRange = [$min, $max];

        return $this;
    }

    /**
     * Set target key.
     *
     * @param int $target
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTargetKey(int $target)
    {
        $this->targetKey = $target;

        return $this;
    }

    /**
     * Set liveness range.
     *
     * @param float $min
     * @param float $max
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setLiveness(float $min, float $max)
    {
        $this->livenessRange = [$min, $max];

        return $this;
    }

    /**
     * Set target liveness.
     *
     * @param float $target
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTargetLiveness(float $target)
    {
        $this->targetLiveness = $target;

        return $this;
    }

    /**
     * Set liveness range.
     *
     * @param float $min
     * @param float $max
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setLoudness(float $min, float $max)
    {
        $this->loudnessRange = [$min, $max];

        return $this;
    }

    /**
     * Set target loudness.
     *
     * @param float $target
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTargetLoudness(float $target)
    {
        $this->targetLoudness = $target;

        return $this;
    }

    /**
     * Set mode range.
     *
     * @param int $min
     * @param int $max
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setMode(int $min, int $max)
    {
        $this->modeRange = [$min, $max];

        return $this;
    }

    /**
     * Set target mode.
     *
     * @param int $target
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTargetMode(int $target)
    {
        $this->targetMode = $target;

        return $this;
    }

    /**
     * Set popularity range.
     *
     * @param float $min
     * @param float $max
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setPopularity(float $min, float $max)
    {
        $this->popularityRange = [$min, $max];

        return $this;
    }

    /**
     * Set target popularity.
     *
     * @param float $target
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTargetPopularity(float $target)
    {
        $this->targetPopularity = $target;

        return $this;
    }

    /**
     * Set speechiness range.
     *
     * @param float $min
     * @param float $max
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setSpeechiness(float $min, float $max)
    {
        $this->speechinessRange = [$min, $max];

        return $this;
    }

    /**
     * Set target speechiness.
     *
     * @param float $target
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTargetSpeechiness(float $target)
    {
        $this->targetSpeechiness = $target;

        return $this;
    }

    /**
     * Set tempo range.
     *
     * @param int $min
     * @param int $max
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTempo(int $min, int $max)
    {
        $this->tempoRange = [$min, $max];

        return $this;
    }

    /**
     * Set target tempo.
     *
     * @param int $target
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTargetTempo(int $target)
    {
        $this->targetTempo = $target;

        return $this;
    }

    /**
     * Set time signature range.
     *
     * @param int $min
     * @param int $max
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTimeSignature(int $min, int $max)
    {
        $this->timeSignatureRange = [$min, $max];

        return $this;
    }

    /**
     * Set target time signature.
     *
     * @param int $target
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTargetTimeSignature(int $target)
    {
        $this->targetTimeSignature = $target;

        return $this;
    }

    /**
     * Set valence range.
     *
     * @param float $min
     * @param float $max
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setValence(float $min, float $max)
    {
        $this->valenceRange = [$min, $max];

        return $this;
    }

    /**
     * Set target valence.
     *
     * @param float $target
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTargetValence(float $target)
    {
        $this->targetValence = $target;

        return $this;
    }

    /**
     * Set duration range.
     *
     * @param int $min
     * @param int $max
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setDuration(int $min, int $max)
    {
        $this->durationRange = [(int) ($min * 1000), (int) ($max * 1000)];

        return $this;
    }

    /**
     * Set target duration.
     *
     * @param int $target
     * @return \Rennokki\Larafy\LarafySeed
     */
    public function setTargetDuration(int $target)
    {
        $this->targetDuration = (int) ($target * 1000);

        return $this;
    }

    /**
     * Get the array for API.
     *
     * @return array
     */
    public function getArrayForAPI()
    {
        $ranges = [
            'acousticness' => $this->acousticnessRange,
            'danceability' => $this->danceabilityRange,
            'energy' => $this->energyRange,
            'instrumentalness' => $this->instrumentalnessRange,
            'key' => $this->keyRange,
            'liveness' => $this->livenessRange,
            'loudness' => $this->loudnessRange,
            'mode' => $this->modeRange,
            'popularity' => $this->popularityRange,
            'speechiness' => $this->speechinessRange,
            'tempo' => $this->tempoRange,
            'time_signature' => $this->timeSignatureRange,
            'valence' => $this->valenceRange,
            'duration_ms' => $this->durationRange,
        ];

        $targets = [
            'acousticness' => $this->targetAcousticness,
            'danceability' => $this->targetDanceability,
            'energy' => $this->targetEnergy,
            'instrumentalness' => $this->targetInstrumentalness,
            'key' => $this->targetKey,
            'liveness' => $this->targetLiveness,
            'loudness' => $this->targetLoudness,
            'mode' => $this->targetMode,
            'popularity' => $this->targetPopularity,
            'speechiness' => $this->targetSpeechiness,
            'tempo' => $this->targetTempo,
            'time_signature' => $this->targetTimeSignature,
            'valence' => $this->targetValence,
            'duration_ms' => $this->targetDuration,
        ];

        $array = collect([]);

        if ($this->artists->count() > 0) {
            $array->put('seed_artists', $this->artists->unique()->implode(','));
        }

        if ($this->tracks->count() > 0) {
            $array->put('seed_tracks', $this->tracks->unique()->implode(','));
        }

        if ($this->genres->count() > 0) {
            $array->put('seed_genres', $this->genres->unique()->implode(','));
        }

        foreach ($ranges as $field => $range) {
            if (count($range) > 0) {
                $array->put('min_'.$field, $range[0]);
                $array->put('max_'.$field, $range[1]);
            }
        }

        foreach ($targets as $field => $target) {
            if (! is_null($target)) {
                $array->put('target_'.$field, $target);
            }
        }

        return $array->toArray();
    }
}
