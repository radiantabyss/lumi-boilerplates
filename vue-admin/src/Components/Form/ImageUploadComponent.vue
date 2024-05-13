<script>
import Dropzone from "dropzone";

export default {
    name: 'ImageUploadComponent',
    props: {
        value: {
            type: String,
            required: false,
            default: '',
        },
        path: {
            type: String,
            required: true,
        },
        text: {
            type: String,
            required: false,
            default: 'Upload Image',
        },
    },
    data() {
        return {
            dz: null,
            inited: false,
            loading: false,
        }
    },
    methods: {
        remove() {
            this.$emit('input', '');

            if ( this.dz.files.length ) {
                this.dz.removeFile(this.dz.files[0]);
            }
        },
    },
    mounted() {
        if ( this.inited || !this.$refs.dropzone ) {
            return;
        }

        this.inited = true;

        this.dz = new Dropzone(this.$refs.dropzone, {
            url: `${back_url}${this.path}?jwt_token=${StorageHandler.getItem('jwt_token')}`,
            thumbnailWidth: 150,
            maxFiles: 1,
            maxFilesize: 5,
            previewsContainer: '.dropzone-preview',
        });

        this.dz.on('addedfile', () => {
            this.loading = true;
        });

        this.dz.on('complete', () => {
            this.loading = false;
        });

        this.dz.on('success', (e, response) => {
            this.$emit('input', response.data.path);
        });

        this.dz.on('error', (e, response) => {
            if ( response.errors ) {
                Alert.show(response.errors.join('<br/>'), 'error');
            }
            else if ( typeof response === 'string') {
                Alert.show(response, 'error');
            }
        });
    }
}
</script>

<template>
<div class="image-upload" :class="loading ? 'image-upload--loading' : ''">
    <div class="dropzone-preview"></div>

    <div class="image-upload__upload" ref="dropzone">
        <div class="image-upload__image">
            <img :src="uploads_url + value" v-if="value" />
            <sprite id="image" v-else />
        </div>

        <div class="image-upload__text" v-show="!value">
            {{ text }}
        </div>
    </div>

    <a @click="remove" class="image-upload__remove" v-show="value">
        <sprite id="x" /> Remove
    </a>

    <div class="image-upload__loading" v-if="loading">
        <sprite id="request-spinner" />
    </div>
</div>
</template>
