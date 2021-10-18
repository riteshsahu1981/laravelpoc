@extends('layouts.app')
@section('title', 'Login')
@section('content')
@if ($status == "logout")
    <script type="text/javascript">
        //window.open("http://moodle.localhost.com/login/logout.php");


        // window.onload = function(){
        //     window.open("http://moodle.localhost.com/login/logout.php");
        // };

    </script>
    You have been loggedout successfully.
@else
    {{$status}}
@endif

<form method="POST" action="/authenticate">
    @csrf
   <label for="username">Username</label>
   <input id="username" name="username"  type="text" >
   <label for="username">Password</label>
   <input id="password" name="password"  type="password" >
   <input type="submit" name="cmdSubmit">
</form>

@endsection
