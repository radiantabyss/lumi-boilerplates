<script>
import tinymce from 'tinymce/tinymce';
import 'tinymce/themes/silver/theme';
import 'tinymce/plugins/advlist';
import 'tinymce/plugins/autolink';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/link';
import 'tinymce/plugins/code';
import 'tinymce/plugins/paste';
import 'tinymce/plugins/hr';
import 'tinymce/plugins/image';
import 'tinymce/icons/default/icons';

export default {
    props: {
        value: {
            type: [String, Number],
            required: false,
            default: '',
        },
    },
    data() {
        return {
            term: this.value,
            timeout: null,
        }
    },
    methods: {
        updateContent(editor) {
            clearTimeout(this.timeout);

            this.timeout = setTimeout(() => {
                this.$emit('input', editor.getContent());
            }, 200);
        },
    },
    mounted() {
        tinymce.init({
            skin: "oxide-dark",
            content_css: "dark",
            skin_url: '/tinymce/skins/ui/oxide-dark',
            branding: false,
            selector: '[data-tinymce]',
            width: '100%',
            height: '400px',
            resize: "both",
            plugins: [
                "advlist autolink lists link code paste hr image",
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link hr | insertfile image",
            content_style: 'body { font-family: \'Montserrat\'}',
            inline_boundaries: false,
            relative_urls: true,
            remove_script_host: false,
            automatic_uploads: true,

            // Handle image uploads
            images_upload_handler: function (blobInfo, success, failure) {
                // Use FileReader to convert image into base64 string
                var reader = new FileReader();
                reader.onload = function(e) {
                    success(e.target.result);  // Call success with base64 string result
                };
                reader.onerror = function() {
                    failure('Image conversion failed. Please try again.');
                };
                reader.readAsDataURL(blobInfo.blob());  // Convert the image to a data URL
            },

            setup: editor => {
                editor.on('Change', () => {
                    this.updateContent(editor);
                });
                editor.on('keyup', () => {
                    this.updateContent(editor);
                });
            },
        });
    }
}
</script>

<template>
<textarea data-tinymce data-gramm_editor="false" spellcheck="false">{{ this.value }}</textarea>
</template>
