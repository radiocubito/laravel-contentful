<div
     class=""
     wire:ignore
     x-data="{ value: @entangle($attributes->wire('model')), taggle: undefined }"
     x-init="
        taggle = new Taggle($refs.input, {
             tags: value,
             preserveCase: true,
             onTagAdd: function(e, tag) {
                 value = taggle.getTagValues();
             },
             onTagRemove: function(e, tag) {
                value = taggle.getTagValues();
             }
         });
 ">

    <div x-ref="input"></div>
 </div>
