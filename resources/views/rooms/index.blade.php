<x-app-layout>
    <x-slot name="header">
        <div class="ml-4 mt-4">
            <div class="flex items-center">
                <div class="ml-4">
                    <p class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Räume') }}
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

                    <!-- Room List -->
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="mt-4 flow-root">
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <table class="min-w-full divide-y divide-gray-700">
                                        <thead>
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">
                                                    Name</th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-white">Slug
                                                </th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                                    <span class="sr-only">Bearbeiten</span>
                                                </th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                                    <span class="sr-only">Öffnen</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-800">
                                            @foreach ($rooms as $room)
                                                <tr>
                                                    <td
                                                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                                        {{ $room->name }}</td>
                                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                                        {{ $room->slug }}</td>
                                                    <td
                                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                                        <a href="{{ route('rooms.edit', ['room' => $room->slug]) }}"
                                                            class="text-indigo-400 hover:text-indigo-300">Bearbeiten</a>
                                                    </td>
                                                    <td
                                                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                                        <a href="{{ route('rooms.show', ['room' => $room->slug]) }}"
                                                            class="text-indigo-400 hover:text-indigo-300">Öffnen</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form class="px-4 sm:px-6 lg:px-8 mt-8" method="POST" action="{{ route('rooms.store') }}">
                        <div class="space-y-12">
                            <div class="border-t pt-4 border-white/10 pb-3">
                                <h2 class="text-base font-semibold leading-7 text-white">Neuen Raum erstellen</h2>

                                @csrf

                                <div class="mt-4 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-6">
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                                <input type="text" name="name" id="name" autocomplete="name"
                                                    class="flex-1 border-0 bg-transparent py-1.5 pl-1 text-white focus:ring-0 sm:text-sm sm:leading-6"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Password Input is hidden as it's no longer necessary but a dummy value is required by the db -->
                                    <div class="hidden sm:col-span-6">
                                        <div class="mt-2">
                                            <div
                                                class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                                <input type="text" name="password" id="password"
                                                    value="not-implemented"
                                                    class="flex-1 border-0 bg-transparent py-1.5 pl-1 text-white focus:ring-0 sm:text-sm sm:leading-6"
                                                    placeholder="Password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <x-secondary-button
                                type="submit"
                                class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                Raum erstellen
                            </x-secondary-button>
                        </div>

                        @if ($errors->has('name'))
                            <div class="alert alert-danger text-red-500">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
