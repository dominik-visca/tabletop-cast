<x-app-layout>
    <x-slot name="header">
        <div class="ml-4 mt-4">
            <div class="flex items-center">
                <div class="ml-4">
                    <p class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Kampagnen') }}
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
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @foreach ($campaigns as $campaign)
                            <div class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white dark:bg-gray-700 px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                                <div class="min-w-0 flex-1">
                                    <a href="{{ route('campaigns.show', ['campaign' => $campaign->id]) }}" class="focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-200">{{ $campaign->name }}</p>
                                        <p class="truncate text-sm text-gray-500 dark:text-gray-300">{{ $campaign->role_name }}</p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <form class="mt-8" method="POST" action="{{ route('campaigns.store') }}">
                        <div class="space-y-12">
                            <div class="border-t pt-4 border-white/10 pb-3">
                                <h2 class="text-base font-semibold leading-7 text-white">Neue Kampagne erstellen</h2>

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

                                    <div class="sm:col-span-6">
                                        <div>
                                            <div
                                                class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                                <input type="text" name="description" id="description"
                                                       class="flex-1 border-0 bg-transparent py-1.5 pl-1 text-white focus:ring-0 sm:text-sm sm:leading-6"
                                                       placeholder="Beschreibung">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <x-secondary-button
                                type="submit"
                                class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                                Kampagne erstellen
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

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
