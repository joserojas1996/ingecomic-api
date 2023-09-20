<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResources extends JsonResource
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
            'correlative' => $this->correlative_number,
            'identity' => $this->info->identity,
            'firstname' => $this->info->firstname,
            'lastname' => $this->info->lastname,
            'email' => $this->email,
            'type' => $this->getRoleNames(),
        ];
    }
}
