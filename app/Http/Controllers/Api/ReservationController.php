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

        if ($user->role_id === 1 || $user->role_id === 3) {
            $reservation = Reservation::all();
        } else if ($user->role_id === 2 ) {
            $reservation = Reservation::where('user_id', $user->user_id)->get();
        } else {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        if (!$reservation) {
            return response()->json(['message' => 'Reservations not found', 404]);
        }
        return ReservationResource::collection($reservation);
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

            $all_price = $game->price + $room->price;

            if ($user->role_id === 1 || $user->role_id === 3){
                if ($request->has('login')) {
                    $user = User::where('login', $request->login)->first();

                    if (!$user) {
                        return response()->json(['message' => 'User not found'], 404);
                    }
                }
            } else {
                return response()->json(['message' => 'Adding by login forbidden'], 403);
            }

            $reservation_time = Carbon::parse($request->reservation_time);
            $reservation_time_end = $reservation_time->copy()->addMinutes($game->duration);

            if (Reservation::checkReservation($reservation_time, $reservation_time_end, $request->room_id)) {
                return response()->json(['message' => 'There is already a reservation with overlapping time'], 409);
            }

            $reservation = Reservation::create([
                'reservation_time' => $reservation_time->format('Y-m-d H:i'),
                'reservation_time_end' => $reservation_time_end->format('Y-m-d H:i'),
                'peoples' => $request->peoples,
                'game_id' => $request->game_id,
                'room_id' => $request->room_id,
                'user_id' => $user->user_id,
                'all_price' => $all_price
            ]);

            $user->settingBalls($user->balls, $all_price);

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

        if ($user->role_id === 1 || 3) {
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

            if (($user->role_id === 1 || $user->role_id === 3) || $reservation->user_id === $user->user_id) {
                $game = Game::where('game_id', $reservation->game_id)->first();

                $reservation_time = Carbon::parse($request->reservation_time);
                $reservation_time_end = $reservation_time->copy()->addMinutes($game->duration);

                if (Reservation::checkReservation($reservation_time, $reservation_time_end, $request->room_id)) {
                    return response()->json(['message' => 'There is already a reservation with overlapping time'], 409);
                }

                $reservation->update([
                    'reservation_time' => $reservation_time,
                    'reservation_time_end' => $reservation_time_end
                ]);

                return (new ReservationResource($reservation))
                    ->additional(['message' => 'Reservation successfully updated'])
                    ->response()
                    ->setStatusCode(200);
            } else {
                return response()->json(['error' => 'Forbidden'], 403);
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
            return response()->json(['message' => 'Reservation deleted'], 201);
        } else {
            return response()->json(['error' => 'Forbidden'], 403);
        }
    }

    public function allReservations()
    {
        return response()->json(['reservations' => Reservation::all()]);
    }
}
