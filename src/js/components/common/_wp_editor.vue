<template>
    <div class="wp_vue_editor_wrapper" :class="'editor_wrapper_'+ninja_editor_id">

        <template v-if="hasWpEditor">
            <textarea class="wp_vue_editor" :id="ninja_editor_id" v-model="plain_content"></textarea>
        </template>

        <template v-else>
            <textarea
                class="wp_vue_editor wp_vue_editor_plain"
                v-model="plain_content"></textarea>
        </template>
    </div>
</template>

<script>
export default {
    name: 'wp_editor',
    props: {
        value: {
            type: String,
            default() {
                return '';
            }
        },
        editor_id: {
            type: String,
            default() {
                return 'wp_editor_' + Date.now();
            }
        }
    },
    data() {
        return {
            hasWpEditor: !!window.wp.editor
        }
    },
    computed: {
        plain_content: {
            get() {
                return this.value
            },
            set(newValue) {
                this.$emit('input', newValue)
            }
        },
        ninja_editor_id() {
            return 'ninja_editor_' + this.slugify(this.editor_id)
        }
    },
    methods: {
        initEditor() {
            if(this.hasWpEditor) {
                wp.editor.remove(this.ninja_editor_id)
                const that = this;
                wp.editor.initialize(this.ninja_editor_id, {
                        mode : "none",
                        tinymce: {
                            toolbar1: 'bold,italic,bullist,numlist,link,blockquote,alignleft,aligncenter,alignright,strikethrough,forecolor,codeformat,undo,redo',
                            setup(ed) {
                                ed.on('change', (ed, l) => {
                                    that.changeContentEvent();
                                });
                            }
                        },
                        quicktags: true
                });
                jQuery("#" + this.ninja_editor_id).on('change', function(e) {
                    this.changeContentEvent();
                });
            }
        },
        slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        },
        reloadEditor() {
            wp.editor.remove(this.ninja_editor_id);
            jQuery('#' + this.ninja_editor_id).val('');
            this.initEditor();
        },
        changeContentEvent() {
            let content = wp.editor.getContent(this.ninja_editor_id);
            this.$emit('input', content)
        },
        okSave() {
            console.log(this.plain_content)
        }
    },
    created() {
        this.initEditor();
        jQuery('.editor_wrapper' + this.ninja_editor_id + '.ninja_demo_media_button').on('click', function(e) {
            e.preventDefault();
        })
    },
    watch: {
        value() {
            if(!this.value) {
                this.reloadEditor();
            }
        }
    }
}
</script>

<style lang="scss">
    .wp_vue_editor {
        width: 100%;
        min-height: 100px;
    }

    .wp_vue_editor_wrapper {
        position: relative;

        .popover-wrapper {
            z-index: 2;
            position: absolute;
            top: 0;
            left: 0;

            &-plaintext {
                left: auto;
                right: 0;
                top: -32px;
            }
        }
    }
</style>
