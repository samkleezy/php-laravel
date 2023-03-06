<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;

    //Many-to-many polymorphic relationship
    // get all the tags from the audio.   
    public function tags()  
    {  
        return $this->morphToMany(Tag::class,'taggable');  
    }  
}
