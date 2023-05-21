<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delete\DeleteRequest;
use App\Http\Requests\Store\ReservationStoreRequest;
use App\Http\Requests\Update\ReservationUpdateRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservation = Reservation::all();
        if ($reservation) {
            return ReservationResource::collection(Reservation::all());
        } else {
            return response()->json(['message' => 'Reservations not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationStoreRequest $request)
    {
        $reservation = Reservation::create($request->validated());
        return (new ReservationResource($reservation))
            ->additional(['message' => 'Reservation success added'])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = Reservation::find($id);
        if ($reservation) {
            return new ReservationResource($reservation);
        } else {
            return response()->json(['message' => 'Reservation not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationUpdateRequest $request, string $id)
    {
        $reservation = Reservation::find($id);
        if ($reservation) {
            $reservation->update($request->all());
            return (new ReservationResource($reservation))
                ->additional(['message' => 'Reservation successfully updated'])
                ->response()
                ->setStatusCode(200);
        } else {
            return response()->json(['message' => 'Reservation not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRequest $request, string $id)
    {
        $reservation = Reservaion::findOrFail($id);

        if ($request->user()->tokenCan('delete')) {
            $reservation->delete();
            return response()->json(['message' => 'Reservation deleted']);
        } else {
            return response()->json(['message' => 'Unauthorized']);
        }
    }
}
