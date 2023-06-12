<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstitutionRequest;
use App\Http\Resources\InstitutionResource;
use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    private $institution;

    public function __construct(Institution $institution)
    {
        $this->institution = $institution;
    }

    public function index(Request $request){
        return InstitutionResource::collection(
            $this->institution->getAll($request->filter)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InstitutionRequest $request)
    {
        $institutionExist = $this->institution->where('name', $request->name)->first();

        if($institutionExist != null){
            return response(['error'=>'institution already exist in database'])->setStatusCode(400);
        }

        $newInstitution = $this->institution->create($request->all());

        $resource = new InstitutionResource($newInstitution);

        return $resource->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $institution = $this->institution->find($id);

        $resource = new InstitutionResource($institution);

        return $resource->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Institution $institution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Institution $institution)
    {
        //
    }
}
