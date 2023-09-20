<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResources extends JsonResource
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
            'id'    => $this->id,
            'title' => $this->title,
            'author'  => $this->author,
            'author_email' => $this->author_email,
            'line'  => LineResources::make($this->label),
            'resumen'  => $this->resumen,
            'project'  => $this->project,
            'type'  => $this->type,
            'user'  => UsersResources::make($this->user),
            'created_at' => $this->created_at
        ];
    }
}
