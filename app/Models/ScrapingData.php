<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScrapingData extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['url', 'title', 'content', 'image_url', 'content_id'];

    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}
