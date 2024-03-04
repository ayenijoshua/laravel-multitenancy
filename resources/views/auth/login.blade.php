@extends('layouts.auth')

@section('content')
    <!-- Main Content -->
    <login-component base-link-name="Company" base-link="" panel-title='User Login' post-action={{route('user.auth')}}/>
@endsection