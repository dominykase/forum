<html>
    <head>
        <title>Thread View</title>
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/threadview.js'])
    </head>
    <body style="width: 100vw;background-color: rgb(241 245 249);">
        <div class="w-full flex justify-center">
            <div class="mt-8 p-5 w-5/6 bg-slate-50 shadow-md">
                <p>Username: {{ $user->name }}</p>
                @foreach ($posts as $post)
                    <div class="bg-white p-4 m-4 shadow-md">
                        <p>{{ $post->content }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
