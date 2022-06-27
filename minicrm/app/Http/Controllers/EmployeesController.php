<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employees;
use App\Company;
use Illuminate\Support\Collection;



class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employees::Join('companies','employees.company_id','=','companies.id')
                            ->select('employees.*','companies.name')
                            ->latest()
                            ->paginate(10);
 

        return view('employees.listEmployees')->with('employees',$employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::pluck('name','id')->toArray();
        \Log::info("Companiesssssssssssssss",[$companies]);
        return view('employees.addEmployees')
            ->with('companies',$companies)
            ->with('option','isAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email',
        ]);

        $imageName = null;
        if(!empty($request->id)){
           $employees = Employees::find($request->id);
        }
        else{
            $employees = new Employees;
        }
        $employees->first_name = $request->first_name;
        $employees->last_name  = $request->last_name;
        $employees->company_id = $request->company;
        $employees->email      = $request->email;
        $employees->phone      = $request->phone;
        $employees->save();

        return redirect()->route('employeelist')->with('success','Employee added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employees::where('id',$id)->first();
        $companies = Company::pluck('name','id')->toArray();

        return view('employees.addEmployees')->with('employee',$employees)
                                            ->with('companies',$companies)
                                            ->with('option','isEdit');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = Employees::where('id',$id)->delete();

         return redirect('employees')
                ->with('success','Employees deleted successfully');
    }
}
