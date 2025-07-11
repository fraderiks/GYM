@extends('app')

@section('content')
<h1>{{ $formHeading }}</h1>
<form method="post" action="{{ $action }}">
    @csrf
    <div>
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') ?? $category->name }}" />
        @error('name')
        <p class="text-red-500">{{ $message  }}</p>
        @enderror
    </div>
    <div>
        <input type="submit" value="Submit" />
    </div>
</form>
@endsection