<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;  //For reaching Post Model (Eloquent routing without controller)
use App\Models\User; //user hasOne relationship with Post
use App\Models\Country;
use App\Models\Photo;
use App\Models\Audio;
use App\Models\Tag;
use App\Models\Taggable;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/example', function ()  
 {      
return "Hello javaTpoint";  
});  


/*

//register a route that responds to the multiple http verbs
Route::match(['get', 'post'], '/', function () {  
//  
});  

//register a node that responds to all the http verbs
Route::any('/', function ()   
{  
//  
})  

//Redirect() method is used to navigate from one URL to another URL.
//First way is to declare the redirect() method in get() method: 
Route::get('hello', function () {  
    return redirect('/');  
})  
Second way is to access the redirect() method directly. 
Route::redirect('hello','/');  
*/

//View() method is used to return the view of another URL. 
Route::get('/', function () {  
    return view('welcome');  
});  

Route::view('/','welcome');  



//examples without route parameters. 
Route::get('/', function()  
{  
  return "This is a home page";   
}  
);  
Route::get('/about', function()  
{  
  return "This is a about us page";   
}  
);  
Route::get('/contact', function()  
{  
  return "This is a contact us page";   
}  
);  


//example with route parameters.
Route::get('/post/{id}', function($id)  
{  
  return "id number is : ". $id;   
}  
);  

//example with multiple route parameters. 
Route::get('/post/{id}/{name}', function($id,$name)  
{  
  return "id number is : ". $id ." ".$name;   
}  
);  


//example with optional route parameters.
Route::get('/user/{name?}', function ($name=null) {  
    return $name;  
});  

Route::get('/user/{name?}', function ($name = 'himani') {  
    return $name;  
}); 


//Regular Expression Constraints Examples
//1. route parameter that contains only alphabetical characters.
Route::get('/user/{name?}', function ($name=null) {  
    return $name;  
})->where('name','[a-zA-Z]+');  

/*
//2. accepts only numeric values.
Route::get('/user/{id?}', function ($id=null) {  
    return "id is : ". $id;  
}->where('id','[0-9]+');  

//3. accepts alphanumeric characters.
Route::get('/user/{id}/{name}', function ($id,$name) {  
    return "id is : ". $id ." ,".  "Name is : ".$name ;  
})->where(['id'=>'[0-9]+', 'name'=>'[a-zA-Z]+']);  
*/

//Global Constraints -  Add the routes
Route::get('user/{id}', function ($id) {  
 return $id;  
});  
Route::get('post/{id}', function ($id) {  
 return $id;  
});  


/*
//Named Routes
//define the named routes by chaining the name method onto the route definition:
Route::get('student/details', function()  
{  
    //  
}) -> name('student_details');  
//specify the named routes for controller actions:
Route::get('student/details', 'studentcontroller@showdetails') -> name('student_details');
//Generating URLs to named routes
//Generating URLs  
$url= route('student_details');  
//Generating Redirects...  
return redirect() -> route('student_details');  
*/
//Suppose we have many parameters in the URL; in this case we can provide the short name to the URL. We use an array which wraps everything, and it appears as a second parameter in a get() function.
Route::get('student/details/example',array   
('as'=>'student.details',function()  
{  
   $url=route('student.details');  
   return "The url is : " .$url;  
}));  

//Parameters in Named routes
Route::get('/user/{id}/profile',function($id)  
{  
   $url=route('profile',['id'=>100]);  
    return $url;  
})->name('profile');  


//Navigating from one route to another using named routes
//Step 1: Define the route
Route::Get('/',function()  
{  
  return view('student');  
});  
  
Route::get('student/details',function()  
{  
  $url=route('student.details');  
 return $url;  
})->name('student.details');  



//Add the CheckAge middleware code
Route::Get('/',function()  
{  
  return view('welcome');  
})-> middleware('age');  
Route::Get('user/profile',function()  
{  
  return "user profile";  
});  

/*
Route::Get('/{age}',function($age)  
{  
  return view('welcome');  
})-> middleware('age');  
*/


//Route Groups
Route::group([], function()  
{  
   Route::get('/first',function()  
 {  
   echo "first route";  
 });  
Route::get('/second',function()  
 {  
   echo "second route";  
 });  
Route::get('/third',function()  
 {  
   echo "third route";  
 });  
});  



//Path Prefixes
Route::group(['prefix' => 'tutorial'], function()  
{  
   Route::get('/aws',function()  
 {  
   echo "aws tutorial";  
 });  
Route::get('/jira',function()  
 {  
   echo "jira tutorial";  
 });  
Route::get('/testng',function()  
 {  
   echo "testng tutorial";  
 });  
});  


//assign middleware to all the routes within a group.
Route::middleware(['age'])->group( function()  
{  
  
   Route::get('/aws',function()  
 {  
   echo "aws tutorial";  
 });  
Route::get('/jira',function()  
 {  
   echo "jira tutorial";  
 });  
Route::get('/testng',function()  
 {  
   echo "testng tutorial";  
 });  
  
});  


