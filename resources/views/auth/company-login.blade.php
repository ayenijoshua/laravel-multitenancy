@extends('layouts.auth')

@section('content')
    <!-- Main Content -->
<company-login-component base-link-name="Register Company" base-link="{{route('register-company')}}" panel-title='Company Login' post-action={{route('company.auth')}}/>
@endsection