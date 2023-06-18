<?php

namespace App\Http\Controllers;

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
        $rooms = $this->roomService->getAllRooms();
        return view('rooms.index', compact('rooms'));
    }

    public function show(Room $room): View
    {
        $audios = $this->roomService->getRoomAudios($room);
        return view('rooms.show', compact('room', 'audios'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $this->roomService->createRoom($request->validated());
        return redirect(route('rooms.index'));
    }

    public function edit(Room $room): View
    {
        $audios = $this->roomService->getSortedRoomAudios($room);
        return view('rooms.edit', compact('room', 'audios'));
    }

    public function update(UpdateRequest $request, Room $room): RedirectResponse
    {
        $this->roomService->updateRoom($request->validated(), $room);
        return redirect()->route('rooms.edit', ['room' => $room]);
    }

    public function destroy(Request $request, Room $room): RedirectResponse
    {
        $this->roomService->deleteRoom($room);
        return redirect()->route('rooms.index');
    }
}
