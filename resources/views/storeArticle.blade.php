@extends('layouts.layout')
@section('content')

<div class="drawer drawer-end lg:drawer-open">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
        <div class="p-5 flex flex-col gap-2">
            <div class="rounded-xl p-5 border" id="createForm">
                <h3 class="font-bold">
                    Create Article
                </h3>
                <form method="POST" action={{Route('article.store')}}>
                    @csrf
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Title</span>
                        </div>
                        <input name="title" type="text" placeholder="Type here" class="input input-bordered w-full @error('title') border-red-500 @enderror" />
                        <div class="label">
                            @error('title')
                                <span class="label-text-alt text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Description</span>
                        </div>
                        <input name="description" type="text" placeholder="Type here" class="input input-bordered w-full @error('description') border-red-500 @enderror" />
                        <div class="label">
                            @error('description')
                                <span class="label-text-alt text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Body</span>
                        </div>
                        <textarea name="body" type="text" placeholder="Type here" class="textarea textarea-bordered w-full @error('body') border-red-500 @enderror" ></textarea>
                        <div class="label">
                            @error('body')
                                <span class="label-text-alt text-red-500">{{$message}}</span>
                            @enderror
                        </div>
                    </label>
                    <div class="flex justify-end">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
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
@endsection
