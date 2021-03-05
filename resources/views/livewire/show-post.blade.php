<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('contentful.posts.edit', $post) }}">{{ __('Edit') }}</a>

        <p class="text-base text-center">{{ $post->published_at->format('M n, Y') }}</p>

        <h2 class="text-5xl font-bold text-center leading-none mt-4">{{ $post->title }}</h2>

        <div class="prose prose-xl mt-12">{!! $post->html !!}</div>
    </div>
</div>
