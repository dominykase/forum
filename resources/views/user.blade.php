<html>
    <head>
        <title>Thread View</title>
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/threadview.js'])
    </head>
    <body style="width: 100vw;background-color: rgb(241 245 249);">
        <div class="w-full flex justify-center">
            <div class="mt-8 p-5 w-5/6 bg-slate-50 shadow-md">
                <div class="flex flex-row items-center">
                    <div class="text-xl font-bold w-32">Username</div>
                    <div class="text-md pl-5">{{ $user->name }}</div>
                </div>
                <div class="flex flex-row items-center">
                    <div class="text-xl font-bold w-32">Total posts</div>
                    <div class="text-md pl-5">{{ $total }}</div>
                </div>
                <div class="my-3">
                    <div class="text-xl font-bold w-96">Posts</div>
                </div>
                @foreach ($posts as $post)
                    <div class="bg-white p-4 m-4 shadow-md">
                        <p class="text-lg">{{ $post->thread->name }}</p>
                        <p class="text-md">{{ '@' . $post->user->name }}</p>
                        <p>{{ $post->content }}</p>
                    </div>
                @endforeach
                <div class="w-full flex justify-center">
                    <div>
                        @foreach ($pageNumbers as $pageNumber)
                            @if ($pageNumber === '...')
                                <span>{{ $pageNumber }}</span>
                            @else
                                <a href="{{ '/user/' . $user->name . '/' . $pageNumber }}">{{ $pageNumber }}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
