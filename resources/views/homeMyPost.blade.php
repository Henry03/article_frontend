@extends('layouts.layout')
@section('content')

<div class="drawer drawer-end lg:drawer-open">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
        <div class="p-5 flex flex-col gap-2">

            @foreach($articles as $article)
                <div class="rounded-xl p-5 border gap-2 flex flex-col">
                    <a class="flex flex-col gap-2"  href={{route('article.detail', ['id'=>$article->article_id])}}>
                        <div class="flex flex-row gap-2 text-sm items-center">
                            <x-UserProfileIcon name="{{$article->username}}" height="7" width="7"/>
                            <div>{{$article->username}}</div>
                            <div>• {{\Carbon\Carbon::parse($article->created_at)->diffForHumans()}}</div>
                        </div>
                        <h3 class="font-bold">
                            {{$article->title}}
                        </h3>
                        <p>
                            {{$article->description}}
                        </p>
                    </a>
                    <div class="flex gap-2">
                        <a class="border rounded-full w-fit flex items-center px-2 gap-2"  href={{route('like.store', ['id' => $article->article_id])}}>
                            <i class="fa fa-heart @if($article->user_liked) text-red-500 @else text-gray-400 @endif" ></i>
                            <span>{{$article->like_article_count}}</span>
                        </a>
                        <div class="border rounded-full w-fit flex items-center px-2 gap-2">
                            <i class="fa fa-comment text-gray-400" ></i>
                            <span>{{$article->comment_count}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        
        </div>
    </div>
    <div class="drawer-side" style="height: calc(100dvh - 4rem);">
      <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
      <ul class="menu bg-base-100 border-s text-base-content w-80 p-4" style="height: calc(100dvh - 4rem);">
        <!-- Sidebar content here -->
        <li><a>Sidebar Item 1</a></li>
        <li><a>Sidebar Item 2</a></li>
      </ul>
    </div>
</div>
<script>
    function openCreateForm () {
        document.getElementById('createForm').classList.remove('hidden')
        document.getElementById('createButton').classList.add('hidden')
    }
</script>
@endsection
