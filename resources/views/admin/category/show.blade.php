@extends('app')

@section('content')
<div>
    <h2>{{ $category->name }}</h2>
    <form method="post" action="{{ route('admin.category.destroy', $category->name)  }}"
        onsubmit="return confirm('Are you sure to delete')">
        @csrf
        @method("delete")
        <button class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">
            Delete
        </button>
    </form>


    <a href="{{ route('admin.category.edit', $category->name)  }}" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400">
        Edit
    </a>

    <ul>
    @forelse($category->books as $book)
        <li>{{ $book->title  }}</li>
    @empty
        <li>No book found</li>
    @endforelse
    </ul>
</div>
@endsection