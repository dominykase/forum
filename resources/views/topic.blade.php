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
                            <div class="w-full p-3 bg-white shadow-md">
                                <p>{{ $thread->posts_count . ' posts | created ' . $thread->created_at}}</p>
                                <p class="text-xl font-bold">{{ $thread->name }}</p>
                                <p class="line-clamp-1">{{ $thread->posts()->first()->content }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-5 w-full flex justify-center">
                    <div>
                        @foreach ($pageNumbers as $pageNumber)
                            @if ($pageNumber === '...')
                                <span>{{ $pageNumber }}</span>
                            @else
                                <a href="{{ '/thread/' . $thread->id . '/' . $pageNumber }}">{{ $pageNumber }}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
