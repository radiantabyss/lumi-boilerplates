<script>
import InviteModal from './../Modals/InviteModal';

export default {
    name: 'Members',
    props: {
        team: {
            type: Object,
            required: true,
        },
    },
    components: { InviteModal },
    data() {
        return {
            items: false,
            total: false,
            pages: false,
            invites: false,
        }
    },
    methods: {
        changeRole(id, e) {
            Request.post(`/auth/team/change-role`, {
                id,
                role: e.target.value,
                team_id: this.$route.params.id,
            }, true);
        },

        deleteItem(e) {
            Request.get(`/auth/team/delete-member/${e.id}`)
            .then(() => {
                this.items = Items.delete(this.items, e.id);
            });
        },

        deleteInvite(id) {
            Request.get(`/auth/team/delete-invite/${id}`)
            .then(() => {
                this.invites = Items.delete(this.invites, id);
            });
        },

        resendInvite(id) {
            Request.post(`/auth/team/resend-invite/${id}`)
            .then(data => {
                Alert.show('Invite resent!', 'success');
                this.invites = Items.replace(this.invites, data.invite);
            });
        },

        invitesSubmit(invites) {
            this.invites = Items.addMany(this.invites || [], invites);
        },
    },
    mounted() {
        Request.get(`/auth/team/list-members/${this.$route.params.id}`)
        .then(data => {
            this.items = data.items;
            this.total = data.total;
            this.pages = data.pages;
            this.invites = data.invites;
        });
    },
}
</script>

<template>

<div class="grid mt-20 mb-40">
    <div class="panel col-50">
        <div class="subtitle flex space-between">
            Members
            <a @click="$modal.show('invite')" class="btn btn--small btn--auto btn--icon-nm">
                <sprite id="plus"/> Invite Members
            </a>
        </div>

        <template v-if="items !== false">
            <template v-if="items.length">
                <pagination :url="`/auth/team/list-members/${$route.params.id}`" :pages="pages" :count="items.length" :total="total" />
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 40px;"></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in items" :key="item.id">
                            <td>
                                <miniburger v-if="Gate.allows('manage-team', team)">
                                    <a @click="$modal.show('confirm-delete', { id: item.id })" class="color-red" v-if="item.role != 'owner'">
                                        <sprite id="trash" class="icon-link-small" /> Delete
                                    </a>
                                </miniburger>
                            </td>
                            <td>{{ item.user.name }}</td>
                            <td>{{ item.user.email }}</td>
                            <td>
                                <span v-if="item.role == 'owner'">Owner</span>
                                <select class="input input--auto" @change="changeRole(item.id, $event)" v-else>
                                    <option v-for="role in Settings.allowed_team_roles" :key="role" :value="role" :selected="role == item.role">
                                        {{ role | ucwords }}
                                    </option>
                                </select>
                            </td>
                            <td :title="Str.prettify_datetime(item.created_at)">{{ item.created_at | time_from_now }}</td>
                        </tr>
                    </tbody>
                </table>
            </template>
            <template v-else>
                No {{ $route.params.type | plural }} found.
            </template>
        </template>

        <div class="row mti-40" v-if="invites && invites.length">
            <div class="subtitle">Invites</div>

            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 40px;"></th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Expires</th>
                        <th style="width: 40px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="invite in invites" :key="invite.id">
                        <td>
                            <a @click="deleteInvite(invite.id)" class="color-red" title="Delete Invite">
                                <sprite id="trash" class="icon-link-small" />
                            </a>
                        </td>
                        <td>{{ invite.email }}</td>
                        <td>{{ invite.role | ucwords }}</td>
                        <td :title="Str.prettify_datetime(invite.expires_at)">{{ invite.expires_at | time_from_now }}</td>
                        <td>
                            <a @click="resendInvite(invite.id)" title="Resend Invite">
                                <sprite id="resend" class="icon-link-small" />
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <confirm-modal type="delete" deleteText="Delete Team Member"
        question="Are you sure you want to delete this team member?"
        @confirm="deleteItem"
    />

    <InviteModal />
</div>
</template>
