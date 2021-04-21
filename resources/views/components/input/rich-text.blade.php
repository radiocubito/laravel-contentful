<div
    x-data="{
        value: @entangle($attributes->wire('model')),
        isFocused() { return document.activeElement !== this.$refs.trix },
        setValue() { this.$refs.trix.editor.loadHTML(this.value) },
        uploadTrixImage(attachment) {
            if (event.attachment.file) {
                @this.upload(
                    'newFiles',
                    attachment.file,
                    function (uploadedUrl) {
                        const eventName = `wordful:trix-upload-completed:${btoa(uploadedUrl)}`;

                        const listener = function (event) {
                            attachment.setAttributes(event.detail);
                            window.removeEventListener(eventName, listener);
                        }

                        window.addEventListener(eventName, listener);

                        @this.call('completeUpload', uploadedUrl, eventName);
                    },
                    function () {},
                    function (event) {
                        attachment.setUploadProgress(event.detail.progress);
                    }
                );
            }
        },
    }"
    x-init="Trix.config.blockAttributes.heading1.tagName = 'h2'; setValue(); $watch('value', () => isFocused() && setValue());"
    x-on:trix-change="value = $event.target.value"
    x-on:trix-attachment-add="uploadTrixImage($event.attachment)"
    {{ $attributes->whereDoesntStartWith('wire:model') }}
    wire:ignore
>
    <input id="x" type="hidden">
    <trix-editor x-ref="trix" input="x" class="prose max-w-none border-transparent focus:ring-transparent focus:border-transparent outline-none focus:z-10 px-0" style="min-height: 22em;" placeholder="Begin writing your post…"></trix-editor>
</div>
