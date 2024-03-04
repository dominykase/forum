<!DOCTYPE html>
<html>
    <head>
        <title>Thread View</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="width: 100vw;background-color: rgb(241 245 249);">
        <x-site-header />
        <div class="w-full flex justify-center pb-8">
            @foreach($topics as $topic)
                <div class="w-5/6 mt-8 p-5 bg-slate-50 shadow-lg">
                    <a href="{{ route('topic', ['topicId' => $topic->id, 'page' => 1]) }}">
                        <p class="text-2xl font-bold">{{ $topic->name }} <span class="text-lg font-light">{{ $topic->threads()->count() . ($topic->threads()->count() > 1 ? ' threads': ' thread') }}</span></p>
                        <p class="text-lg">{{ $topic->description }}</p>
                    </a>
                    @foreach($topic->threads()->orderBy('updated_at', 'desc')->paginate(10, ['*'], 'page', 1) as $thread)
                        <div class="mt-4 p-4 bg-white shadow-md">
                            <a href="{{ route('thread', ['threadId' => $thread->id, 'page' => 1]) }}">
                                <p class="text-xl font-bold">{{ $thread->name }}</p>
                                <p class="text-lg">{{ '@'. $thread->user->name . ' | ' . $thread->posts_count . ($thread->posts_count > 1 ? ' posts' : ' post') . ' | updated at ' . $thread->updated_at }}</p>
                            </a>
                        </div>
                    @endforeach
                    <div class="mt-4 w-full flex justify-center">
                        <a href="{{ route('topic', ['topicId' => $topic->id, 'page' => 1]) }}" class="text-blue-400 hover:text-blue-600">View More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </body>
</html>