//Route Name Prefixes
Route::name('admin.')->group(function()  
{  
   Route::get('users', function()  
{  
 return "admin.users";  
})->name('users');  
});  


//Routing Controllers
Route::get('/post', 'PostsController@index');  

//Passing data to the Controller
Route::get('/post/{id}','PostsController@index');

//Controllers and Namespaces
/*
specify the class name that comes after the App/Http/Controllers portion of the namespace.

If the full controller class is App/Http/Controllers/Post/PostController, then we can register the routes of the Controller as given below:

Route::get('\post','Post\PostController@index');
*/

//Single Action Controllers
//route::get('/post/{id}','PostsController');  


//register the resourceful route to the Controller
Route::resource('posts','PostsController');


//Registering routes for multiple controllers
route::resources(  
['teacher'=>'TeacherController',  
'student'=>'StudentController']  
);  


//Partial Resource Routes
Route::resource('partial','PartialController',['only' => ['create','show']]);  

//Naming Resource Routes
Route::resource('student', 'StudentController',['names' => ['create' =>'student.build']]);  

//Naming Resource Route Parameters
Route::resource('student', 'StudentController', ['parameters' => ['student' => 'admin_student']]);

//Naming Resource Route Parameters
Route::resource('student', 'StudentController', ['parameters' => ['student' => 'staff_student']]); 

//assign the middleware to the Controller.
Route::get('posts', 'PostsController@create')->middleware('check');  

//Assigning the middleware to the controller Using the Controller constructor
Route::get('posts', 'PostsController@create');  
Route::get('posts/{id}', 'PostsController@show');  

//contact view
Route::get('/contact', function(){  
  return view('Contact',['name'=>'John']);  
}); 

//about view
Route::get('/post','PostsController@display'); 

//Nesting the Views
Route::get('/details', 'PostsController@display_admin');
Route::get('/template_else/{id}', 'PostsController@template_else');  
Route::get('/template_unless/{id}', 'PostsController@template_unless');  
Route::get('/template_hasSection', 'PostsController@template_hasSection');
Route::get('/template_forLoop', 'PostsController@template_forLoop'); 
Route::get('/template_foreachLoop', 'PostsController@template_foreachLoop');
Route::get('/template_whileLoop/{i}', 'PostsController@template_whileLoop');  


//Determining the existence of view
Route::get('/details_exist', 'PostsController@display_admin_exists');  

//Passing data to views
//using the name array
Route::get('/alldetails', 'StudentController@display_view');

//By using with() function
Route::get('/alldetails/{id}', 'StudentController@display_with'); 

//compact() function
Route::get('/alldetails/{name}', 'StudentController@display_compact'); 
Route::get('/alldetails/{id}/{name}/{password}', 'StudentController@display_compact_multiple'); 

//Extending Master Layout --- without controller ---
Route::get('/ext_contact', function () {  
    return view('myblade.extention_contact');  
}); 
Route::get('/ext_useParent', function () {  
    return view('myblade.extension_useParent');  
});


//Extending Master Layout --- with controller ---
Route::get('/ext_useController/{id}/{password}/{name}','PostsController@ext_useController');  

Route::get('/store_form',function()  
{  
  return view('myblade.form');  
});  


//DATABASE (raw sql)
//Inserting the data
Route::get('/insert_data', function () {  
  DB::insert('insert into posts(title,body) values(?,?)',['software developer','himanshu is a software developer']);  
});  

//Reading the data
Route::get('/select_data',function(){  
  $results=DB::select('select * from posts where id=?',[1]);  
  foreach($results as $posts)  
  {  
    echo "title is :".$posts->title;  
    echo "<br>";  
    echo "body is:".$posts->body;  
  }  
});  

//Updating the data
Route::get('/update_data', function(){  
    $updated=DB::update('update posts set title="software tester" where id=?',[1]);  
    return $updated;  
});  


//Deleting the data
Route::get('/delete_data',function(){  
    $deleted=DB::delete('delete from posts where id=?',[2]);  
    return $deleted;  
});  


//DATABASE (Eloquent Model)
//(Eloquent routing without controller)

//Reading Data -> Eloquent
Route::get('/basic_read',function(){  
  $posts=Post::all();  
  foreach($posts as $post)  
  {  
    echo $post->body;  
    echo '<br>';  
  }  
});  

//Reading one record
Route::get('/basic_find',function(){  
  $posts=Post::find(3);  
  return $posts->title;  
});  

//Reading data with constraints (raw data)
Route::get('/basic_where_first',function(){  
  $posts=Post::where('id',3)->first();  
  return $posts;  
});

//Reading data (single value) with constraints
Route::get('/basic_where_value',function(){  
  $posts=Post::where('id',3)->value('title');  
  return $posts;  
});


//Inserting data -> Eloquent
Route::get('/basic_insert',function(){  
  $post=new Post;  
  $post->title='Nishka';  
  $post->body='QA Analyst';  
  $post->save();  
});  

//Updating Data with the save() method -> Basic
Route::get('/basic_update',function(){  
  $post=Post::find(2);  
  $post->title='Haseena';  
  $post->body='Graphic Designer';  
  $post->save();  
});  


