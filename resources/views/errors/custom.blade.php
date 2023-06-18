<x-app-layout>
    <x-slot name="header">
        <div class="ml-4 mt-4">
            <div class="flex items-center">
                <div class="ml-4">
                    <p class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Fehler') }}
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

                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">Error</div>
                                    <div class="card-body">
                                        <p>{{ $message }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
