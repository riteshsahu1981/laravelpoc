@extends('layouts.app')
@section('title', 'Login')
@section('content')
{{$status}}
<form method="POST" action="/authenticate">
    @csrf
   <label for="username">Username</label>
   <input id="username" name="username"  type="text" >
   <label for="username">Password</label>
   <input id="password" name="password"  type="password" >
   <input type="submit" name="cmdSubmit">
</form>

@endsection
