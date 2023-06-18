<x-app-layout>
    <x-slot name="header">
        <div class="ml-4 mt-4">
            <div class="flex items-center">
                <div class="ml-4">
                    <p class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Raum bearbeiten: ' . $room->name) }}
                    </p>
                </div>
            </div>
        </div>
        <div class="ml-4 mt-4 flex flex-shrink-0">
            <div id="soundpad-menu">
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
        </div>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Room Edit -->
                    <form class="px-4 sm:px-6 lg:px-8 mt-4" method="POST"
                        action="{{ route('rooms.update', $room->slug) }}" enctype="multipart/form-data">
                        <div class="space-y-12">
                            <div class="border-b border-white/10 pb-12">
                                @csrf
                                @method('PATCH')

                                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-6">
                                        <label for="name"
                                            class="block text-sm font-medium leading-6 text-white">Name</label>
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                                <input type="text" name="name" id="name"
                                                    value="{{ old('name', $room->name) }}" autocomplete="name"
                                                    class="flex-1 border-0 bg-transparent py-1.5 pl-1 text-white focus:ring-0 sm:text-sm sm:leading-6"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-room-deletion')">
                                        {{ __('Löschen') }}</x-danger-button>

                                    <x-secondary-button
                                        type="submit"
                                        class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                        Aktualisieren
                                    </x-secondary-button>
                                </div>

                                @if ($errors->any())
                                    <div class="sm:col-span-6 mt-6">
                                        <div class="rounded-md bg-red-50 p-4">
                                            <div class="flex">
                                                <div class="flex-shrink-0">
                                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20"
                                                         fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                                              clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <h3 class="text-sm font-medium text-red-800">Es gab Probleme
                                                        &#128557</h3>
                                                    <div class="mt-2 text-sm text-red-700">
                                                        <ul role="list" class="list-disc space-y-1 pl-5">
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </form>

                    <x-modal name="confirm-room-deletion" focusable>
                        <form method="post" action="{{ route('rooms.destroy', ['room' => $room]) }}">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Bist du sicher, dass du den Raum löschen willst?') }}
                            </h2>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Abbrechen') }}
                                </x-secondary-button>

                                <x-danger-button class="ml-3">
                                    {{ __('Raum löschen') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>

                    <!-- Audio Buttons -->
                    <div id="soundpad-one" class="soundpad">
                        <ul role="list"
                            class="px-4 sm:px-6 lg:px-8 mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                            @for ($i = 1; $i <= 27; $i++)
                                @php
                                    $audio = $room->audios->where('slot', $i)->first();
                                @endphp
                                @if (isset($audio))
                                    <x-audio-edit :room=$room :audio=$audio :i=$i />
                                @elseif(!isset($audio))
                                    <x-audio-edit-empty :room=$room :i=$i />
                                @endif
                            @endfor

                        </ul>
                    </div>

                    <div id="soundpad-two" class="soundpad">
                        <ul role="list"
                            class="px-4 sm:px-6 lg:px-8 mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                            @for ($i = 28; $i <= 54; $i++)
                                @php
                                    $audio = $room->audios->where('slot', $i)->first();
                                @endphp
                                @if (isset($audio))
                                    <x-audio-edit :room=$room :audio=$audio :i=$i />
                                @elseif(!isset($audio))
                                    <x-audio-edit-empty :room=$room :i=$i />
                                @endif
                            @endfor

                        </ul>
                    </div>

                    <div id="soundpad-three" class="soundpad">
                        <ul role="list"
                            class="px-4 sm:px-6 lg:px-8 mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                            @for ($i = 55; $i <= 81; $i++)
                                @php
                                    $audio = $room->audios->where('slot', $i)->first();
                                @endphp
                                @if (isset($audio))
                                    <x-audio-edit :room=$room :audio=$audio :i=$i />
                                @elseif(!isset($audio))
                                    <x-audio-edit-empty :room=$room :i=$i />
                                @endif
                            @endfor

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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
        document.getElementById("one").addEventListener("change", updateSoundpadDisplay);
        document.getElementById("two").addEventListener("change", updateSoundpadDisplay);
        document.getElementById("three").addEventListener("change", updateSoundpadDisplay);
    </script>
</x-app-layout>
