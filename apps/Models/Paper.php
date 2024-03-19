<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Paper extends Model
{
    use HasFactory, Searchable;
    protected $fillable = [
        'slug',
        'title',
        'content',
        'abstract',
        'authors',
        'file_path',
        'reference',
        // 'reviewer_id',
        'transaction_id',
        'user_id'
    ];

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'abstract' => $this->abstract,
        ];
    }
}
