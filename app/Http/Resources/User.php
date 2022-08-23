<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'phone' => $this->phone,
            'profile_pic' => getenv("IMAGES")."club_images/".$this->profile_pic,
            'address' => $this->address,
            'region_id' => $this->region_id,
            'city_id' => $this->region_id,
            'zip_code' => $this->zip_code,
            'country' => $this->country,
            'status' => $this->status
        ];
        return $data;
    }
}