<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function search(Request $request)
    {
        // echo "test";
        try {
            $companies = Company::query();
            if ($request->name) $companies->where('name', 'like', '%' . $request->name . '%');
            $result = CompanyResource::collection($companies->get());
            return $result;
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Faild',
                'message' => $e->getMessage() // Not Recommended
            ], 500);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        // return CompanyResource::collection($companies);
        return new CompanyCollection($companies);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:10',
            'owner' => 'required|string|max:10'
        ]);
        try {
            $company = Company::create($request->only('name', 'owner'));
            return response()->json([
                'status' => 'Done',
                'company' => $company
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Faild',
                'message' => $e->getMessage() // Not Recommended
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::findOrFail($id);
        try {
            return response()->json([
                'status' => 'done',
                'company' => new CompanyResource($company)
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Faild',
                'message' => $e->getMessage() // Not Recommended
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'owner' => 'nullable|string|max:60'
        ]);
        try {
            $company = Company::find($id);
            $company->name = $request->name;
            $company->owner = $request->owner;
            $company->save();
            return response()->json([
                'status' => 'done',
                'company' => $company
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Faild',
                'message' => $e->getMessage() // Not Recommended
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $company = Company::find($id);
            $company->delete();
            return response()->json([
                'status' => 'done',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Faild',
                'message' => $e->getMessage() // Not Recommended
            ], 500);
        }
    }
}
