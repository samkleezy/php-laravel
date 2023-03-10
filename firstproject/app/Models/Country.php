<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    //find the posts belonging to that country through the User model.
    //pull the posts of a specific country using the country model.
    public function posts(){     
        return $this->hasManyThrough(Post::class,User::class,
            'country_id',  // Foreign key on users table...
            'user_id',      // Foreign key on posts table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );  
    } 
}
