<x-app-layout>
    <x-sprite-sheet />
    <x-slot name="header">
        <div class="ml-4 mt-4">
            <div class="flex items-center">
                <div class="ml-4">
                    <p class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __($room->name) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="ml-4 mt-4 flex flex-shrink-0">
            <button onclick="toggleGmMenu()" type="button"
                class="relative ml-3 inline-flex items-center rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400" viewBox="0 0 16 16">
                    <path
                        d="M1 2a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2zM1 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V7zM1 12a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2z" />
                </svg>
                <span>SL-Ansicht</span>
            </button>

            <div id="soundpad-menu" class="hidden">
                <input class="hidden" id="one" name="group" type="radio" checked>
                <input class="hidden" id="two" name="group" type="radio">
                <input class="hidden" id="three" name="group" type="radio">
                <div>
                    <label
                        class="relative ml-3 inline-flex items-center rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800"
                        id="one-tab" for="one">1</label>
                    <label
                        class="relative ml-3 inline-flex items-center rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800"
                        id="two-tab" for="two">2</label>
                    <label
                        class="relative ml-3 inline-flex items-center rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800"
                        id="three-tab" for="three">3</label>
                </div>
            </div>

            <button type="button"
                class="relative ml-3 inline-flex items-center rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400" viewBox="0 0 16 16">
                    <path
                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                </svg>
                @livewire('user-counter', ['roomSlug' => $room->slug])
            </button>
        </div>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div id="audio-list" class="hidden p-2 text-gray-900 dark:text-gray-100">

                    <div id="soundpad-one" class="soundpad ">
                        <ul role="list"
                            class="px-4 sm:px-6 lg:px-8 my-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                            @for ($i = 1; $i <= 27; $i++)
                                @php
                                    $audio = $room->audios->where('slot', $i)->first();
                                @endphp
                                @if (isset($audio))
                                    <x-audio :audio=$audio :i=$i />
                                @elseif(!isset($audio))
                                    <x-audio-empty :i=$i />
                                @endif
                            @endfor

                        </ul>
                    </div>

                    <div id="soundpad-two" class="soundpad">
                        <ul role="list"
                            class="px-4 sm:px-6 lg:px-8 my-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                            @for ($i = 28; $i <= 54; $i++)
                                @php
                                    $audio = $room->audios->where('slot', $i)->first();
                                @endphp
                                @if (isset($audio))
                                    <x-audio :audio=$audio :i=$i />
                                @elseif(!isset($audio))
                                    <x-audio-empty :i=$i />
                                @endif
                            @endfor

                        </ul>
                    </div>

                    <div id="soundpad-three" class="soundpad">
                        <ul role="list"
                            class="px-4 sm:px-6 lg:px-8 my-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                            @for ($i = 55; $i <= 81; $i++)
                                @php
                                    $audio = $room->audios->where('slot', $i)->first();
                                @endphp
                                @if (isset($audio))
                                    <x-audio :audio=$audio :i=$i />
                                @elseif(!isset($audio))
                                    <x-audio-empty :i=$i />
                                @endif
                            @endfor

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleGmMenu() {
            document.getElementById('audio-list').classList.toggle('hidden')
            document.getElementById('soundpad-menu').classList.toggle('hidden')
        }

        function getRoomSlug() {
            const path = window.location.pathname.split("/");
            return path[path.length - 1];
        }

        function makeSvg(id) {
            return `<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-play" viewBox="0 0 16 16">
                        <use href="#${id}"></use>
                    </svg>`;
        }

        const playSvgNormal = makeSvg("playSvgNormal");
        const playSvgAmbience = makeSvg("playSvgAmbience");
        const playSvgMusic = makeSvg("playSvgMusic");
        const pauseSvg = makeSvg("pauseSvg");
        const stopSvg = makeSvg("stopSvg");

        function setButtonState(button, action, audioType) {
            if (action === "pause") {
                if (audioType === "ambience") {
                    button.innerHTML = playSvgAmbience;
                } else if (audioType === "music") {
                    button.innerHTML = playSvgMusic;
                } else {
                    button.innerHTML = playSvgNormal;
                }
            } else if (action === "play") {
                button.innerHTML = button.classList.contains("pausable") ?
                    pauseSvg :
                    stopSvg;
            }
        }

        async function stopOtherMusicAudios(slot) {
            let allMusicAudios = document.querySelectorAll('audio[data-type="music"]');
            for (let audio of allMusicAudios) {
                let audioButton = audio.previousElementSibling;
                if (audioButton.dataset.slot !== slot) {
                    if (!audio.paused) {
                        let slot = audio.id.split("-")[1];
                        await axios
                            .post("/audio/action", {
                                action: "stop",
                                slot: slot,
                                roomSlug: getRoomSlug(),
                                _token: document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute("content"),
                            })
                            .catch(function(error) {
                                console.log(error);
                            });
                    }
                }
            }
        }

        function processPlay(e) {
            let audioElement = document.getElementById("audio-" + e.slot);
            let button = audioElement.previousElementSibling;

            audioElement.play();
            audioElement.parentElement.parentElement.classList.add("play");

            setButtonState(button, "play", button.dataset.type);
            button.dataset.action = "play";
        }

        function processPause(e) {
            let audioElement = document.getElementById("audio-" + e.slot);
            let button = audioElement.previousElementSibling;

            audioElement.pause();
            audioElement.parentElement.parentElement.classList.remove("play");

            setButtonState(button, "pause", button.dataset.type);
            button.dataset.action = "pause";
        }

        function processStop(e) {
            let audioElement = document.getElementById("audio-" + e.slot);
            let button = audioElement.previousElementSibling;

            audioElement.pause();
            audioElement.currentTime = 0;
            audioElement.parentElement.parentElement.classList.remove("play");

            setButtonState(button, "pause", button.dataset.type);
            button.dataset.action = "pause";
        }

        function processVolume(e) {
            let audioElement = document.getElementById("audio-" + e.slot);
            let volumeSlider = document.getElementById("volume-" + e.slot);
            audioElement.volume = e.volume;
            volumeSlider.value = e.volume * 100;
            console.log(audioElement.volume);
        }

        function updateSoundpadDisplay() {
            document.getElementById("soundpad-one").style.display = "none";
            document.getElementById("soundpad-two").style.display = "none";
            document.getElementById("soundpad-three").style.display = "none";

            if (document.getElementById("one").checked) {
                document.getElementById("soundpad-one").style.display = "block";
            } else if (document.getElementById("two").checked) {
                document.getElementById("soundpad-two").style.display = "block";
            } else if (document.getElementById("three").checked) {
                document.getElementById("soundpad-three").style.display = "block";
            }
        }

        // Set initial soundpad display (first one)
        updateSoundpadDisplay();

        // Event Listeners for updating soundpad display
        document
            .getElementById("one")
            .addEventListener("change", updateSoundpadDisplay);
        document
            .getElementById("two")
            .addEventListener("change", updateSoundpadDisplay);
        document
            .getElementById("three")
            .addEventListener("change", updateSoundpadDisplay);

        document.querySelectorAll(".audio-control-button").forEach((button) => {
            button.addEventListener("click", async function() {
                const buttonElement = this;
                const slot = buttonElement.dataset.slot;
                const action = buttonElement.dataset.action;
                // Determine the action based on the current state
                const nextAction =
                    action === "play" && buttonElement.classList.contains("pausable") ?
                    "pause" :
                    action === "play" &&
                    !buttonElement.classList.contains("pausable") ?
                    "stop" :
                    "play";

                if (nextAction === "play" && buttonElement.dataset.type === "music") {
                    await stopOtherMusicAudios(slot, buttonElement);
                }

                if (nextAction) {
                    // Send AJAX request to the backend
                    axios
                        .post("/audio/action", {
                            action: nextAction,
                            slot: slot,
                            roomSlug: getRoomSlug(),
                            _token: document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute("content"),
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                }
            });
        });

        document.querySelectorAll(".volume-slider").forEach((slider) => {
            slider.addEventListener("change", function() {
                const sliderElement = this;
                const slot = sliderElement.dataset.slot;

                axios
                    .post("/audio/action", {
                        action: "volume",
                        volume: sliderElement.value / 100,
                        slot: slot,
                        roomSlug: getRoomSlug(),
                        _token: document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            });
        });

        document.querySelectorAll("audio").forEach((audio) => {
            audio.addEventListener("timeupdate", function() {
                let progressbar =
                    audio.parentElement.nextElementSibling.nextElementSibling;
                let percentage = (audio.currentTime / audio.duration) * 100;
                progressbar.style.width = percentage + "%";
            });
        });

        window.onload = function() {
            console.log("Setting initial volumes");
            let audioElements = document.querySelectorAll("audio");

            audioElements.forEach((audioElement) => {
                let initialVolume = audioElement.getAttribute("data-initial-volume");
                audioElement.volume = Number(initialVolume);
            });

            console.log("Loading WebSocket connection");

            Echo.join(`audio.room.${getRoomSlug()}`)
                .here((users) => {
                    Livewire.emit("refreshUserCount");
                })
                .joining((user) => {
                    console.log(user.name + " joined");
                    Livewire.emit("refreshUserCount");
                })
                .leaving((user) => {
                    console.log(user.name + " left");
                    Livewire.emit("refreshUserCount");
                })
                .listen(".AudioEvent", (e) => {
                    if (e.action === "play") {
                        processPlay(e);
                    } else if (e.action === "pause") {
                        processPause(e);
                    } else if (e.action === "stop") {
                        processStop(e);
                    } else if (e.action === "volume") {
                        processVolume(e);
                    }
                });

            console.log("WebSocket connection ready");
        };
    </script>
</x-app-layout>
