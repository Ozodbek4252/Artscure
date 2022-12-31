<?php

namespace App\Services;

use App\Exceptions\Help\HelpStoreException;
use Illuminate\Support\Facades\DB;
use App\Models\Help;

class HelpService
{
    public $request;
    public $help;
    public $client;
    public $basket;

    public function __construct($request = null)
    {
        $this->request = $request->only(['name', 'phone']);
    }

    /**
     * @throws HelpStoreException
     */
    public function store()
    {
        DB::beginTransaction();
        try {
            $this->help = Help::create($this->request);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new HelpStoreException("Cannot store. Error:{$exception->getMessage()}");
        }
        DB::commit();
        return $this;
    }
}
