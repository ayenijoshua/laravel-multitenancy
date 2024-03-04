@extends('layouts.company')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Create User</h3><span class="text-error" style="color: red;">(All fields are required)</span>
        </div>
        <div class="card-body">
            <create-employee-component company-id={{$id}} panel-title="Create Employee" post-action={{route('company.store-employee',['subdomain'=>session()->get('domain')])}}>
        </div>
    </div>
    
@endsection