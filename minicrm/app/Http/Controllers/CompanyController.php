<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::latest()->paginate(10);

        return view('companies.listCompanies')->with('company',$companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.addCompanies')->with('option','isAdd');
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
            'name' => 'required',
            'email' => 'email',
            'logo' => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=100,min_height=100',
        ]);

        $imageName = null;
        if(!empty($request->id)){
           $company = Company::find($request->id);
           \Storage::delete(['public/'. $company->logo]);
           $imagePath = $request->file('logo');
           if($imageName){
                $imageName = $imagePath->getClientOriginalName();
                $path = $request->file('logo')->storeAs('uploads', $imageName, 'public');
           }
        }
        else{
            $company = new Company;
        }
        if ($request->file('logo')) {
            $imagePath = $request->file('logo');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('logo')->storeAs('uploads', $imageName, 'public');
        }
        $company->name      = $request->name;
        $company->email     = $request->email;
        $company->website   = $request->website;
        $company->logo      = $imageName;
        $company->save();

        return redirect()->route('companylist')->with('success','Company added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::where('id',$id)->first();
        return view('companies.addCompanies')->with('company',$company)
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
        $company = Company::where('id',$id)->delete();

         return redirect('companies')
                ->with('success','Company deleted successfully');
    }
}
