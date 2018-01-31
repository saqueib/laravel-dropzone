<?php

namespace App;

use App\Attachment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
