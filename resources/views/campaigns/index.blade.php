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

                    <!-- Room List -->
                                        <ul>
                                            @foreach ($campaigns as $campaign)
                                                    <li>
                                                        {{ $campaign->name }}
                                                    </li>
                                            @endforeach
                                        </ul>
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