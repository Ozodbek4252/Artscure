<?php

namespace App\Services;

use App\Exceptions\News\NewsDeleteException;
use App\Exceptions\News\NewsStoreException;
use App\Exceptions\News\NewsUpdateException;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Traits\UtilityTrait;

use App\Models\News;

class NewsService
{
    use UtilityTrait;

    public $attributes;
    public $news;
    public $image;
    public $tools;

    public function __construct($request = null, $news = null)
    {
        if ($request != null) {
            $this->attributes = $request->except(['_token', '_method', 'image']);
            $this->attributes['slug'] = str_replace(' ', '_', strtolower($this->attributes['title_uz'])) . '-' . Str::random(8);
            $this->image = $request->image;
        }
        $this->news = $news;
    }

    /**
     * @throws ArtistStoreException
     */
    public function store()
    {
        DB::beginTransaction();
        try {
            $this->news = News::create($this->attributes);

            // store image using UtilityTrait
            $this->storeImage($this->image, $this->news, 'News', 'news');

        } catch (\Exception $exception) {
            DB::rollBack();
            throw new NewsStoreException("Cannot store. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

    public function update()
    {
        DB::beginTransaction();
        try {
            $this->news->update($this->attributes);

            if ($this->image != null) {
                // delete old image using UtilityTrait
                $this->deleteImages($this->news->images);

                // store image using UtilityTrait
                $this->storeImage($this->image, $this->news, 'News', 'news');
            }

        } catch (\Exception $exception) {
            DB::rollBack();
            throw new NewsUpdateException("Cannot update. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

    public function delete($news)
    {
        DB::beginTransaction();
        try {
            // delete images using UtilityTrait
            if (count($news->images)>0) {
                $this->deleteImages($news->images);
            }

            $news->delete();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new NewsDeleteException("Cannot delete. Error:{$exception->getMessage()}");
        }
        DB::commit();

        return $this;
    }

}
