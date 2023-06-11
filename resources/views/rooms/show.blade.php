<x-app-layout>
    <x-sprite-sheet />
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

                                    <button data-action="stop" data-slot="{{ $i }}" data-type="{{ $audio->ambience ? 'ambience' : ($audio->music ? 'music' : 'normal') }}" class="audio-control-button {{ $audio->pausable ? 'pausable' : '' }} h-12 w-12 bg-gray-900 items-center justify-center flex rounded">
                                        @if($audio->ambience)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                            <use href="#playSvgAmbience"></use>
                                        </svg>
                                        @elseif($audio->music)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-music-note-beamed" viewBox="0 0 16 16">
                                            <use href="#playSvgMusic"></use>
                                        </svg>
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
                                            <use href="#playSvgNormal"></use>
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
                                </div>
                            </li>
                            @elseif(!isset($audio))
                            <li class="col-span-1 rounded-lg dark:bg-gray-700 bg-white shadow opacity-25">

                                <div class="flex w-full items-center justify-between space-x-6 p-3">

                                    <div data-slot="{{ $i }}" class="play-button h-12 w-12 bg-gray-900 items-center justify-center flex rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
                                            <use href="#playSvgNormal"></use>
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
        function makeSvg(id) {
            return `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
                        <use href="#${id}"></use>
                    </svg>`;
        }

        const playSvgNormal = makeSvg('playSvgNormal');
        const playSvgAmbience = makeSvg('playSvgAmbience');
        const playSvgMusic = makeSvg('playSvgMusic');
        const pauseSvg = makeSvg('pauseSvg');
        const stopSvg = makeSvg('stopSvg');

        function setButtonState(button, action, audioType) {
            if (action === 'pause') {
                if (audioType === 'ambience') {
                    button.innerHTML = playSvgAmbience;
                } else if (audioType === 'music') {
                    button.innerHTML = playSvgMusic;
                } else {
                    button.innerHTML = playSvgNormal;
                }
            } else if (action === 'play') {
                button.innerHTML = button.classList.contains('pausable') ? pauseSvg : stopSvg;
            }
        }

        function processPlay(e) {
            let audioElement = document.getElementById('audio-' + e.slot);
            let button = audioElement.previousElementSibling;

            audioElement.play();
            audioElement.parentElement.parentElement.classList.toggle("play")

            setButtonState(button, 'play', button.dataset.type);
        }

        function processPause(e) {
            let audioElement = document.getElementById('audio-' + e.slot);
            let button = audioElement.previousElementSibling;

            audioElement.pause();
            audioElement.parentElement.parentElement.classList.toggle("play")

            setButtonState(button, 'pause', button.dataset.type);
        }

        function processStop(e) {
            let audioElement = document.getElementById('audio-' + e.slot);
            let button = audioElement.previousElementSibling;

            audioElement.pause();
            audioElement.currentTime = 0;
            audioElement.parentElement.parentElement.classList.toggle("play")

            setButtonState(button, 'pause', button.dataset.type);
        }

        function processVolume(e) {
            let audioElement = document.getElementById('audio-' + e.slot);
            audioElement.volume = e.volume;
        }

        document.querySelectorAll('.audio-control-button').forEach((button) => {
            button.addEventListener('click', function() {
                const buttonElement = this;
                const slot = buttonElement.dataset.slot;
                const action = buttonElement.dataset.action;

                // Determine the action based on the current state
                const nextAction = (action === 'play' && buttonElement.classList.contains('pausable')) ?
                    'pause' :
                    (action === 'play' && !buttonElement.classList.contains('pausable')) ?
                    'stop' :
                    'play';

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
                    if (e.action === 'play') {
                        processPlay(e);
                    } else if (e.action === "pause") {
                        processPause(e);
                    } else if (e.action === 'stop') {
                        processStop(e);
                    } else if (e.action === 'volume') {
                        processVolume(e);
                    }
                });

            console.log("WebSocket connection ready")
        }
    </script>
</x-app-layout>