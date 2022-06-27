@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Employees</h2>
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
                <h3>Employees List </h3><hr>
                 <a class="btn btn-success" href="{{ url('employees/add') }}"> Create New Employee</a>
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
                @if(count($employees)==0)
                <tr>
                    <td style='text-align:center; vertical-align:middle' colspan="6">
                        No data found
                    </td>
                </tr>
                @else
                @foreach ($employees as $emp)
                <tr>
                    <td>{{ $emp->first_name }}</td>
                    <td>{{ $emp->last_name }}</td>
                    <td>{{ $emp->name }}</td>
                    <td>{{ $emp->email }}</td>
                    <td>{{ $emp->phone }}</td>
                    <td>
                        <form action="{{ url('employees/delete',$emp->id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ url('employees/edit',$emp->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </table>
        {!! $employees->links() !!}
</div>
@endsection