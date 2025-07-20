@extends('gym')

@section('content')
<section>
    <h1>Category Admin Page</h1>
    <a href="{{ route('admin.category.create')  }}">Create Category</a>
    <form method="get">
        <select name="ordering">
            <option value="ascending" @if($ordering == 'ascending') selected @endif>Ascending</option>
            <option value="descending" @if($ordering == 'descending') selected @endif>Descending</option>
        </select>
        <input type="text" name="filter" value="{{ $filter }}" />
        <input type="submit" value="ordering & search" />
    </form>
    <table class="min-w-full  divide-y divide-gray-200 border border-gray-300">
        <thead class="bg-gray-100">
        <tr>
            <th scope="col" class="px-4 py-2 text-left text-sm font-medium text-gray-700">Name</th>
            <th scope="col" class="px-4 py-2 text-left text-sm font-medium text-gray-700">Books Count</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
        @forelse ($categories as $category)
        <tr>
            <td class="px-4 py-2 text-sm text-gray-800"><a href="{{ route('admin.category.show', $category->name)  }}">{{ $category->name  }}</a></td>
            <td class="px-4 py-2 text-sm text-gray-800">{{ $category->books->count() }}</td>
        </tr>
        @empty
        <tr>
            <td class="px-4 py-2 text-sm text-gray-800">No Category found</td>
        </tr>
        @endforelse
        </tbody>
    </table>
    {{ $categories->links() }}
</section>
@endsection