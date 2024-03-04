@extends('layouts.auth')

@section('content')
    <!-- Main Content -->
<register-company-component base-link-name="Company" base-link="" panel-title='Register Company' post-action={{route('company.store')}}/>
@endsection