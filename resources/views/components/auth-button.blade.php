<form method="{{ $method }}" action="{{ $action }}">
    @if($csrf)
    @csrf
    @endif
    <button 
        type="submit" 
        class="w-full rounded-xl bg-orange-600 text-white font-semibold p-3 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
        {{ $slot }}
    </button>
</form>