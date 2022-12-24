<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Models\Language;
use phpDocumentor\Reflection\Utils;

abstract class CoreRepository
{
    protected object $model;
    protected $language;
    protected string $updatedDate;

    /* CoreRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
        // $this->language = request('lang') ?? null;
        // $this->currency = request('currency_id')?? null;
        // $this->updatedDate = request('updated_at') ?? '2021-01-01';
    }

    abstract protected function getModelClass();

    protected function model() {
        return clone $this->model;
    }


    /* Set default Language
     */
    // protected function setLanguage() {
    //     return $this->language ?? Language::where('default', 1)->pluck('locale')->first();
    // }

    /* Set Updated Date
     */
    // protected function setUpdatedDate() {
    //     return $this->updatedDate;
    // }
}
