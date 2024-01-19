<html>
    <head>
        <title>Thread View</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="width: 100vw;">
        <div class="p-10 flex justify-center">
            <div class="w-5/6 border-solid border-black border p-5">
                <div class="w-full">
                    @foreach ($posts as $post)
                        @if ($loop->index == 0)
                            <p class="text-2xl">{{ $thread->name }}</h1>
                            <p class="text-md ml-4">{{ '@' . $thread->user->name }}</p>
                            <p class="text-lg p-3 border border-white border-b-black border-solid">{{$post->content}}</p>
                        @else
                            <p class="text-md ml-4 pt-2">{{ '@' . $post->user->name }}</p>
                            <p class="text-lg p-3 border border-white border-b-black border-solid">{{$post->content}}</p>
                        @endif
                    @endforeach
                </div>
                <div class="w-full border-solid border-black border p-5 mt-5">
                    <p>Post a reply</p>
                    @if (request()->user())
                        <form action="{{ route('post.store') }}" method="POST" class="m-0">
                            @csrf
                            <input type="hidden" name="thread_id" value="{{ $thread->id }}">
                            <textarea name="content" id="content" class="border border-black border-solid w-full"></textarea>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-2 rounded">Post</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Login to post</a>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
