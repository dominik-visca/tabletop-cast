<x-app-layout>
    <h1>Upload Audio</h1>

    <form method="POST" action="{{ route('audios.store', ['room' => $room]) }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="slot" value="{{ $slot }}">

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="file">File:</label>
            <input type="file" id="file" name="file" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="initial_volume">Initial Volume:</label>
            <input type="number" id="initial_volume" name="initial_volume" class="form-control" step="0.01" min="0" max="1" required>
        </div>
        <div class="form-group">
            <label for="loop">Loop:</label>
            <input type="checkbox" id="loop" name="loop" class="form-control">
        </div>
        <div class="form-group">
            <label for="pausable">Pausable:</label>
            <input type="checkbox" id="pausable" name="pausable" class="form-control">
        </div>
        <div class="form-group">
            <label for="music">Music:</label>
            <input type="checkbox" id="music" name="music" class="form-control">
        </div>
        <div class="form-group">
            <label for="ambience">Ambience:</label>
            <input type="checkbox" id="ambience" name="ambience" class="form-control">
        </div>

        <button type="submit">Upload Audio</button>
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