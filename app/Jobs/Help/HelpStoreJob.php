<?php

namespace App\Jobs\Help;

use App\Jobs\Job;
use Carbon\Carbon;
use App\Models\Help;
use Illuminate\Support\Str;

class HelpStoreJob extends Job
{
    protected $request;
    protected $attributes;

    /**
     * HelpStoreJob constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->attributes = $request->only([
            'name', 'description'
        ]);
        $this->request = $request;
    }

    /**
     *
     */
    public function handle()
    {
        $folder = Carbon::now()->format("Y/m");
        $this->attributes['logo'] = $this->request->file('logo')->store("/uploads/shops/{$folder}");
         //->move(public_path('images/shops'), $image_name);

        return Help::query()->create($this->attributes);
    }
}
