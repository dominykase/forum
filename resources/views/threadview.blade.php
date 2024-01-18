<h1>{{$thread->name}}</h1>
@foreach ($posts as $post)
    <p>{{$post->content}}</p>
@endforeach
