<?php

namespace App\Http\Controllers;

use App\Exceptions\RoomServiceException;
use App\Http\Requests\Room\UpdateRequest;
use App\Http\Requests\Room\StoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\RoomService;
use App\Models\Room;

class RoomController extends Controller
{
    protected RoomService $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
        $this->authorizeResource(Room::class, 'room');
    }

    public function index(): View
    {
        try {
            $rooms = $this->roomService->getAllRooms();
            return view('rooms.index', compact('rooms'));
        } catch (RoomServiceException $e) {
            return view('errors.custom', ['message' => $e->getMessage()]);
        }
    }

    public function show(Room $room): View
    {
        try {
            $audios = $this->roomService->getRoomAudios($room);
            return view('rooms.show', compact('room', 'audios'));
        } catch (RoomServiceException $e) {
            return view('errors.custom', ['message' => $e->getMessage()]);
        }
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $this->roomService->createRoom($request->validated());
            return redirect(route('rooms.index'));
        } catch (RoomServiceException $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function edit(Room $room): View
    {
        try {
            $audios = $this->roomService->getSortedRoomAudios($room);
            return view('rooms.edit', compact('room', 'audios'));
        } catch (RoomServiceException $e) {
            return view('errors.custom', ['message' => $e->getMessage()]);
        }
    }

    public function update(UpdateRequest $request, Room $room): RedirectResponse
    {
        try {
            $this->roomService->updateRoom($request->validated(), $room);
            return redirect()->route('rooms.edit', ['room' => $room]);
        } catch (RoomServiceException $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, Room $room): RedirectResponse
    {
        try {
            $this->roomService->deleteRoom($room);
            return redirect()->route('rooms.index');
        } catch (RoomServiceException $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
