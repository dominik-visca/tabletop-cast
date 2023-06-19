<x-app-layout>
    <x-slot name="header">
        <div class="ml-4 mt-4">
            <div class="flex items-center">
                <div class="ml-4">
                    <p class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Audiofeld anlegen') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="ml-4 mt-4 flex flex-shrink-0">
        </div>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Audio Edit -->
                    <form class="px-4 sm:px-6 lg:px-8 mt-4" method="POST"
                        action="{{ route('audios.store', ['room' => $room]) }}" enctype="multipart/form-data">
                        <div class="space-y-12">
                            <div class="border-b border-white/10 pb-12">
                                @csrf

                                <input type="hidden" name="slot" value="{{ $slot }}">

                                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-6">
                                        <label for="name"
                                            class="block text-sm font-medium leading-6 text-white">Name</label>
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                                <input type="text" name="name" id="name" value=""
                                                    autocomplete="name"
                                                    class="flex-1 border-0 bg-transparent py-1.5 pl-1 text-white focus:ring-0 sm:text-sm sm:leading-6"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <label for="file"
                                            class="block text-sm font-medium leading-6 text-white">Audiodatei (max. 40
                                            MB)</label>
                                        <input type="file" class="form-control" id="fileInput" name="file"
                                            required>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <label for="initial_volume"
                                            class="block text-sm font-medium leading-6 text-white">Lautstärke</label>
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                                <input type="range" step="0.01" min="0" max="1"
                                                    name="initial_volume" id="initial_volume" value="0.5"
                                                    class="flex-1 border-0 bg-transparent py-1.5 pl-1 text-white focus:ring-0 sm:text-sm sm:leading-6">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <fieldset class="mt-6">
                                            <legend class="mb-2 text-sm font-semibold leading-6 text-white">
                                                Audioeinstellungen</legend>
                                            <div class="space-y-2">
                                                <div class="relative flex gap-x-3">
                                                    <div class="flex h-6 items-center">
                                                        <input id="loop" name="loop" type="checkbox"
                                                            class="h-4 w-4 rounded border-white/10 bg-white/5 text-indigo-600 focus:ring-indigo-600 focus:ring-offset-gray-900">
                                                    </div>
                                                    <div class="text-sm leading-6">
                                                        <label for="loop"
                                                            class="font-medium text-white">Wiederholung/Loop</label>
                                                    </div>
                                                </div>
                                                <div class="relative flex gap-x-3">
                                                    <div class="flex h-6 items-center">
                                                        <input id="pausable" name="pausable" type="checkbox"
                                                            class="h-4 w-4 rounded border-white/10 bg-white/5 text-indigo-600 focus:ring-indigo-600 focus:ring-offset-gray-900">
                                                    </div>
                                                    <div class="text-sm leading-6">
                                                        <label for="pausable" class="font-medium text-white">Pause
                                                            (statt Stop)</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <fieldset class="mt-6">
                                            <legend class="mb-2 text-sm font-semibold leading-6 text-white">
                                                Visualisierung</legend>
                                            <div class="space-y-2">
                                                <div class="relative flex gap-x-3">
                                                    <div class="flex h-6 items-center">
                                                        <input id="music" name="music" type="checkbox"
                                                            class="h-4 w-4 rounded border-white/10 bg-white/5 text-indigo-600 focus:ring-indigo-600 focus:ring-offset-gray-900">
                                                    </div>
                                                    <div class="text-sm leading-6">
                                                        <label for="music"
                                                            class="font-medium text-white">Musik</label>
                                                    </div>
                                                </div>
                                                <div class="relative flex gap-x-3">
                                                    <div class="flex h-6 items-center">
                                                        <input id="ambience" name="ambience" type="checkbox"
                                                            class="h-4 w-4 rounded border-white/10 bg-white/5 text-indigo-600 focus:ring-indigo-600 focus:ring-offset-gray-900">
                                                    </div>
                                                    <div class="text-sm leading-6">
                                                        <label for="ambience"
                                                            class="font-medium text-white">Ambience</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>

                                    @if ($errors->any())
                                        <div class="sm:col-span-6">
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

                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <x-secondary-button
                                    type="submit"
                                    class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                    Aktualisieren
                                </x-secondary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("fileInput").addEventListener("change", function(e) {
            const size = this.files[0].size / 1024 / 1024; // in MB
            if (size > 40) {
                alert("Datei darf nicht größer als 40 MB sein.");
                this.value = ""; // clear the input
            }
        });
    </script>
</x-app-layout>
