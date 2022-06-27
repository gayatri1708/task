@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Companies</h2>
<hr>
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
            <div>
                <h3>Companies List </h3><hr>
                 <a class="btn btn-success" href="{{ url('company/add') }}"> Create New Company</a>
            </div> </br>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    <div class="row">
        <div class="col-md-2 col-sm-2">
        </div>
        <div class="col-md-10 col-sm-10">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th>Actions</th>
                </tr>
                @if(count($company)==0)
                <tr>
                    <td style='text-align:center; vertical-align:middle' colspan="6">
                        No data found
                    </td>
                </tr>
                @else
                @foreach ($company as $comp)
                <tr>
                    <td>{{ $comp->name }}</td>
                    <td>{{ $comp->email }}</td>
                    <td>
                    @if(!empty($comp->logo))
                        <img src="{{ asset('storage/uploads/'.$comp->logo)}}" width="100px" height="100px">
                    @endif
                    </td>
                    <td>{{ $comp->website }}</td>
                    <td>
                        <form action="{{ url('company/delete',$comp->id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ url('company/edit',$comp->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </table>
        </div>
    </div>
        {!! $company->links() !!}
</div>
@endsection