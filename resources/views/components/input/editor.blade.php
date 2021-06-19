<div
    class="flex flex-col"
    x-data="{
        content: @entangle($attributes->wire('model')),
        placeholder: '{{ __('Add some content…') }}',
        uploadFile(file) {
            return new Promise((accept, fail) => {
                @this.upload('newImages', file, (uploadedFilename) => {
                    accept(@this.call('completeUpload', uploadedFilename))
                }, () => {
                    fail('Error')
                }, (event) => {
                    // Progress callback.
                    // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                })
            })
        },
        ...setupEditor()
    }"
    x-init="() => init($refs.editor)"
    wire:ignore
    {{ $attributes->whereDoesntStartWith('wire:model') }}
>
    <div x-ref="editor"></div>

    <template x-if="editor">
        <div class="py-1 border-t mt-6 border-gray-200 flex items-center space-x-1 sticky bottom-0 bg-white z-10 -mx-1 overflow-hidden">
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="editor.chain().toggleBold().focus().run()"
                :class="{ 'bg-gray-200 text-gray-900': editor.isActive('bold') }"
                title="{{ __('Bold') }}"
                type="button"
            >
                <x-wordful::icon.bold class="h-4 w-4" />
            </button>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="editor.chain().toggleItalic().focus().run()"
                :class="{ 'bg-gray-200 text-gray-900': editor.isActive('italic') }"
                title="{{ __('Italic') }}"
                type="button"
            >
                <x-wordful::icon.italic class="h-4 w-4" />
            </button>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="editor.chain().focus().toggleStrike().run()"
                :class="{ 'bg-gray-200 text-gray-900': editor.isActive('strike') }"
                title="{{ __('Strike') }}"
                type="button"
            >
                <x-wordful::icon.strike class="h-4 w-4" />
            </button>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="editor.chain().focus().toggleCode().run()"
                :class="{ 'bg-gray-200 text-gray-900': editor.isActive('code') }"
                title="{{ __('Code') }}"
                type="button"
            >
                <x-wordful::icon.code class="h-4 w-4" />
            </button>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="setLink" :class="{ 'bg-gray-200 text-gray-900': editor.isActive('link') }"
                title="{{ __('Link') }}"
                type="button"
            >
                <x-wordful::icon.link class="h-4 w-4" />
            </button>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="editor.chain().focus().unsetLink().run()"
                x-show="editor.isActive('link')"
                title="{{ __('Unlink') }}"
                type="button"
            >
                <x-wordful::icon.unlink class="h-4 w-4" />
            </button>
            <div><span class="h-5 bg-gray-200 mx-2 block w-px"></span></div>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="editor.chain().toggleHeading({ level: 1 }).focus().run()"
                :class="{ 'bg-gray-200 text-gray-900': editor.isActive('heading', { level: 1 }) }"
                title="{{ __('Heading 1') }}"
                type="button"
            >
                <x-wordful::icon.h1 class="h-4 w-4" />
            </button>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="editor.chain().toggleHeading({ level: 2 }).focus().run()"
                :class="{ 'bg-gray-200 text-gray-900': editor.isActive('heading', { level: 2 }) }"
                title="{{ __('Heading 2') }}"
                type="button"
            >
                <x-wordful::icon.h2 class="h-4 w-4" />
            </button>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="editor.chain().setParagraph().focus().run()"
                :class="{ 'bg-gray-200 text-gray-900': editor.isActive('paragraph') }"
                title="{{ __('Paragraph') }}"
                type="button"
            >
                <x-wordful::icon.paragraph class="h-4 w-4" />
            </button>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="editor.chain().focus().toggleBulletList().run()"
                :class="{ 'bg-gray-200 text-gray-900': editor.isActive('bulletList') }"
                title="{{ __('Bullet List') }}"
                type="button"
            >
                <x-wordful::icon.ul class="h-4 w-4" />
            </button>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="editor.chain().focus().toggleOrderedList().run()"
                :class="{ 'bg-gray-200 text-gray-900': editor.isActive('orderedList') }"
                title="{{ __('Ordered List') }}"
                type="button"
            >
                <x-wordful::icon.ol class="h-4 w-4" />
            </button>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="editor.chain().focus().toggleCodeBlock().run()"
                :class="{ 'bg-gray-200 text-gray-900': editor.isActive('codeBlock') }"
                title="{{ __('Code Block') }}"
                type="button"
            >
                <x-wordful::icon.pre class="h-4 w-4" />
            </button>
            <div><span class="h-5 bg-gray-200 mx-2 block w-px"></span></div>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="editor.chain().focus().toggleBlockquote().run()"
                :class="{ 'bg-gray-200 text-gray-900': editor.isActive('blockquote') }"
                title="{{ __('Blockquote') }}"
                type="button"
            >
                <x-wordful::icon.quote class="h-4 w-4" />
            </button>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="editor.chain().focus().setHorizontalRule().run()"
                title="{{ __('Horizontal Rule') }}"
                type="button"
            >
                <x-wordful::icon.hr class="h-4 w-4" />
            </button>
            <div><span class="h-5 bg-gray-200 mx-2 block w-px"></span></div>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                x-on:click.prevent="$refs.images.click()"
                title="{{ __('Image') }}"
                type="button"
            >
                <x-wordful::icon.image class="h-4 w-4" />
            </button>
            <input type="file" multiple style="display: none;"
                x-ref="images"
                x-on:change="
                    Array.from($refs.images.files).forEach(async file => {
                        startImageUpload(file)
                    })
                " />
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="
                    editor.can().imageToFigure() ?
                        editor.chain().focus().imageToFigure().run() :
                        editor.chain().focus().figureToImage().run()
                "
                :disabled="!editor.can().imageToFigure() && !editor.can().figureToImage()"
                :class="{ 'bg-gray-200 text-gray-900': editor.can().figureToImage() }"
                title="{{ __('Figure') }}"
                type="button"
            >
                <x-wordful::icon.figure class="h-4 w-4" />
            </button>
            <div><span class="h-5 bg-gray-200 mx-2 block w-px"></span></div>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="editor.chain().focus().undo().run()"
                title="{{ __('Undo') }}"
                type="button"
            >
                <x-wordful::icon.undo class="h-4 w-4" />
            </button>
            <button
                class="p-1 rounded hover:bg-gray-200 hover:text-gray-900 text-gray-500 transition"
                @click="editor.chain().focus().redo().run()"
                title="{{ __('Redo') }}"
                type="button"
            >
                <x-wordful::icon.redo class="h-4 w-4" />
            </button>
        </div>
    </template>
</div>
