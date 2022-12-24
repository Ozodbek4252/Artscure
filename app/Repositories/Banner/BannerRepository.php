<?php
namespace App\Http\Repositories\Banner;

use App\Repositories\CoreRepository;
use App\Models\Banner;

class BannerRepository extends CoreRepository
{
    public function getModelClass()
    {
        return Banner::class;
    }
}

