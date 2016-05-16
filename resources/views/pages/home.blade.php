@extends('app')

@section('title', 'Rusty Nails Adventurers')
@section('subtitle', "<em>{$quote}</em>")

@section('content')
<div class="row">
    <div class="col s12 m3 l3">
        <h4>Newest users</h4>
        <ul class="collection">
            @foreach ($newUsers as $user)
                <li class="collection-item">
                    <a href="{{ $user->profileUrl }}">
                        {{ $user->name }}
                    </a>
                    <span class="grey-text pull-right">joined {{ $user->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col s12 m6 l6">
        @foreach ($articles as $article)
            <h3>{{ $article->title }}</h3>
            <span class="grey-text">
                Published by
                <a href="{{ $article->author->profileUrl }}">
                    {{ $article->author->name }}
                </a>
                {{ $article->published_at->diffForHumans() }}
            </span>
            {!! Markdown::convertToHtml($article->body) !!}
            @foreach ($article->tagNames() as $tag)
                <div class="chip">{{ $tag }}</div>
            @endforeach
            <hr>
        @endforeach
        {!! $articles->render() !!}
    </div>
    <div class="col s12 m3 l3">
        <h4>Latest forum threads</h4>
        <ul class="collection">
            @foreach ($newThreads as $thread)
                <li class="collection-item grey-text">
                    <a href="{{ Forum::route('thread.show', $thread) }}">
                        {{ $thread->title }}
                    </a>
                    by
                    <a href="{{ $thread->author->profileUrl }}">
                        {{ $thread->author->name }}
                    </a>
                    <br>
                    {{ $thread->created_at->diffForHumans() }}
                </li>
            @endforeach
        </ul>
        <hr>
        <h4>Latest forum posts</h4>
        <ul class="collection">
            @foreach ($newPosts as $post)
                <li class="collection-item grey-text">
                    Re: <a href="{{ Forum::route('post.show', $post) }}">
                        {{ $post->thread->title }}
                    </a>
                    by
                    <a href="{{ $post->author->profileUrl }}">
                        {{ $post->author->name }}
                    </a>
                    <br>
                    {{ $post->created_at->diffForHumans() }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
