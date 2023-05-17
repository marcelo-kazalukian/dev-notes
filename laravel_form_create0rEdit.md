# Using same blade form for create and edit

view/entries/createOrEdit.blade.php
```blade
@extends('layouts.app')

@section('content')
    <div>
        <h1>Create a new entry</h1>
        @if (isset($entry))
            <form method="POST" action="{{ route('entries.update', $entry->id) }}">
            @method('PUT')
        @else
            <form method="POST" action="{{ route('entries.store') }}">
        @endif
            @csrf
            <div>                
                <textarea required name="content" rows="10">{{old('content', $entry->content)}}</textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
@endsection
```
