<?php

namespace App\Services;

use App\Exceptions\Artist\ArtistDeleteException;
use App\Exceptions\Artist\ArtistStoreException;
use App\Exceptions\Artist\ArtistUpdateException;

use Illuminate\Support\Facades\DB;

use App\Traits\UtilityTrait;

use App\Models\Artist;

class ArtistService
{
    use UtilityTrait;

    public $attributes;
    public $artist;
    public $image;
    public $tools;

    public function __construct($request = null, $artist = null)
    {
        if ($request != null) {
            $this->attributes = $request->except(['_token', '_method', 'image', 'tools']);
            $this->image = $request->image;
            $this->tools = $request->tools;
        }
        $this->artist = $artist;
    }

    /**
     * @throws ArtistStoreException
     */
    public function store()
    {
        DB::beginTransaction();
        try {
            $this->artist = Artist::create($this->attributes);

            // store image using UtilityTrait
            $this->storeImage($this->image, $this->artist, 'Artist', 'artists');

            // store tools using UtilityTrait
            $this->storeTools($this->tools, $this->artist, 'App\Models\Artist');
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new ArtistStoreException("Cannot store. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

    public function update()
    {
        DB::beginTransaction();
        try {
            $this->artist->update($this->attributes);

            if ($this->image != null) {
                // delete old image using UtilityTrait
                $this->deleteImages($this->artist->images);

                // store image using UtilityTrait
                $this->storeImage($this->image, $this->artist, 'Artist', 'artists');
            }

            // delete artist's tools using UtilityTrait
            $this->deleteToolables($this->artist->tools, 'App\Models\Artist');

            // store tools using UtilityTrait
            $this->storeTools($this->tools, $this->artist, 'App\Models\Artist');
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new ArtistUpdateException("Cannot update. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

    public function delete($artist)
    {
        DB::beginTransaction();
        try {
            // delete images using UtilityTrait
            if (count($artist->images) > 0) {
                $this->deleteImages($artist->images);
            }

            // delete artist's tools using UtilityTrait
            if (count($artist->tools) > 0) {
                $this->deleteToolables($artist->tools, 'App\Models\Artist');
            }

            $artist->delete();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new ArtistDeleteException("Cannot delete. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }
}
