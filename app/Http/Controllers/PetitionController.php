<?php

namespace App\Http\Controllers;

use App\Http\Resources\PetitionCollection;
use App\Http\Resources\PetitionResource;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function index()
    {
        //
//        return PetitionResource::collection(Petition::all());
//        return new PetitionCollection(Petition::all());
        return response(new PetitionCollection(Petition::all()), ResponseAlias::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return PetitionResource
     */
    public function store(Request $request)
    {
        //
        $petition = Petition::create($request->only([
            'title', 'description', 'author', 'category', 'signees'
        ]));
        return new PetitionResource($petition);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petition  $petition
     * @return PetitionResource
     */
    public function show(Petition $petition)
    {
        //
        return new PetitionResource($petition);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Petition  $petition
     * @return PetitionResource
     */
    public function update(Request $request, Petition $petition)
    {
        //
        $petition->update($request->only([
            'title', 'description', 'category', 'author', 'signees'
        ]));
        return new PetitionResource($petition);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petition  $petition
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Petition $petition)
    {
        //
        $petition->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
