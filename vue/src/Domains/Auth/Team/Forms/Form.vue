<script>
export default {
    name: 'Form',
    props: {
        item: {
            type: Object,
            required: false,
            default: null,
        }
    },
    data() {
        let fields = {
            meta: {},
        };

        if ( this.item && Object.keys(this.item).length ) {
            fields = {...fields, ...this.item};
        }

        return {
            fields,
        }
    },
    methods: {
        submit(e) {
            this.$emit('submit', {
                _event: e,
                ...this.fields,
            });
        },
    },
    mounted() {
        setTimeout(() => {
            document.getElementsByTagName('input')[0].focus();
        }, 150);
    },
}
</script>

<template>
<form>
    <div class="grid mb-20">
        <div class="panel col-50">
            <div class="row">
                <label>Name</label>
                <input type="text" class="input" v-model="fields.name" />
            </div>

            <div class="row">
                <label>Logo</label>
                <image-upload v-model="fields.meta.image_path" path="/auth/team/upload-image" />
            </div>
        </div>

        <div class="panel col-50">
            <div class="subtitle">Facebook Settings</div>
            <div class="grid">
                <div class="row col-50 col-m100">
                    <label>App ID</label>
                    <input type="text" class="input" v-model="fields.meta.facebook_app_id" />
                </div>
                <div class="row col-50 col-m100">
                    <label>App Secret</label>
                    <input type="text" class="input" v-model="fields.meta.facebook_app_secret" />
                </div>
                <div class="row col-50 col-m100">
                    <label>App Token</label>
                    <input type="text" class="input" v-model="fields.meta.facebook_app_token" />
                </div>
                <div class="row col-50 col-m100">
                    <label>API Version</label>
                    <input type="text" class="input" v-model="fields.meta.facebook_api_version" />
                </div>
            </div>
        </div>

        <div class="panel col-50">
            <div class="subtitle">TikTok Settings</div>
            <div class="grid">
                <div class="row col-50 col-m100">
                    <label>App ID</label>
                    <input type="text" class="input" v-model="fields.meta.tiktok_app_id" />
                </div>
                <div class="row col-50 col-m100">
                    <label>App Secret</label>
                    <input type="text" class="input" v-model="fields.meta.tiktok_app_secret" />
                </div>
                <div class="row col-50 col-m100">
                    <label>API Version</label>
                    <input type="text" class="input" v-model="fields.meta.tiktok_api_version" />
                </div>
            </div>
        </div>

        <div class="panel col-50">
            <div class="subtitle">Tracker Settings</div>
            <div class="grid">
                <div class="row col-50 col-m100">
                    <label>Tracker</label>
                    <select class="input" v-model="fields.meta.tracker">
                        <option :value="tracker" v-for="tracker in Settings.trackers" :key="tracker">
                            {{ tracker | ucwords }}
                        </option>
                    </select>
                </div>
                <div class="row col-50 col-m100">
                    <label>Tracker URL</label>
                    <input type="text" class="input" v-model="fields.meta.tracker_url" />
                </div>
                <div class="row col-50 col-m100">
                    <label>Tracker Key</label>
                    <input type="text" class="input" v-model="fields.meta.tracker_key" />
                </div>
            </div>
        </div>
    </div>

    <div class="grid">
        <div class="panel panel--rows col-50">
            <div class="row row--submit">
                <button type="submit" @click.prevent="submit" class="btn btn--medium">Save</button>
                <router-link to="/auth/account"><sprite id="cancel" /> Cancel</router-link>
            </div>
        </div>
    </div>
</form>
</template>
