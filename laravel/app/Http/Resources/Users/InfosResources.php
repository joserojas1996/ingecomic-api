<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class InfosResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => encrypt($this->id),
            'identity' => $this->identity,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'user'      => isset($this->user_id) ? 1 : 0,
            'type'      => $this->type    
        ];
    }
}
