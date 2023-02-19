@extends('layouts.master_useParent')  
@section('content')  
<h1>Extension Using At parent Directive</h1>  
@stop   
@section('footer')  
@parent  
<p>this is appended</p>  
@stop  