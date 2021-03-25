<x-wordful::subscribers-layout>
    <main class="p-4 max-w-3xl mx-auto min-h-screen">
        <section>
            <div class="p-6 mx-auto text-center rounded shadow-lg lg:p-8 max-w-lg border">
                <h1 class="m-0 text-2xl lg:text-3xl font-bold leading-none text-center">
                    Want to unsubscribe from this list?
                </h1>

                <form method="POST" action="{{ \URL::signedRoute('wordful.subscribers.unsubscribe.store', $subscriber) }}" class="mt-1">
                    @csrf
                    <input type="submit" value="Unsubscribe" class="font-medium text-xs border rounded-full py-1 px-2 bg-white border-gray-900 cursor-pointer">
                </form>

                <script>document.getElementsByTagName("form")[0].submit()</script>
            </div>
        </section>
    </main>
</x-wordful::subscribers-layout>
