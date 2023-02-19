<?php

use Illuminate\Support\Facades\Route;

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
