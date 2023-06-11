<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($room->name) }} @livewire('user-counter')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Audio List -->
                    <ul role="list" class="px-4 sm:px-6 lg:px-8 mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                        @for($i = 1; $i <= 27; $i++) @php $audio=$room->audios->where('slot', $i)->first();
                            @endphp
                            @if(isset($audio))<li class="col-span-1 rounded-lg dark:bg-gray-700 bg-white shadow">

                                <div class="flex w-full items-center justify-between space-x-6 p-3">

                                    <button data-action="stop" data-slot="{{ $i }}" class="audio-control-button {{ $audio->pausable ? 'pausable' : '' }} h-12 w-12 bg-gray-900 items-center justify-center flex rounded">
                                        @if($audio->ambience)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z" />
                                        </svg>
                                        @elseif($audio->music)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-music-note-beamed" viewBox="0 0 16 16">
                                            <path d="M6 13c0 1.105-1.12 2-2.5 2S1 14.105 1 13c0-1.104 1.12-2 2.5-2s2.5.896 2.5 2zm9-2c0 1.105-1.12 2-2.5 2s-2.5-.895-2.5-2 1.12-2 2.5-2 2.5.895 2.5 2z" />
                                            <path fill-rule="evenodd" d="M14 11V2h1v9h-1zM6 3v10H5V3h1z" />
                                            <path d="M5 2.905a1 1 0 0 1 .9-.995l8-.8a1 1 0 0 1 1.1.995V3L5 4V2.905z" />
                                        </svg>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
                                            <path d="M10.804 8 5 4.633v6.734L10.804 8zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692z" />
                                        </svg>
                                        @endif
                                    </button>

                                    <!-- it seems, the audio element here does not irritate the other elements -->
                                    <audio style="display:none;" id="audio-{{ $i }}" playsinline controls preload="auto" onended="getElementById('audio-' + {{ $i }}).parentElement.parentElement.classList.toggle('play')" src="{{ Storage::url($audio->file) }}" {{ $audio->loop ? 'loop' : '' }}>
                                    </audio>


                                    <div class="flex-1 truncate">
                                        <div class="flex items-center space-x-3">
                                            <h3 class="truncate text-sm font-medium text-gray-800 dark:text-gray-200">{{ $audio->name }}</h3>
                                            @if($audio->loop)
                                            <span class="inline-flex flex-shrink-0 items-center rounded-full bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Loop</span>
                                            @endif
                                        </div>
                                        <p class="mt-1 truncate text-sm text-gray-700 dark:text-gray-400"><!-- Platzhalter --></p>
                                    </div>
                                </div>

                                <input class="w-full dark:bg-gray-900 dark:border-gray-900 border-2" type="range" min="1" max="100" value="50" class="slider" id="myRange">

                                <div>
                                    <!-- <div class=" -mt-px flex divide-x divide-gray-200">
                                    <div class="flex w-0 flex-1">
                                        <a href="mailto:janecooper@example.com" class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900 dark:text-gray-200">
                                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                                <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                                            </svg>
                                            Platzhalter
                                        </a>
                                    </div>
                                    <div class="-ml-px flex w-0 flex-1">
                                        <a href="tel:+1-202-555-0170" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900 dark:text-gray-200">
                                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z" clip-rule="evenodd" />
                                            </svg>
                                            Platzhalter
                                        </a>
                                    </div>
                                </div> -->
                                </div>
                            </li>
                            @elseif(!isset($audio))
                            <li class="col-span-1 rounded-lg dark:bg-gray-700 bg-white shadow opacity-25">

                                <div class="flex w-full items-center justify-between space-x-6 p-3">

                                    <div data-slot="{{ $i }}" class="play-button h-12 w-12 bg-gray-900 items-center justify-center flex rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
                                            <path d="M10.804 8 5 4.633v6.734L10.804 8zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692z" />
                                        </svg>
                                    </div>

                                    <div class="flex-1 truncate">
                                        <div class="flex items-center space-x-3">
                                            <h3 class="truncate text-sm font-medium text-gray-800 dark:text-gray-200"></h3>
                                        </div>
                                        <p class="mt-1 truncate text-sm text-gray-700 dark:text-gray-400"><!-- Platzhalter --></p>
                                    </div>
                                </div>

                                <input class="w-full dark:bg-gray-900 dark:border-gray-900 border-2" disabled type="range" min="1" max="100" value="50" class="slider" id="myRange">

                                <div>

                                </div>
                            </li>
                            @endif
                            @endfor
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        playSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
                        <path d="M10.804 8 5 4.633v6.734L10.804 8zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692z"/>
                    </svg>`;
        pauseSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pause" viewBox="0 0 16 16">
                        <path d="M6 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5zm4 0a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5z"/>
                    </svg>`;
        stopSvg = `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-stop" viewBox="0 0 16 16">
                        <path d="M3.5 5A1.5 1.5 0 0 1 5 3.5h6A1.5 1.5 0 0 1 12.5 5v6a1.5 1.5 0 0 1-1.5 1.5H5A1.5 1.5 0 0 1 3.5 11V5zM5 4.5a.5.5 0 0 0-.5.5v6a.5.5 0 0 0 .5.5h6a.5.5 0 0 0 .5-.5V5a.5.5 0 0 0-.5-.5H5z"/>
                    </svg>`;

        document.querySelectorAll('.audio-control-button').forEach((button) => {
            button.addEventListener('click', function() {
                var buttonElement = this;
                var slot = buttonElement.dataset.slot;
                var action = buttonElement.dataset.action;

                // Determine the action based on the current state
                var nextAction;
                if (action === "play" && buttonElement.classList.contains("pausable")) {
                    nextAction = "pause";
                } else if (action === "play" && !buttonElement.classList.contains("pausable")) {
                    nextAction = "stop";
                } else {
                    nextAction = "play"
                }

                if (nextAction) {
                    // Send AJAX request to the backend
                    axios.post("/audio/action", {
                        action: nextAction,
                        slot: slot,
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }).catch(function(error) {
                        console.log(error);
                    });

                    // Update the state of the button
                    buttonElement.dataset.action = nextAction;
                }
            })

        });

        window.onload = function() {
            console.log("Loading WebSocket connection")

            Echo.join('audio')
                .here((users) => {
                    Livewire.emit('refreshUserCount');
                })
                .joining((user) => {
                    console.log(user.name + ' joined');
                    Livewire.emit('refreshUserCount');
                })
                .leaving((user) => {
                    console.log(user.name + ' left');
                    Livewire.emit('refreshUserCount');
                })
                .listen('.AudioEvent', (e) => {
                    let audioElement = document.getElementById('audio-' + e.slot);
                    let button = audioElement.previousElementSibling

                    if (e.action === 'play') {
                        audioElement.play();
                        audioElement.parentElement.parentElement.classList.toggle("play")
                        if (audioElement.classList.contains('pausable')) {
                            button.innerHTML = pauseSvg;
                        } else {
                            button.innerHTML = stopSvg;
                        }
                    } else if (e.action === "pause") {
                        audioElement.pause();
                        audioElement.parentElement.parentElement.classList.toggle("play")
                        button.innerHTML = playSvg;
                    } else if (e.action === 'stop') {
                        audioElement.pause();
                        audioElement.currentTime = 0;
                        audioElement.parentElement.parentElement.classList.toggle("play")
                        button.innerHTML = playSvg;

                    } else if (e.action === 'volume') {
                        audioElement.volume = e.volume;
                    }
                });

            console.log("WebSocket connection ready")
        }
    </script>
</x-app-layout>