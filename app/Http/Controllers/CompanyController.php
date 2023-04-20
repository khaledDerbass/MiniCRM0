<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Company;
use Session;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::select('id', 'name', 'email', 'website')->paginate(10);
        return view('admin.companies.index', compact('companies'));
    }
    public function create()
    {
      return view('admin.companies.create');
    }
    public function store(StoreCompanyRequest $request)
    {
        $validated = $request->validated();

        $input = [
          'name' => $request->input('name'),
          'email' => $request->input('email'),
          'website' => $request->input('website')
        ];

        if ($request->hasFile('logo')) {
            $file = $request->logo;

            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fullname = $name . '.' . date('Y-m-d') . '.' . $extension;
            Storage::putFileAs('public', $file, $fullname, 'public');
            $input['logo'] = $fullname;
        }
        Company::create($input);
        return redirect()->route('companies.index');
    }
    public function show($id)
    {
      $company = Company::find($id);
      return view('admin.companies.show', compact('company'));
    }
    public function edit($id)
    {
        $company = Company::find($id);
        return view('admin.companies.edit', compact('company'));
    }
    public function update(UpdateCompanyRequest $request, $id)
    {
      $validated = $request->validated();

      $input = [
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'website' => $request->input('website')
      ];

      if ($request->hasFile('logo')) {
          $file = $request->logo;

          $name = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
          $fullname = $name . '.' . date('Y-m-d') . '.' . $extension;
          Storage::putFileAs('public', $file, $fullname, 'public');
          $input['logo'] = $fullname;
      }

      $oldCompanyRecord = Company::find($id);
      $oldCompanyRecord->update($input);
      return redirect()->route('companies.index');
    }
    public function destroy($id)
    {
      $oldCompanyRecord = Company::find($id);
      Storage::delete('public/' . $oldCompanyRecord->logo);

      $oldCompanyRecord->delete();
      return redirect()->route('companies.index');
    }
}
