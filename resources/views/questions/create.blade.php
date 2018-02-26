@extends('layouts.app')

@section('content')
    @if (isset($status))
        <status-toast>
            {{ isset($status) }}
        </status-toast>
    @endif

    <div class="text-center">
        <h1>Create Question</h1>
    </div>

    <hr>
    <div class="container-fluid">
        <form method="POST" action="/questions">
            @csrf

            <div class="form-group">
                <label for="q_header">Enter Main Question:</label>
                <input type="text" class="form-control" id="q_header" name="title" required>
            </div>
            <div class="form-group">
                <label for="q_body">Full Question Specifications + Context:</label>
                <textarea id="q_body" name="body" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        var simplemde = new SimpleMDE({element: $("#q_body")[0], autosave: true, forceSync: true});
    </script>
@endsection