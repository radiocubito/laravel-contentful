<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <h1>{{ __('Posts') }}</h1>
        <a href="{{ route('contentful.posts.create') }}" class="block mt-4">{{ __('Create Post') }}</a>
        <div class="space-y-4 mt-8">
            @foreach ($posts as $post)
                <div>
                    <h2><a href="{{ route('contentful.posts.show', $post) }}">{{ $post->title }}</a></h2>
                </div>
            @endforeach
        </div>
    </div>
</div>
