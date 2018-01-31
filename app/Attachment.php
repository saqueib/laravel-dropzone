<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    protected $guarded = [];

    protected $appends = ['url'];

    public function attachable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return Storage::url($this->uid);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($attachment) {
            // delete associated file from storage
            Storage::disk('public')->delete($attachment->uid);
        });
    }
}
