<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Determining the existence of view
use Illuminate\Support\Facades\View; 

class PostsController extends Controller
{
    /*

        You can break it down to two statements as below

        public function __construct()
        {
            $this->middleware('auth');
            $this->middleware('admin');
        }
        Or if you want to use one statement

        public function __construct()
        {
            $this->middleware(['auth', 'admin']);
        }
        However if you restrict the middleware for certain methods like below

        $this->middleware(['auth', 'admin'], ['except' => [
            'fooAction',
            'barAction',
        ]]);

        In that case, you restrict both auth and admin for fooAction method and barAction method

        Source:

            https://laravel.com/docs/master/controllers#controller-middleware
        */

        public function __construct()  
        {  
            //$this->middleware('check')->only('show'); 
            $this->middleware('check', ['only' => [
                'show',
                'create',
            ]]);
            //$this->middleware(['auth', 'admin']);
        }    

        //Syntax of Middleware Closure
        /*
        $this->middleware(function ($request, $next) {  
            // ...  
            //  echo "Middleware in Laravel";  
            return $next($request);  
        });  
        */
        /*
            //Single Action Controllers
            public function __invoke($id)  
            {  
                return "id is : ". $id;  
            }  
        */

            public function display(){  
                return view('about');  
            }  
             
            //nesting views
            public function display_admin(){  
                return view('admin.details');  
            }  
            public function display_admin_exists()  
            {  
                if (View::exists('admin.details')) {  
                    echo "the view of the admin.details exists";  
      
                }  
                else { 
                    echo "view does not exist";  
                }  
            }
            public function template_else($id){  
                return view('myblade.template_else')->with('id',$id);  
            } 
            public function template_unless($id){  
                return view('myblade.template_unless')->with('id',$id);  
            } 
            public function template_hasSection(){  
                return view('myblade.template_hasSection');  
            } 
            public function template_forLoop(){  
                return view('myblade.template_forLoop');  
            } 
            public function template_foreachLoop()  
            {  
                return view('myblade.template_foreachLoop', ['students'=>['anisha','haseena','akshita','jyotika']]);  
            }  
             public function template_whileLoop($i){  
                return view('myblade.template_whileLoop')->with('i',$i);  
            } 

            //Extending Master Layout --- with controller ---
            public function ext_useController($id,$password,$name)  
            {  
                return view('myblade.extension_useController',compact('id','password','name'));  
            } 
            public function store(Request $request)  
            {  
                $this->validate($request,[  
                'name'=>'required',  
                'list'=> 'required',  
                'dob'=>'required',  
                'body'=>'required',  
                'percent'=>'required',  
                'exp'=>'required',  
                'salary'=>'required',  
                'resume'=>'required']);  
           
                return "Resume has been updated successfully";  
    
            }  

            

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //return "Hello javaTpoint";

        return "ID is :". $id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return "This is the create method";  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return "show method is called and ID is : ". $id;  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
