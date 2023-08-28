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

        if($institution != null){
            $resource = new InstitutionResource($institution);

            return $resource->response()->setStatusCode(200);
        }

        return response(['error'=>'Institution not found'])->setStatusCode(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InstitutionRequest $request, int $id)
    {
        $institution = $this->institution->find($id);

        if($institution != null){
            $institution->update($request->all());

            $resource = new InstitutionResource($institution);

            return $resource->response()->setStatusCode(201);
        }

        return response(['error'=>'Institution not found'])->setStatusCode(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $institution = $this->institution->find($id);

        if($institution != null){
            $institution->delete();

            return response()->json([], 204);;
        }

        return response(['error'=>'Institution not found'])->setStatusCode(404);
    }
}
