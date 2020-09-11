<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Company;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    const CONSTRAINTS = array(
        'name' => 'required',
        'logo' => 'dimensions:min_width=100,min_height=100|mimes:jpeg,png,jpg,gif',
        'email' => 'nullable|email',
        'website' => 'nullable|url'
    );
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.list');
    }

    public function listContent(Request $request)
    {
        $offset = $request->get('start', 0);
        $limit = $request->get('length', 10);

        $response['draw'] = $request->draw;
        $response['data'] = [];

        $companies = Company::select([
            'id', 'name', 'logo', 'email', 'website'
        ])
        ->offset($offset)
        ->limit($limit)
        ->get()->map(function ($item, $key) {
            $item = array_values($item->toArray());
            $item[] = '
                    <button class="btn btn-sm btn-danger" form="delete-'.$item[0].'">
                        <i class="fa fa-trash"></i>
                    </button>
                <form method="POST" class="d-none" id="delete-'.$item[0].'" action="'.route('companies.destroy', ['company' => $item[0]]).'">
                '. (string) csrf_field() .'
                '. (string) method_field('DELETE') .'
                </form>
                <a href="'. route('companies.edit', ['company' => $item[0]]) .'" class="btn btn-sm btn-primary">
                    <i class="fa fa-edit"></i>
                </a>
            ';
            return $item;
        });

        $response['data'] = $companies;

        $response['recordsFiltered'] = Company::count();
        $response['recordsTotal'] = Company::count();

        return new JsonResponse($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('company.form');
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

        if ($request->hasFile('logo')) {
            $fileName = $request->logo->hashName();
            $request->logo->storeAs('/public/logo', $fileName);
            $fullPath = '/storage/logo/' . $fileName;
            $data['logo'] = $fullPath;
        }

        Company::create($data);
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
        $company = Company::find($id);
        if ($company) {
            return view('company.form', ['company' => $company]);
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

        if ($request->hasFile('logo')) {
            $fileName = $request->logo->hashName();
            $request->logo->storeAs('/public/logo', $fileName);
            $fullPath = '/storage/logo/' . $fileName;
            $data['logo'] = $fullPath;
        }

        Company::where('id', $id)->update($data);
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
        Company::destroy($id);
        return \Redirect::back();
    }
}
