<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeagueRequest;
use App\Http\Resources\LeagueResource;
use App\Models\League;
use Illuminate\Http\Request;

class LeagueController extends Controller
{
    private $league;

    public function __construct(League $league)
    {
        $this->league = $league;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return LeagueResource::collection(
            $this->league->getAll($request->filter)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeagueRequest $request)
    {
        $leagueExist = $this->league->where('name', $request->name)
            ->where('institution_id', $request->institution_id)->first();

        if($leagueExist == null){
            $league = $this->league->create($request->all());

            $resource = new LeagueResource($league);

            return $resource->response()->setStatusCode(201);
        }

        return response(['error'=>'League Already exist in database']);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $league = $this->league->find($id);

        if($league != null){
            $resource = new LeagueResource($league);

            return $resource->response()->setStatusCode(200);
        }

        return response(['error'=>'League not found'])->setStatusCode(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, Request $request)
    {
        $leagueExist = $this->league->find($id);

        if($leagueExist != null){
            $nameAlreadyExist = $this->league->where('name', $request->name)->first();

            if($nameAlreadyExist == null){
                $leagueExist->update($request->all());

                $resource = new LeagueResource($leagueExist);

                return $resource->response()->setStatusCode(201);
            }

            return response(['error'=>'League name already exist'])->setStatusCode(409);
        }

        return response(['error'=>'League not found'])->setStatusCode(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(League $league)
    {
        //
    }
}
