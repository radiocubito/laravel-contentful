<div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
    <div class="flex-1 min-w-0">
        <h1 class="text-sm font-medium leading-4 text-gray-900 sm:truncate">
            {{ $heading }}
        </h1>
    </div>
    @if (isset($actions))
        <div class="mt-4 sm:mt-0 sm:ml-4">
            {{ $actions }}
        </div>
    @endif
</div>
