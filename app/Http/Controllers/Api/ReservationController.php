<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Delete\DeleteRequest;
use App\Http\Requests\Store\ReservationStoreRequest;
use App\Http\Requests\Update\ReservationUpdateRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Game;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use App\Rules\ValidationLogin;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->role_id === 1) {
            $reservation = Reservation::all();
        } else if ($user->role_id === 2) {
            $reservation = Reservation::where('user_id', $user->user_id)->get();
        }
        if ($reservation) {
            return ReservationResource::collection($reservation);
        } else {
            return response()->json(['message' => 'Reservations not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationStoreRequest $request)
    {
        if ($request->validated()) {

            $user = $request->user();
            $game = Game::where('game_id', $request->game_id)->first();
            $room = Room::where('room_id', $request->room_id)->first();

            $game_price = $game->price;
            $room_price = $room->price;

            $all_price = $game_price + $room_price;

            $reservation = Reservation::create([
                'reservation_time' => $request->reservation_time,
                'peoples' => $request->peoples,
                'game_id' => $request->game_id,
                'room_id' => $request->room_id,
                'user_id' => $user->user_id,
                'all_price' => $all_price
            ]);

            $balls = $user->balls;
            $balls += $all_price * 0.01;
            $user->balls = $balls;
            $user->save();

            $reservation = Reservation::latest()->first();
            $duration = $game->duration;
            $time = Carbon::parse($reservation->reservation_time);
            $reservation_time_end = $time->addMinutes($duration);
            $reservation_time_end = $reservation_time_end->format('Y-m-d H-i-s');
            $reservation->reservation_time_end = $reservation_time_end;
            $reservation->save();

            return (new ReservationResource($reservation))
                ->additional(['message' => 'Reservation success added'])
                ->response()
                ->setStatusCode(201);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $user = $request->user();
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        if ($user->role_id === 1) {
            return new ReservationResource($reservation);
        } else if ($user->role_id === 2 && $reservation->user_id === $user->user_id) {
            return new ReservationResource($reservation);
        } else {
            return response()->json(['message' => 'Forbidden'], 403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationUpdateRequest $request, string $id)
    {
        if($request->validated()){
            $user = $request->user();

            $reservation = Reservation::find($id);
            if (!$reservation) {
                return response()->json(['message' => 'Reservation not found'], 404);
            }

            if ($user->role_id === 1 || $reservation->user_id === $user->user_id) {
                $game = Game::where('game_id', $reservation->game_id)->first();
                $reservation->update($request->all());
                $duration = $game->duration;
                $time = Carbon::parse($reservation->reservation_time);
                $reservation_time_end = $time->addMinutes($duration);
                $reservation_time_end = $reservation_time_end->format('Y-m-d H-i-s');
                $reservation->reservation_time_end = $reservation_time_end;
                $reservation->save();
                return (new ReservationResource($reservation))
                    ->additional(['message' => 'Reservation successfully updated'])
                    ->response()
                    ->setStatusCode(200);
            } else {
                return response()->json(['message' => 'Forbidden'], 403);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteRequest $request, string $id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($request->user()->tokenCan('delete')) {
            $reservation->delete();
            return response()->json(['message' => 'Reservation deleted']);
        } else {
            return response()->json(['message' => 'Forbidden']);
        }
    }
}
