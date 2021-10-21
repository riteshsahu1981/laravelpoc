@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
{{$status}}
<br>
<a href="{{ URL('/autologin') }}" target="_blank">Moodle</a> | <a href="{{ URL('/logout') }}">Logout </a>
<br>
Welcome to my fantastic webiste.
@endsection
