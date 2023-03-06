<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    //Inverse of many-to-many (polymorphic) relationship
    //In a many-to-many polymorphic relationship, we found the tags belonging to the post and audio model. But, in an inverse relationship of many-to-many (polymorphic), we will find out all the posts and audios that belong to a particular tag.

    // get all the posts from the tag.   
    public function posts()  
    {  
      return $this->morphedByMany(Post::class,'taggable');   
    }  

    // get all the audios from the tag.  
    public function audios()  
    {  
      return $this->morphedByMany(Audio::class,'taggable');   
    }  
}
