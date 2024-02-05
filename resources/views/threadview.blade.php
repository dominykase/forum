<html>
    <head>
        <title>Thread View</title>
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/threadview.js'])
    </head>
    <body style="width: 100vw;background-color: rgb(241 245 249);">
        <div class="p-10 flex justify-center">
            <div class="w-5/6 p-5 bg-slate-50 shadow-lg">
                <div class="w-full">
                    @foreach ($posts as $post)
                        @if ($loop->index == 0)
                            <div class="w-full mb-5 rounded-lg bg-white shadow-inner">
                                <p class="text-2xl p-2">{{ $thread->name }}</h1>
                                <p class="text-md ml-4">{{ '@' . $thread->user->name }}</p>
                                <p class="text-lg p-3 rounded-lg">{{$post->content}}</p>
                            </div>
                        @else
                            <div class="w-full my-5 rounded-lg bg-white shadow-inner">
                                <p class="text-md ml-4 pt-2">{{ '@' . $post->user->name }}</p>
                                <p class="text-lg p-3">{{$post->content}}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="w-full p-5 mt-5 bg-white rounded-lg">
                    <p class="mb-3">Post a reply</p>
                    @if (request()->user())
                        <form action="{{ route('post.store') }}" method="POST" class="m-0">
                            @csrf
                            <input type="hidden" name="thread_id" value="{{ $thread->id }}">
                            <textarea name="content" id="content" class="border border-black border-solid w-full"></textarea>
                            <button type="submit" id="submit_button" disabled class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-2 rounded">Post</button>
                        </form>
                    @else
                        <a href="{{ '/login?tid=' . $thread->id . '&p=' . $pageNum }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Login to post</a>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
