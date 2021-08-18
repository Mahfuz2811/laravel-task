<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['url', 'pocket_id'];

    public function pocket()
    {
        return $this->belongsTo(Pocket::class, 'pocket_id');
    }
}
