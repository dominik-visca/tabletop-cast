@props(['audio', 'i'])

<li class="col-span-1 rounded-t-lg rounded-b-lg overflow-auto dark:bg-gray-700 bg-white shadow">

    <div class="flex w-full items-center justify-between space-x-6 p-3">

        <button data-action="stop" data-slot="{{ $i }}"
            data-type="{{ $audio->ambience ? 'ambience' : ($audio->music ? 'music' : 'normal') }}"
            class="audio-control-button {{ $audio->pausable ? 'pausable' : '' }} h-12 w-12 bg-gray-900 items-center justify-center flex rounded">
            @if ($audio->ambience)
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    class="bi bi-image" viewBox="0 0 16 16">
                    <use href="#playSvgAmbience"></use>
                </svg>
            @elseif($audio->music)
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    class="bi bi-music-note-beamed" viewBox="0 0 16 16">
                    <use href="#playSvgMusic"></use>
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    class="bi bi-play" viewBox="0 0 16 16">
                    <use href="#playSvgNormal"></use>
                </svg>
            @endif
        </button>

        <!-- it seems, the audio element here does not irritate the other elements -->
        <audio style="display:none;" id="audio-{{ $i }}" playsinline controls preload="auto"
            data-type="{{ $audio->ambience ? 'ambience' : ($audio->music ? 'music' : 'normal') }}"
            data-initial-volume="{{ $audio->initial_volume }}"
            onended="getElementById('audio-' + {{ $i }}).parentElement.parentElement.classList.toggle('play')"
            src="{{ Storage::url($audio->file) }}" {{ $audio->loop ? 'loop' : '' }}>
        </audio>


        <div class="flex-1 truncate">
            <div class="flex items-center space-x-3">
                <h3 class="truncate text-sm font-medium text-gray-800 dark:text-gray-200">
                    {{ $audio->name }}</h3>
                @if ($audio->loop)
                    <span
                        class="inline-flex flex-shrink-0 items-center rounded-full bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Loop</span>
                @endif
            </div>
            <p class="mt-1 truncate text-sm text-gray-700 dark:text-gray-400">
                <!-- Platzhalter -->
            </p>
        </div>
    </div>

    <input id="volume-{{ $i }}" data-slot="{{ $i }}"
        class="volume-slider w-full block dark:bg-gray-900 dark:border-gray-900 border-2" type="range" min="1"
        max="100" value="{{ $audio->initial_volume * 100 }}">

    <!-- Progressbar -->
    <div class="bg-emerald-700 w-0" style="height: 6px; transition: width 0.2s linear">
    </div>
</li>
