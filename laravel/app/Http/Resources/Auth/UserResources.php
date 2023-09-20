<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Permission\Models\Permission;

class UserResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => encrypt($this->id),
            'correlative' => $this->correlative_number,
            'identity' => $this->info->identity,
            'name' => $this->info->firstname .' '. $this->info->lastname,
            'email.' => $this->email,
            'role' => $this->getRoleNames(),
            'permissions' => $this->hasRole('super-admin')
                ? Permission::all()->pluck('name')
                : $this->getAllPermissions()->pluck('name'),
        ];
        
    }
}
