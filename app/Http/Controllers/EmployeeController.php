<?php

namespace App\Http\Controllers;

use App\Events\SendMailNewEmployee;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Mail\SendNewEmployeeMail;
use Event;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HttpRequest $request)
    {
        $companies = DB::table('companies')->get();
        if (request()->ajax()) {
            return datatables()->of(Employee::select('*'))
                ->addColumn('action', 'employees.actions')
                ->rawColumns(['action'])
                ->filter(function ($instance) use ($request) {
                    if ($request->get('company')) {
                        $instance->where('company_id', $request->get('company'));
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('name', 'LIKE', "%$search%")
                                ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('employees.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->company_id = $request->company_id;
        $employee->password = bcrypt($request->password);
        if (is_null($request->profile_image)) {
            $employee->profile_image = 'Employee.jpg';
        } else {
            $employee->profile_image = $request->profile_image->storeAs('/', $request->name . '.' . $request->profile_image->extension(), 'public');
        }
        $employee->save();

        Mail::to($employee->email)->send(new SendNewEmployeeMail($employee));

        return redirect()->route('employees.index')->with('message', 'Employee added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        if (is_null($request->profile_image)) {
            $employee->profile_image = 'Employee.jpg';
        } else {
            $employee->profile_image = $request->profile_image->storeAs('/', $request->name . '.' . $request->profile_image->extension(), 'public');
        }
        $employee->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->back()->with('message', 'employee deleted');
    }
}
