<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pocket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title'];

    public function contents()
    {
        return $this->hasMany(Content::class, 'pocket_id');
    }
}
