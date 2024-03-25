<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pagination = $request->get('pagination');

        if ($pagination == 1) {
            return Company::paginate(15);
        }

        return Company::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        return Company::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return $company;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        return $company->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        return $company->delete();
    }
}
