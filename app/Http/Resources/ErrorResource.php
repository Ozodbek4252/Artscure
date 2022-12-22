<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class ErrorResource extends JsonResource
{
    protected $type;
    protected $messages;

    /**
     * ErrorResources constructor.
     * @param $type
     * @param $messages
     */
    public function __construct($type, $messages)
    {
        $this->type = $type;
        $this->messages = $messages;
    }

    public static $wrap = false;

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        Log::info("type: {$this->type} Message: {$this->messages}" );

        return [
            'message' => $this->messages
        ];
    }
}
