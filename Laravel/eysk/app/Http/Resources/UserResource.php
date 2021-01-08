<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    { //dd(1);
        //return parent::toArray($request);
       /* return [
            'name'       => $this->name,
            'email'      => $this->email,
            
        ];*/
    }
}
