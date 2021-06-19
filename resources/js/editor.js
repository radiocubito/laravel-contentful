import { Editor } from '@tiptap/core'
import { Extension } from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'
import Image from '@tiptap/extension-image'
import Link from '@tiptap/extension-link'
import Placeholder from '@tiptap/extension-placeholder'
import { Figure } from './figure'

import { Plugin, PluginKey } from 'prosemirror-state'
import { Decoration, DecorationSet } from 'prosemirror-view'

export const placeholderPluginKey = new PluginKey('placeholderPlugin')

export const placeholderPlugin = Extension.create({
    name: 'placeholderPlugin',

    addProseMirrorPlugins() {
        return [
            new Plugin({
                key: placeholderPluginKey,

                state: {
                    init() {
                        return DecorationSet.empty
                    },
                    apply(tr, set) {
                        // Adjust decoration positions to changes made by the transaction
                        set = set.map(tr.mapping, tr.doc)

                        // See if the transaction adds or removes any placeholders
                        let action = tr.getMeta(this)

                        if (action && action.add) {
                            let widget = document.createElement("placeholder")
                            let decoration = Decoration.widget(action.add.position, widget, {id: action.add.id})
                            set = set.add(tr.doc, [decoration])
                        } else if (action && action.remove) {
                            set = set.remove(set.find(null, null, spec => spec.id == action.remove.id))
                        }

                        return set
                    }
                },
                props: {
                    decorations(state) {
                        return this.getState(state)
                    }
                }
            }),
        ]
    },
})

window.setupEditor = function() {
    return {
        editor: null,
        updatedAt: Date.now(), // force Alpine to rerender on selection change,
        findPlaceholder(id) {
            const decorations = placeholderPluginKey.getState(this.editor.view.state)
            const found = decorations.find(null, null, spec => spec.id == id)

            return found.length ? found[0].from : null
        },
        startImageUpload(file) {
            const { tr } = this.editor.state

            // A fresh object to act as the ID for this upload
            const id = {}

            // Replace the selection with a placeholder
            if (!tr.selection.empty) {
                tr.deleteSelection()
            }

            this.editor.chain().focus().command(({ tr }) => {
                    tr.setMeta(placeholderPluginKey, { add: { id, position: tr.selection.from } })

                    return true
            }).run()

            this.uploadFile(file).then(url => {
                const position = this.findPlaceholder(id)

                // If the content around the placeholder has been deleted, drop the image
                if (position == null) {
                    return
                }

                // Otherwise, insert it at the placeholder's position, and remove the placeholder
                this.editor
                    .chain()
                    .insertContentAt({ from: position, to: position }, {
                        type: 'image',
                        attrs: {
                            src: url,
                        },
                    })
                    .command(({ tr }) => {
                        tr.setMeta(placeholderPluginKey, { remove: { id } })

                        return true
                    })
                    .run()
            }, () => {
                // On failure, just clean up the placeholder
                this.editor.chain().command(({ tr }) => {
                        tr.setMeta(placeholderPluginKey, { remove: { id } })

                        return true
                }).run()
            })
        },
        setLink() {
            if (this.editor.isActive('link')) {
                const url = window.prompt('URL', this.editor.getAttributes('link').href)

                this.editor.chain().extendMarkRange('link').updateAttributes('link', { href: url }).run()
            } else {
                const url = window.prompt('URL')

                this.editor.chain().focus().setLink({href: url.trim()}).run()
            }
        },
        init(element) {
            this.editor = new Editor({
                element: element,
                extensions: [
                    StarterKit,
                    Image.configure({
                        inline: true,
                    }),
                    placeholderPlugin,
                    Figure,
                    Link.configure({
                        openOnClick: false,
                    }),
                    Placeholder.configure({
                        placeholder: this.placeholder ?? 'Write something…',
                    }),
                ],
                editorProps: {
                    attributes: {
                        class: 'prose focus:outline-none max-w-full',
                        style: 'min-height: 8rem',
                    }
                },
                content: this.content,
                onUpdate: ({ editor }) => {
                    this.content = editor.getHTML()
                },
                onSelectionUpdate: () => {
                    this.updatedAt = Date.now()
                },
            })
        },
    }
}
