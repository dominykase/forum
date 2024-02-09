<html>
    <head>
        <title>Thread View</title>
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/threadview.js'])
    </head>
    <body style="width: 100vw;background-color: rgb(241 245 249);">
        <div class="w-full flex justify-center">
            <div class="mt-8 p-5 w-5/6 bg-slate-50 shadow-md">
                <p>
                    <span class="text-xl font-bold w-96">Username</span>
                    <span class="text-md pl-5">{{ $user->name }}</span>
                </p>
                <p class="my-5">
                    <span class="text-xl font-bold w-96">Posts</span>
                </p>
                @foreach ($posts as $post)
                    <div class="bg-white p-4 m-4 shadow-md">
                        <p class="text-lg">{{ $post->thread->name }}</p>
                        <p class="text-md">{{ '@' . $post->user->name }}</p>
                        <p>{{ $post->content }}</p>
                    </div>
                @endforeach
                <div class="w-full flex justify-center">
                    <div>
                        <a href="{{ '/user/' . $user->name . '/'}}">2</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
