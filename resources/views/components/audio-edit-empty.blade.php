@props(['room', 'i'])

<li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white dark:bg-gray-700 shadow ">
    <div class="flex w-full items-center justify-between space-x-6 p-6 opacity-25">
        <div class="flex-1 truncate">
            <div class="flex items-center space-x-3">
                <h3 class="truncate text-sm font-medium text-gray-900 dark:text-gray-200">
                    Slot nicht belegt
                </h3>
            </div>
            <p class="mt-1 truncate text-sm text-gray-500 dark:text-gray-300">Audio Slot
                {{ $i }}
            </p>
        </div>
    </div>
    <div>
        <div class="-mt-px flex divide-x divide-gray-200">
            <div class="-ml-px flex w-0 flex-1">
                <a href="{{ route('audios.create', ['room' => $room, 'slot' => $i]) }}"
                    class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900 dark:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-upload" viewBox="0 0 16 16">
                        <path
                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                        <path
                            d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                    </svg>
                    Audioslot belegen
                </a>
            </div>
        </div>
    </div>
</li>
