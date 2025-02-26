<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravolt\Avatar\Facade as Avatar;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
             "name" => $this->name,
             "email" => $this->email,
             "email_verified_at" => $this->email_verified_at,
             "created_at" => $this->created_at,
             "updated_at" => $this->update_at,
             "username" => $this->username,
             'pinned_post_id' => $this->pinned_post_id,
             "cover_url" => $this->cover_path ? Storage::url($this->cover_path) : null,
             "avatar_url" => $this->avatar_path ? Storage::url($this->avatar_path) : "https://ui-avatars.com/api/?name=" . urlencode($this->name) . "&size=100&background=dfe7fd&color=647acb",
        ];
    }
}
