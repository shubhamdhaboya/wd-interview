<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Company;
use App\Employee;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
	const CONSTRAINTS = array(
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'nullable|email',
        'phone' => 'nullable'
    );

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.list');
    }

    public function listContent(Request $request)
    {
        $offset = $request->get('start', 0);
        $limit = $request->get('length', 10);

        $response['draw'] = $request->draw;
        $response['data'] = [];

        $companies = Employee::select([
            'id', 'first_name', 'last_name', 'company_id', 'email', 'phone',
        ])
        ->offset($offset)
        ->limit($limit)
        ->get()->map(function ($item, $key) {
            $item = array_values($item->toArray());
            $item[] = '
                    <button class="btn btn-sm btn-danger" form="delete-'.$item[0].'">
                        <i class="fa fa-trash"></i>
                    </button>
                <form method="POST" class="d-none" id="delete-'.$item[0].'" action="'.route('employees.destroy', ['employee' => $item[0]]).'">
                '. (string) csrf_field() .'
                '. (string) method_field('DELETE') .'
                </form>
                <a href="'. route('employees.edit', ['employee' => $item[0]]) .'" class="btn btn-sm btn-primary">
                    <i class="fa fa-edit"></i>
                </a>
            ';
            return $item;
        });

        $response['data'] = $companies;
        $count = Employee::count();
        $response['recordsFiltered'] = $count;
        $response['recordsTotal'] = $count;

        return new JsonResponse($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $companies = Company::all();
        return view('employee.form', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(self::CONSTRAINTS);
        $companyId = $request->company_id;
        $data['company_id'] = $companyId;
        Employee::create($data);
        Session::flash('alert-success', "Success!");
        return \Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $companies = Company::all();
            return view('employee.form', ['employee' => $employee, 'companies' => $companies]);
        }

        return \Redirect::back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(self::CONSTRAINTS);
        $companyId = $request->company_id;
        $data['company_id'] = $companyId;
        Employee::where('id', $id)->update($data);
        Session::flash('alert-success', "Success!");
        return \Redirect::back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::destroy($id);
        return \Redirect::back();
    }
}
