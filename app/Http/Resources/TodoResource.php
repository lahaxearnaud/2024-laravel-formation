<?php

namespace App\Http\Resources;

use App\Models\Todo;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;
use Psy\Util\Json;

/**
 * @mixin Todo
 */
class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>|Arrayable<string, mixed>|JsonSerializable
     */
    public function toArray(Request $request): array|Arrayable|JsonSerializable
    {
        // ici on peut retravailler la sortie
        return parent::toArray($request);
    }
}
