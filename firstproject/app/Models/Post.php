<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    //Table Names
    //The table associated with the model.  
    protected $table = 'posts'; 
    //The primary key associated with the table.
    protected $primaryKey = 'id';
    //*# non-incrementing value to the primary key
    //public $incrementing = false;
    //*# non-integer value to the primary key
    //protected $keyType = 'string';
    protected $dates=['deleted_at'];  

    protected $fillable=  
    [  
        'title',  
        'body'  
    ];  

    //Inverse Relation of (USER hasOne POST)
    //One POST belongsTo USER
    public function user()  
    {  
        return $this->belongsTo(User::class);  
    }

    //Polymorphic relationship
    //One-to-many (Polymorphic)
    public function photos()  
    {  
        return $this->morphMany(Photo::class,'imageable');  
    }  

    //Many-to-many polymorphic relationship
    // get all the tags from this post.  
    public function tags()  
    {  
        return $this->morphToMany(Tag::class,'taggable');  
    }  

}
