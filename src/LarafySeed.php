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

    public function addArtist(string $artistId)
    {
        if(!$this->artists->contains($artistId)) {
            $this->artists->push($artistId);
        }

        return $this;
    }

    public function addArtists($artistsIds)
    {
        if(is_array($artistsIds)) {
            $artistsIds = collect($artistsIds);
        }

        if(is_string($artistsIds)) {
            $artistsIds = collect(explode(',', $artistsIds));
        }

        $artistsIds->each(function($item, $key) {
            if(!$this->artists->contains($item)) {
                $this->artists->push($item);
            }
        });

        return $this;
    }

    public function setArtists($artistsIds)
    {
        if(is_array($artistsIds)) {
            $this->artists = collect($artistsIds);
        }

        if(is_string($artistsIds)) {
            $this->artists = collect(explode(',', $artistsIds));
        }

        return $this;
    }

    public function addTrack(string $trackId)
    {
        if(!$this->tracks->contains($trackId)) {
            $this->tracks->push($trackId)->toArray();
        }

        return $this;
    }

    public function addTracks($tracksIds)
    {
        if(is_array($tracksIds)) {
            $tracksIds = collect($tracksIds);
        }

        if(is_string($tracksIds)) {
            $tracksIds = collect(explode(',', $tracksIds));
        }
    
        $tracksIds->map(function($item, $key) {
            if(!$this->tracks->contains($item)) {
                $this->tracks->push($item);
            }
        });

        return $this;
    }

    public function setTracks($tracksIds)
    {
        if(is_array($tracksIds)) {
            $this->tracks = collect($tracksIds);
        }

        if(is_string($tracksIds)) {
            $this->tracks = collect(explode(',', $tracksIds));
        }

        return $this;
    }

    public function addGenre(string $genreId)
    {
        if(!$this->genres->contains($genreId)) {
            $this->genres->push($genreId);
        }

        return $this;
    }

    public function addGenres($genresIds)
    {
        if(is_array($genresIds)) {
            $genresIds = collect($genresIds);
        }

        if(is_string($genresIds)) {
            $genresIds = collect(explode(',', $genresIds));
        }
    
        $genresIds->map(function($item, $key) {
            if(!$this->genres->contains($item)) {
                $this->genres->push($item);
            }
        });

        return $this;
    }

    public function setGenres($genresIds)
    {
        if(is_array($genresIds)) {
            $this->genres = collect($genresIds);
        }

        if(is_string($genresIds)) {
            $this->genres = collect(explode(',', $genresIds));
        }

        return $this;
    }

    public function setAcousticness(float $min, float $max)
    {
        $this->acousticnessRange = [$min, $max];

        return $this;
    }

    public function setTargetAcousticness(float $target)
    {
        $this->targetAcousticness = $target;

        return $this;
    }

    public function setDanceability(float $min, float $max)
    {
        $this->danceabilityRange = [$min, $max];

        return $this;
    }

    public function setTargetDanceability(float $target)
    {
        $this->targetDanceability = $target;

        return $this;
    }

    public function setEnergy(float $min, float $max)
    {
        $this->energyRange = [$min, $max];

        return $this;
    }

    public function setTargetEnergy(float $target)
    {
        $this->targetEnergy = $target;

        return $this;
    }

    public function setInstrumentalness(float $min, float $max)
    {
        $this->instrumentalnessRange = [$min, $max];

        return $this;
    }

    public function setTargetInstrumentalness(float $target)
    {
        $this->targetInstrumentalness = $target;

        return $this;
    }

    public function setKeys(int $min, int $max)
    {
        $this->keyRange = [$min, $max];

        return $this;
    }

    public function setTargetKey(int $target)
    {
        $this->targetKey = $target;

        return $this;
    }

    public function setLiveness(float $min, float $max)
    {
        $this->livenessRange = [$min, $max];

        return $this;
    }

    public function setTargetLiveness(float $target)
    {
        $this->targetLiveness = $target;

        return $this;
    }

    public function setLoudness(float $min, float $max)
    {
        $this->loudnessRange = [$min, $max];

        return $this;
    }

    public function setTargetLoudness(float $target)
    {
        $this->targetLoudness = $target;

        return $this;
    }

    public function setMode(int $min, int $max)
    {
        $this->modeRange = [$min, $max];

        return $this;
    }

    public function setTargetMode(int $target)
    {
        $this->targetMode = $target;

        return $this;
    }

    public function setPopularity(float $min, float $max)
    {
        $this->popularityRange = [$min, $max];

        return $this;
    }

    public function setTargetPopularity(float $target)
    {
        $this->targetPopularity = $target;

        return $this;
    }

    public function setSpeechiness(float $min, float $max)
    {
        $this->speechinessRange = [$min, $max];

        return $this;
    }

    public function setTargetSpeechiness(float $target)
    {
        $this->targetSpeechiness = $target;

        return $this;
    }

    public function setTempo(int $min, int $max)
    {
        $this->tempoRange = [$min, $max];

        return $this;
    }

    public function setTargetTempo(int $target)
    {
        $this->targetTempo = $target;

        return $this;
    }

    public function setTimeSignature(int $min, int $max)
    {
        $this->timeSignatureRange = [$min, $max];

        return $this;
    }

    public function setTargetTimeSignature(int $target)
    {
        $this->targetTimeSignature = $target;

        return $this;
    }

    public function setValence(float $min, float $max)
    {
        $this->valenceRange = [$min, $max];

        return $this;
    }

    public function setTargetValence(float $target)
    {
        $this->targetValence = $target;

        return $this;
    }

    public function setDuration(int $min, int $max)
    {
        $this->durationRange = [(int) ($min*1000), (int) ($max*1000)];

        return $this;
    }

    public function setTargetDuration(int $target)
    {
        $this->targetDuration = (int) ($target*1000);

        return $this;
    }

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

        if($this->artists->count() > 0) {
            $array->put('seed_artists', $this->artists->unique()->implode(','));
        }

        if($this->tracks->count() > 0) {
            $array->put('seed_tracks', $this->tracks->unique()->implode(','));
        }

        if($this->genres->count() > 0) {
            $array->put('seed_genres', $this->genres->unique()->implode(','));
        }

        foreach($ranges as $field => $range) {
            if(count($range) > 0) {
                $array->put('min_'.$field, $range[0]);
                $array->put('max_'.$field, $range[1]);
            }
        }

        foreach($targets as $field => $target) {
            if(!is_null($target)) {
                $array->put('target_'.$field, $target);
            }
        }

        return $array->toArray();
    }
}