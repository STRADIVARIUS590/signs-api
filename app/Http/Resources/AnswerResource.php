<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
    // $product->cover_path = URL::to('')."/storage/products/covers/".$product->cover_path; 

        // return ['asd' => (Storage::exists($this->image_path))];
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'text' => $this->meaning,
            'image' => URL::to('')."/storage/".$this->image_path
        ];
    }
}
