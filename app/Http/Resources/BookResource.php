<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            "id" => $this->id,
            "title" => $this->title,
            "slug" => $this->slug,
            "image" => $this->image,
            "price" => $this->price,
            "quantity" => $this->quantity,
            "created_at" => $this->created_at,
            // "aa" => $this->author,
        ];

        if ($request->query('include_details', false)) {
           
            $data['published_year'] = $this->published_year;
            $data['description'] = $this->description;
            $data['isbn'] = $this->isbn;
            $data['pages'] = $this->pages;
            $data['translator'] = $this->translator;
            $data['author'] = $this->author;
            $data['publisher'] = $this->publisher;
            $data['category'] = $this->category;
            $data['comments'] =  CommentResource::collection($this->comments->sortDesc());
        }

        if ($request->query('include_category', false)) {
            $data['category'] = $this->category;
        }

        if ($request->query('include_author', false)) {
            $data['author'] = $this->author;
        }

        return $data;
    }
}
