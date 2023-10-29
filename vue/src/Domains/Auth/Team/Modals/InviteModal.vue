<script>
export default {
    name: 'InviteModal',
    data() {
        return {
            name: 'invite',
            fields: {
                role: Settings.allowed_team_roles[0],
            },
        }
    },
    methods: {
        submit(e) {
            let fields = {
                _event: e,
                ...this.fields,
            };

            Request.post(`/auth/team/invite/${this.$route.params.id}`, fields, true)
            .then(data => {
                Alert.show('Invites sent!', 'success');
                this.$emit('submit', data.invites);
                this.$modal.hide(this.name);
            });
        },
    }
}
</script>

<template>
<modal :name="name" classes="modal modal--small">
    <a @click="$modal.hide(name)" class="modal__close">
        <sprite id="x" class="small" />
    </a>

    <div class="modal__content">
        <div class="subtitle text-center">Invite Members</div>
        <div class="row">
            <label><div>Emails <i>separated by space or commas</i></div></label>
            <textarea class="input input--full" v-model="fields.emails" />
        </div>
        <div class="row">
            <label>Role</label>
            <select class="input input--full" v-model="fields.role">
                <option v-for="role in Settings.allowed_team_roles" :key="role" :value="role">
                    {{ role | ucwords }}
                </option>
            </select>
        </div>
        <div class="row row--nm row--submit mti-30">
            <button type="submit" @click.prevent="submit" class="btn btn--medium">Send Invites</button>
            <a @click="$modal.hide(name)"><sprite id="cancel" /> Cancel</a>
        </div>
    </div>
</modal>
</template>
