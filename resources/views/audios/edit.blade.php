<x-app-layout>
    <h1>Edit Audio</h1>

    <form method="POST" action="{{ route('audios.update', ['audio' => $audio]) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $audio->name) }}" value=required>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Audio file</label>
            <input type="file" class="form-control" id="file" name="file" @if(!$audio->file) required @endif >
            @if($audio->file)
            <p>Current file: {{ $audio->file }}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="initial_volume">Initial Volume:</label>
            <input type="number" id="initial_volume" name="initial_volume" value="{{ old('initial_volume', $audio->initial_volume) }}" class="form-control" step="0.01" min="0" max="1" required>
        </div>
        <div class="form-group">
            <label for="loop">Loop:</label>
            <input type="checkbox" id="loop" name="loop" {{ old('loop', $audio->loop) ? 'checked' : '' }} class="form-control">
        </div>
        <div class="form-group">
            <label for="pausable">Pausable:</label>
            <input type="checkbox" id="pausable" name="pausable" {{ old('pausable', $audio->pausable) ? 'checked' : '' }} class="form-control">
        </div>
        <div class="form-group">
            <label for="music">Music:</label>
            <input type="checkbox" id="music" name="music" {{ old('music', $audio->music) ? 'checked' : '' }} class="form-control">
        </div>
        <div class="form-group">
            <label for="ambience">Ambience:</label>
            <input type="checkbox" id="ambience" name="ambience" {{ old('ambience', $audio->ambience) ? 'checked' : '' }} class="form-control">
        </div>
        <button type="submit">Update Audio</button>
    </form>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

</x-app-layout>