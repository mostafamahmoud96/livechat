<?php

namespace App\Http\Resources;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data['id']= $this->id;
		$data['name']= $this->name;
		$data['email']= $this->email;
		$data['profile_photo_path']= isset($this->picture)? $this->picture->full_path : null;
        return $data;
    }
}
