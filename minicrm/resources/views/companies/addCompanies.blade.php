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
            <h2>Add New Company</h2>
        @else
            <h2>Edit Company</h2>
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

{{ Form::open(array('url' => 'company/save','enctype'=>"multipart/form-data",'method'=>'POST')) }}    
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
                        <label>Name<span class="required">*</span></label>
                        @if($option == 'isAdd')
                            {{  Form::text('name', null, array('class' => 'form-control','placeholder' => 'Name'))  }} 
                        @else
                            <input type="hidden" name="id" value="{{ $company->id }}" class="form-control">
                            {{  Form::text('name', $company->name, array('class' => 'form-control','placeholder' => 'Name'))  }} 
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <label>Email</label>
                        @if($option == 'isAdd')
                            {{  Form::text('email', null, array('class' => 'form-control','placeholder' => 'Email'))  }} 
                        @else
                            {{  Form::text('email', $company->email, array('class' => 'form-control','placeholder' => 'Email'))  }} 
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <label>Logo</label>
                        @if($option == 'isAdd')
                            <input type="file" name="logo" class="form-control" placeholder="image">
                        @else
                            <input type="file" name="logo" class="form-control" placeholder="image">
                            <img src="{{asset('storage/uploads/'.$company->logo) }}" width="100px" height ="100px">
                        @endif
                    </div>
                </div>
            
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                        <label>Website</label>
                        @if($option == 'isAdd')
                            {{  Form::text('website', null, array('class' => 'form-control','placeholder' => 'Website'))  }} 
                        @else
                            {{  Form::text('website', $company->email, array('class' => 'form-control','placeholder' => 'Website'))  }} 
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
{{ Form::close() }}
</div>
@endsection