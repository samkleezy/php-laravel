<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    //Laravel Eloquent relationship
    /**
     * Get the posts for the user.
     */ 

    ////One to one relationship --- (one USER hasOne POST)
    public function post()  
    {   
        return $this->hasOne(Post::class,'user_id'); 
    }  

    ////One-to-many relationship --- (one USER hasMany POSTs) 
    public function posts()  
    {         
        return $this->hasMany(Post::class,'user_id');  
    }  

    //Get the roles
    ////Many-to-many relationship --- 
    public function roles()  
    {  
        return $this->belongsToMany(Role::class,'roles_user','user_id','role_id');  
    } 

    //retrieve the specific column from the pivot table,
    public function role()  
    {  
        return $this->belongsToMany(Role::class,'roles_user')->withPivot('created_at');  
    }  

    //Polymorphic relationship
    //One-to-many (Polymorphic)
    public function photos()  
    {  
        return $this->morphMany(Photo::class,'imageable');  
    }  

      

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
