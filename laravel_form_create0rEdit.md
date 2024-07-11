# Using same blade form for create and edit

view/entries/createOrEdit.blade.php
```blade
@extends('layouts.app')

@section('content')
    <div>
        @if (isset($event))
            <h1>Edit event</h1>
            <form method="POST" action="{{ route('events.update', $event->id) }}">
                @method('PUT')
        @else
            <h1>Create a new event</h1>
            <form method="POST" action="{{ route('events.store') }}">
        @endif
                @csrf                
                <textarea required name="description" rows="10">{{old('content', $event->description ?? '')}}</textarea>
                <select>
                    @foreach ($venues as $venue)
                        <option @selected(isset($event) && $event->venue_id == $venue->id) value="{{$venue->id}}">{{$venue->name}}</option>
                    @endforeach
                </select>
                <button type="submit">Submit</button>
            </form>
    </div>
@endsection
```

EventController.php
```php
public function create()
{
    return view('events.createOrEdit');
}

public function edit(Event $event)
{
    return view('events.createOrEdit', compact('event'));
}
```
