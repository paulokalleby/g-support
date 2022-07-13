<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResource extends JsonResource
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
            'id'         => $this->id,
            'identify'   => $this->identify,
            'category'   => $this->category->name,
            'title'      => $this->title,
            'problem'    => $this->problem,
            'attendance' => $this->attendance->name ?? '',
            'solution'   => $this->solution,
            'status'     => config('enums.status')[$this->status] ?? 'Not Found Status',
            'active'     => $this->active,
            'opened'     => Carbon::make($this->created_at)->format('Y-m-d H:i:s'),
            'updating'   => Carbon::make($this->updated_at)->format('Y-m-d H:i:s'),
            'timelines'  => TimelineResource::collection($this->timelines),
        ];
    }
}
