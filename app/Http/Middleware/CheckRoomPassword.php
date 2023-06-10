<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;

class CheckRoomPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $room = $request->route('room');

        // Get the list of accessible room IDs from the session
        $accessibleRooms = $request->session()->get('accessible_rooms', []);

        // Check if the current room ID is in the list
        if (!in_array($room->id, $accessibleRooms)) {
            return redirect()->route('rooms.enter', ['room' => $room])
                ->withErrors(['password' => 'Incorrect password']);
        }

        return $next($request);
    }
}
