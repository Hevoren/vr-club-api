<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delete\DeleteRequest;
use App\Http\Requests\Store\GameStoreRequest;
use App\Http\Requests\Update\GameUpdateRequest;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $game = Game::all();
        if ($game) {
            return GameResource::collection(Game::all());
        } else {
            return response()->json(['message'=> 'Games not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GameStoreRequest $request)
    {
        $game = Game::create($request->validated());
        return (new GameResource($game))
            ->additional(['message' => 'Game success added'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $game = Game::find($id);
        if ($game) {
            return new GameResource($game);
        } else {
            return response()->json(['message' => 'Game not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GameUpdateRequest $request, string $id)
    {
        $game = Game::find($id);
        if ($game) {
            $game->update($request->all());
            return (new GameResource($game))
                ->additional(['message' => 'Game successfully updated'])
                ->response()
                ->setStatusCode(200);
        } else {
            return response()->json(['message' => 'Game not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRequest $request, string $id)
    {
        $game = Game::findOrFail($id);

        if($request->user()->tokenCan('delete')) {
            $game->delete();
            return response()->json(['message' => 'Game deleted']);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
