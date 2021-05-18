<x-dashboard-wordful-layout>
    <x-slot name="sidebar">
        <x-wordful::sidebar-navigation />
    </x-slot>

    <x-slot name="header">
        <x-wordful::navbar />
    </x-slot>

    <x-wordful::posts-list :groupedPosts="$groupedPosts" />
</x-dashboard-wordful-layout>
