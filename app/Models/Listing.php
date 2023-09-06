<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ["title", "company", "location", "website", "email", "description", "tags", 'logo'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters["tag"] ?? false) {
            $query->where("tags", "like", "%" . request("tag") . "%");
        }

        if ($filters["search"] ?? false) {
            $query->where("title", "like", "%" . request("search") . "%")
                ->orWhere("description", "like", "%" . request("search") . "%")
                ->orWhere("tags", "like", "%" . request("search") . "%");
        }
    }
    // TODO: query don't run
    // TODO: explain why write like it
    // TODO: how to write $query->where("tags", "like", "%" . request("tag") . "%");
    // easier
}
