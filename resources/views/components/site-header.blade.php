<div class="w-full bg-slate-50 shadow-md px-32 h-24 flex flex-row">
    <div class="w-1/2 h-full">
        <a href="" class="text-2xl font-bold text-gray-800 p-5 h-full flex items-center">Forum v0.1</a>
    </div>
    <div class="w-1/2 h-full flex items-center">
        <a href="https://google.com" class="text-gray-800 p-5 hover:bg-slate-100">Home</a>
        @if (!is_null(request()->user()))
            <a href="{{ route('profile', ['username' => request()->user()->name, 'page' => 1]) }}" class="text-gray-800 p-5 hover:bg-slate-100">Profile</a>
        @else
            <a href="{{ route('login') }}" class="text-gray-800 p-5 hover:bg-slate-100">Login</a>
        @endif
    </div>
</div>