//Mass Assignment
//Eloquent Create
Route::get('/eloq_create',function(){  
  Post::create(['title'=>'Tolashiks','body'=>'Tawando Master']);  
});  

//Eloquent Update
Route::get('/eloq_update',function(){  
Post::where('id',1)->update(['title'=>'Charu','body'=>'technical Content Writer']);  
});

//Deleting data

//**## use the find() and delete() method ##**//
Route::get('/find_delete',function(){  
  $post=Post::find(7);  
  $post->delete();  
});  

//**--## use the destroy() method. ##--** //
Route::get('/single_destroy',function(){  
  Post::destroy(6);  
});   

Route::get('/multiple_destroy',function(){  
Post::destroy([8,9]);  
});  

//**--## use the query. ##--**//
Route::get('/query_delete',function(){  
  Post::where('id',9)->delete();  
}); 


//Soft Deleting/Trashing
Route::get('/soft_delete',function(){  
  Post::find(9)->delete();  
});  

//Retrieving deleted/trashed data
Route::get('/read_soft_delete',function(){  
  $post=Post::withTrashed()->where('id',9)->get();  
  return $post;  
}); 

//Restoring deleted/trashed data
Route::get('/restore_soft_delete',function(){  
  Post::withTrashed()->where('id',9)->restore(); 
}); 

//Deleting one record permanently
Route::get('/force_delete',function(){  
  Post::withTrashed()->where('id',9)->forceDelete();  
});  

//Deleting records permanently/Empty trash
Route::get('/empty_trash',function(){  
  Post::onlyTrashed()->forceDelete();  
});  


//Laravel Eloquent relationship

//One to one relationship
//use App\Models\User;  
Route::get(
  '/user_hasone_post',function()  
  {  
    return User::find(1)->post;  
  }
);  

//Inverse Relation
//use App\Models\Post;  
Route::get(
  '/post_inverse/user',function()  
  {  
    return Post::find(1)->user->name;  
  }
);  


//One-to-many relationship
Route::get('/user_hasMany_posts',function(){  
    $users=User::find(1);  
    foreach($users->posts as $post){  
      echo $post->title."<br>";  
    }  
});  


//Many-to-many relationship
Route::get('/roles/{id}',function($id){  
$users=User::find($id);  
  foreach($users->roles as $role)  
  {  
     return $role->name;  
  }  
}); 

//Accessing the intermediate/pivot table 
Route::get('/roles_user/pivot',function(){  
  $users=User::find(1);  
  foreach($users->roles as $role)  
  {  
    return $role->pivot;  
  }  
});  

//retrieve the specific column from the pivot table,
Route::get('/value_pivot',function(){  
  $users=User::find(1);  
  foreach($users->roles as $role)  
  {  
    return $role->pivot->created_at;  
  }  
});


//Has Many Through
//pulls out the posts of a specific country.
Route::get('/country_hasManyPostsThrough_user',function()  
{  
  
   $countries=Country::find(1);  
   foreach($countries->posts as $post)  
   {  
     return $post->title;  
   }  
});  


//Polymorphic relationship
// Route for the users.  
Route::get('/user_polymorphic_photo',function(){  
  $user=User::find(1);  
  foreach($user->photos as $photo)  
  {  
    return $photo;  
  }  
});  
  
// Route defined for the posts.  
Route::get('/post_polymorphic_photo',function(){  
  $post=Post::find(1);  
  foreach($post->photos as $photo)  
  {  
    return $photo;  
  }  
  
});  


//Inverse of one-to-many (polymorphic) relationship
//Till now, we found the image of the users and posts, now we find out the owner of the image.
Route::get('/polymorphic_inverse_photo/{id}', function($id)  
{  
   $photo=Photo::findOrFail($id);  
   return $photo->imageable;  
});  


//Many-to-many polymorphic relationship
// Route for getting the tags from the Post model.  
Route::get('/post_polymorphic_tags',function()  
{  
  $post=Post::find(1);   
  foreach($post->tags as $tag)  
  {  
    return $tag->name;  
  }
});  

//Route for getting the tags from the Audio model.  
Route::get('/audio_polymorphic_tags',function()  
{  
  $audio=Audio::find(1);   
  foreach($audio->tags as $tag)  
  {  
    return $tag->name;  
  }
});  


//Inverse of many-to-many (polymorphic) relationship
    //In a many-to-many polymorphic relationship, we found the tags belonging to the post and audio model. But, in an inverse relationship of many-to-many (polymorphic), we will find out all the posts and audios that belong to a particular tag.

// Route for getting all the posts of a tag.  
Route::get('/tag/post/{id}',function($id){  
  $tag=Tag::find($id);  
  foreach($tag->posts as $post)  
  {  
      return $post->title;  
  }  
});  
// Route for getting all the audios of a tag.  
Route::get('/tag/audio/{id}',function($id){  
  $tag=Tag::find($id);  
  foreach($tag->audios as $audio)  
  {  
   return $audio->name;  
  }  
});  