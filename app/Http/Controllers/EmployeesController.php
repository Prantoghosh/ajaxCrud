<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees= Employee::orderBy('id','desc')->get();
        return view('employee.home',compact('employees'));
    }

    public function store(Request $request)
    {
        $data=$request->validate([

            'name'           => 'required',
            'email'           => 'required',
            'phone'        => 'required',
            'image'        => ' image'

        ]);
        $employee=new Employee;
        $employee->name=$data['name'];
        $employee->email=$data['email'];
        $employee->phone=$data['phone'];

        if ($request->hasFile('image')) {
            $fileName = rand() . $request->image->getClientOriginalName();
            $request->image->storeAs('employeeImages', $fileName, 'public');
            $employee->image =  "employeeImages/" . $fileName;
        } else {
            $employee->image = "";
        }

        $employee->save();

        if($employee){
            return json_encode($employee);
        }
        else{
            return response()->json("error");
        }
    }


    public function getEmployee()
    {
        $employees= Employee::latest()->get();
        return view('employee.getRealtimeEmployees',compact('employees'));
    }

    public function view(Request $request, $id)
    {
        $employees = Employee::find($id);

        return $employees;
    }
}
