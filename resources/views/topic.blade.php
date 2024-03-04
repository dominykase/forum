<html>
    <head>
        <title>Thread View</title>
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/topicview.js'])
    </head>
    <body style="width: 100vw;background-color: rgb(241 245 249);">
        <x-site-header />
        <div class="w-full flex justify-center">
            <div class="w-5/6 mt-8 p-5 bg-slate-50 shadow-lg">
                <div class="w-full">
                    @foreach ($threads as $thread)
                        <a href="{{ route('thread', ['threadId' => $thread->id, 'page' => 1]) }}">
                            <div class="w-full my-2 p-3 bg-white shadow-md">
                                <p>{{ '@' . $thread->user->name . ' | ' . $thread->posts_count . ' posts | created ' . $thread->created_at}}</p>
                                <p class="text-xl font-bold">{{ $thread->name }}</p>
                                <p class="line-clamp-1">{{ $thread->posts()->first()->content }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="w-full p-5 mt-5 bg-white shadow-md">
                    <p class="mb-3">Create a thread</p>
                    @if (request()->user())
                        <form action="{{ route('thread.create') }}" method="POST" class="m-0">
                            @csrf
                            <input type="hidden" name="user_id" id="user_id" value="{{ request()->user()->id }}">
                            <input type="hidden" name="topic_id" id="topic_id" value="{{ $topic->id }}">
                            <input type="hidden" name="content" id="content">
                            <input type="text" name="name" id="name" class="mb-2 border border-black border-solid w-full" placeholder="Thread name (must be at least 5 characters long)">
                            <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                            <button type="submit" id="submit_button" disabled class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-2 rounded">Post</button>
                        </form>
                    @else
                        <a href="{{ '/login?toid=' . $topic->id . '&p=' . $pageNum }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Login to post</a>
                    @endif
                </div>
                <div class="mt-5 w-full flex justify-center">
                    <div>
                        @foreach ($pageNumbers as $pageNumber)
                            @if ($pageNumber === '...')
                                <span>{{ $pageNumber }}</span>
                            @else
                                <a href="{{ '/topic/' . $topic->id . '/' . $pageNumber }}">{{ $pageNumber }}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
