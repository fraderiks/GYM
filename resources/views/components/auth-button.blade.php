<form method="{{ $method }}" action="{{ $action }}">
    @if($csrf)
    @csrf
    @endif
    <button 
        type="submit" 
        class="w-full rounded-xl bg-blue-600 text-white font-semibold p-3 hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-3">
        {{ $slot }}
    </button>
</form>