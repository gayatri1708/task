@extends('layouts.app')
<style>
  .required{
    color: red;
  }
</style>
@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-12">
        <div class="pull-left">
        @if($option == 'isAdd')
            <h2>Add New Employee</h2>
        @else
            <h2>Edit Employee</h2>
        @endif
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{ Form::open(array('url' => 'employees/save','method'=>'POST')) }}    
@csrf
    <div class="row">
        <div class="col-md-2 col-sm-2">
            <a class="navbar-brand" href="{{ url('companies') }}">
                Companies
            </a>
            <a class="navbar-brand" href="{{ url('employees') }}">
                Employees
            </a>
        </div>
        <div class="col-md-10 col-sm-10">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                <label>First Name<span class="required">*</span></label>
                    @if($option == 'isAdd')
                    {{  Form::text('first_name', '', array('class' => 'form-control','placeholder' => 'First Name'))  }} 
                    @else
                        {{  Form::hidden('id', $employee->id)  }} 
                        {{  Form::text('first_name', $employee->first_name, array('class' => 'form-control','placeholder' => 'First Name'))  }} 
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                <label>Last Name<span class="required">*</span></label>
                    @if($option == 'isAdd')
                        {{  Form::text('last_name', '', array('class' => 'form-control','placeholder' => 'Last Name'))  }} 
                    @else
                        {{  Form::text('last_name', $employee->last_name, array('class' => 'form-control','placeholder' => 'Last Name'))  }} 
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label>Company</label>
                    @if($option == 'isAdd')
                    {!! Form::select('company',['0' => 'Select Company'] +$companies, null, ['class' => 'form-control']) !!}
                    @else
                    {!! Form::select('company',  $companies, $employee->company_id, ['class' => 'form-control']) !!}
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                    <label>Email</label>
                    @if($option == 'isAdd')
                        {{  Form::text('email', '', array('class' => 'form-control','placeholder' => 'Email'))  }} 
                    @else
                        {{  Form::text('email', $employee->email, array('class' => 'form-control','placeholder' => 'Email'))  }} 
                    @endif
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="form-group">
                <label>Phone</label>
                @if($option == 'isAdd')
                    {{  Form::text('phone', '', array('class' => 'form-control','placeholder' => 'Phone'))  }} 
                @else
                    {{  Form::text('phone',  $employee->phone, array('class' => 'form-control','placeholder' => 'Phone'))  }} 
                @endif
                </div>
            </div>
        </div>
 
        <div class="col-xs-12 col-sm-4 col-md-4">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
{{ Form::close() }}
</div>
@endsection