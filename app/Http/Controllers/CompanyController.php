<?php

namespace App\Http\Controllers;

use App\DataTables\CompaniesDataTable;
use App\DataTables\CompaniesDataTableEditor;
use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;



class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CompaniesDataTable $dataTable)
    {

        if (request()->ajax()) {
            return datatables()->of(Company::select('*'))
                ->addColumn('action', 'components.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        // return $request->logo;

        $company =  new Company();
        $company->name = $request->name;
        $company->address = $request->address;
        if (is_null($request->logo)) {
            $company->logo = 'company.png';
        } else {
            $company->logo = $request->logo->storeAs('/', $request->name . '.' . $request->logo->extension(), 'companies');
        }
        $company->save();
        return redirect()->back()->with('message', 'Company added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {

        $company->update($request->validated());
        if (is_null($request->logo)) {
            $company->logo = 'company.png';
        } else {
            $company->logo = $request->logo->storeAs('/', $request->name . '.' . $request->logo->extension(), 'companies');
        }
        $company->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->back();
    }
}
