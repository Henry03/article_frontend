@extends('layouts.layout')
@section('content')

<div class="drawer drawer-end lg:drawer-open">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content overflow-y-scroll" style="height: calc(100dvh - 4rem);">
        <div class="p-5 flex flex-col gap-2">
            <div class="rounded-xl p-5 border gap-2 flex flex-col">
                <div class="flex justify-between">
                    <div class="flex flex-row gap-2 text-sm items-center">
                        <x-UserProfileIcon name="{{$article->username}}" height="7" width="7"/>
                        <div>{{$article->username}}</div>
                        <div>• {{\Carbon\Carbon::parse($article->created_at)->diffForHumans()}}</div>
                    </div>
                    @if(session()->has('LoginSession') && session()->get('IdUser') == $article->user_id)
                        <div class="flex gap-2">
                            <a class="badge badge-warning badge-outline" href={{route('article.update', ['id'=>$article->article_id])}}>Edit</a>
                            <btn class="badge badge-error badge-outline cursor-pointer" onclick="openDeleteModal()">Delete</btn>
                        </div>
                    @endif
                </div>
                <h3 class="font-bold text-lg">
                    {{$article->title}}
                </h3>
                <hr />
                <p class="font-semibold">
                    {{$article->description}}
                </p>
                <p>
                    {{$article->body}}
                <p>
                <div class="flex gap-2">
                    <div class="border rounded-full w-fit flex items-center px-2 gap-2">
                        <a href={{route('like.store', ['id' => $article->article_id])}}>
                            <i class="fa fa-heart @if($article->user_liked) text-red-500 @else text-gray-400 @endif" ></i>
                        </a>
                        <button onclick="openLikesModal()">
                            <span>{{$article->like_article_count}} Likes</span>
                        </button>
                    </div>
                    <div class="border rounded-full w-fit flex items-center px-2 gap-2">
                        <i class="fa fa-comment text-gray-400" ></i>
                        <span>{{$article->comment_count}}</span>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mx-5"/>
        @if (session()->has('LoginSession'))
            <div class="p-5 flex flex-col gap-2">
                <div class="rounded-xl p-5 border gap-2 flex flex-col">
                    <form method="POST" action={{Route('comment.store')}}>
                        @csrf
                        <label class="form-control w-full">
                            <input type="hidden" name="article_id" value={{$article->article_id}} />
                            <div class="label">
                                <span class="label-text">Comment</span>
                            </div>
                            <div class="flex gap-2">
                                <input name="comment" type="text" placeholder="Type here" class="input input-bordered w-full @error('comment') border-red-500 @enderror" />

                                <div class="flex justify-end">
                                    <button class="btn btn-primary" type="submit">Post</button>
                                </div>
                            </div>
                            @error('comment')
                            <div class="label">
                                    <span class="label-text-alt text-red-500">{{$message}}</span>
                            </div>
                            @enderror
                        </label>
                    </form>
                </div>
            </div>
        @endif
        <div class="px-5 flex flex-col gap-2 mb-5">
            @foreach($article->comments as $comment)
                <div class="rounded-xl p-5 border gap-2 flex flex-col">
                    <div class="flex flex-row gap-2 text-sm items-center">
                        <x-UserProfileIcon name="{{$comment->username}}" height="7" width="7"/>
                        <div>{{$comment->username}}</div>
                        <div>• {{\Carbon\Carbon::parse($article->created_at)->diffForHumans()}}</div>
                    </div>
                    <p>
                        {{$comment->body}}
                    </p>
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

<dialog id="deleteModal" class="modal">
    <div class="modal-box">
        <div class="flex justify-between">
            <h3 class="text-lg font-bold">Delete Article</h3>
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
        </div>
        <p class="py-4">Are you sure want to delete this article?</p>
        <div class="grid grid-cols-2 gap-2 w-full">
            <button class="btn btn-primary w-full" onclick="closeDeleteModal()">Cancel</button>
            <a class="btn btn-error w-full" href={{route('article.delete', ['id'=>$article->article_id])}}>Delete</a>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
      <button>close</button>
    </form>
</dialog>
<dialog id="likesModal" class="modal">
    <div class="modal-box">
        <div class="flex justify-between">
            <h3 class="text-lg font-bold">Likes</h3>
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
        </div>
        <p class="py-4">Peoples who like this article</p>
        <div class="flex flex-col gap-1">
            @foreach($article->like as $item)
                <div class="flex items-center border rounded-xl p-3 justify-between my-1">
                    <div class="flex gap-2">
                        <x-UserProfileIcon name="{{$item->username}}" height="7" width="7"/>
                        <div>{{$item->username}}</div>
                    </div>
                    <div>
                        <div>{{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
      <button>close</button>
    </form>
</dialog>

<script>
    function openDeleteModal () {
        document.getElementById('deleteModal').showModal()
    }

    function closeDeleteModal () {
        document.getElementById('deleteModal').close()
    }

    function openLikesModal () {
        document.getElementById('likesModal').showModal()
    }
</script>
@endsection
