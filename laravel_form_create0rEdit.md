# Using same blade form for create and edit

view/entries/createOrEdit.blade.php
```blade
@extends('layouts.app')

@section('content')
    <div>
        @if (isset($entry))
            <h1>Edit entry</h1>
            <form method="POST" action="{{ route('entries.update', $entry->id) }}">
                @method('PUT')
        @else
            <h1>Create a new entry</h1>
            <form method="POST" action="{{ route('entries.store') }}">
        @endif
                @csrf
                <div>                
                    <textarea required name="content" rows="10">{{old('content', $entry->content ?? '')}}</textarea>
                </div>
                <button type="submit">Submit</button>
            </form>
    </div>
@endsection
```

EntryController.php
```php
public function create()
{
    return view('entries.createOrEdit');
}

public function edit(Entry $entry)
{
    return view('entries.createOrEdit', compact('entry'));
}
```
