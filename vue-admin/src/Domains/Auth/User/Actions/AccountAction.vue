<script>
export default {
    metaInfo() {
        return {
            title: 'Account',
        }
    },
    data() {
        return {
            name: Auth.user.name,
            profile_image_path: Auth.user.meta.profile_image_path,

            current_password: '',
            password: '',

            teams: false,
        }
    },
    methods: {
        submit(e) {
            let fields = {
                _event: e,
                meta: {
                    name: this.name,
                    profile_image_path: this.profile_image_path,
                }
            };

            Request.post(`/auth/user/patch`, fields, true)
            .then(data => {
                this.$store.commit('Auth/SET', data.item);
                Alert.show('Changes saved!', 'success');
            });
        },

        submitChangePassword(e) {
            let fields = {
                _event: e,
                current_password: this.current_password,
                password: this.password,
            };

            Request.post(`/auth/user/patch`, fields, true)
            .then(() => {
                Alert.show('Password changed!', 'success');
            });
        },

        switchTeam(team_id) {
            Request.post(`/auth/team/switch/${team_id}`)
            .then(data => {
                this.$router.push('/dashboard');

                this.$store.dispatch('Auth/login', {
                    item: data.user,
                    jwt_token: data.jwt_token,
                });
            });
        },

        deleteTeam(e) {
            Request.get(`/auth/team/delete/${e.id}`)
            .then(data => {
                if ( data ) {
                    this.$store.dispatch('Auth/login', {
                        item: data.user,
                        jwt_token: data.jwt_token,
                    });
                }

                //update teams
                this.$store.commit('Auth/DELETE_TEAM', e.id);
            });
        },

        leaveTeam(e) {
            Request.get(`/auth/team/leave/${e.id}`)
            .then(data => {
                if ( data ) {
                    this.$store.dispatch('Auth/login', {
                        item: data.user,
                        jwt_token: data.jwt_token,
                    });
                }

                //update teams
                this.$store.commit('Auth/DELETE_TEAM', e.id);
            });
        },
    },
    mounted() {
        Request.get('/auth/team')
        .then(data => {
            this.teams = data.items;
        });
    },
}
</script>

<template>
<div v-if="Auth.user">
    <div class="page-title">
        <div>
            My Account
            <div class="crumbs">
                <router-link to="/"><sprite id="home" /></router-link>
                <sprite id="arrow-right" />
                <span>My Account</span>
            </div>
        </div>
    </div>

    <div class="grid">
        <form class="panel col-50">
            <div class="subtitle">Account Details</div>

            <div class="row">
                <label>Email</label>
                <input type="text" class="input" readonly :value="Auth.user.email" />
            </div>
            <div class="row">
                <label>Name</label>
                <input type="text" class="input" v-model="name" />
            </div>
            <div class="row">
                <label>Profile Image</label>
                <image-upload v-model="profile_image_path" path="/auth/user/upload-profile-image" />
            </div>
            <div class="row row--submit mti-30">
                <button type="submit" @click.prevent="submit" class="btn btn--medium">Save Changes</button>
            </div>
        </form>

        <form class="panel col-50">
            <div class="subtitle">Change Password</div>

            <div class="row">
                <label>Current Password</label>
                <password v-model="current_password" />
            </div>
            <div class="row">
                <label>New Password</label>
                <password v-model="password" />
            </div>
            <div class="row row--submit">
                <button type="submit" @click.prevent="submitChangePassword" class="btn btn--medium">Change Password</button>
            </div>
        </form>

        <div class="panel pbi-20 col-50">
            <div class="subtitle flex space-between">
                Teams
                <router-link to="/auth/team/new" class="btn btn--auto btn--small">
                    <sprite id="plus" /> New Team
                </router-link>
            </div>

            <template v-if="teams !== false">
                <table class="table" v-if="teams.length">
                    <thead>
                        <tr>
                            <th style="width: 40px;"></th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Joined on</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="team in teams" :key="team.id">
                            <td>
                                <miniburger>
                                    <a @click="switchTeam(team.id)" v-if="team.id != Auth.user.team.id">
                                        <sprite id="goto" /> Go To Team
                                    </a>
                                    <template v-if="Gate.allows('manage-team', team)">
                                        <router-link :to="`/auth/team/edit/${team.id}`">
                                            <sprite id="edit" /> Edit
                                        </router-link>
                                        <a @click="$modal.show('confirm-delete-team', { id: team.id })" class="color-red">
                                            <sprite id="trash" /> Delete
                                        </a>
                                    </template>

                                    <a @click="$modal.show('confirm-leave-team', { id: team.id })" class="color-red" v-if="Gate.denies('owns-team', team)">
                                        <sprite id="x" /> Leave
                                    </a>
                                </miniburger>
                            </td>
                            <td class="menu-links__teams">
                                <div class="menu-links__team">
                                    <div><img :src="uploads_url + team.meta.image_path" v-if="team.meta.image_path" /></div>
                                    {{ team.name }}
                                </div>
                            </td>
                            <td>{{ team.role | ucwords }}</td>
                            <td :title="Str.prettify_datetime(team.joined_at)">{{ team.joined_at | time_from_now }}</td>
                        </tr>
                    </tbody>
                </table>
                <template v-else>
                    You aren't in any teams.
                </template>
            </template>
        </div>
    </div>

    <confirm-modal type="delete-team" deleteText="Delete Team"
        question="Are you sure you want to delete this team?"
        text="Warning! Connected Social Accounts, Objects, Stats and Rules will also be deleted. This is permanent."
        @confirm="deleteTeam"
    />

    <confirm-modal type="leave-team" deleteText="Leave Team"
        question="Are you sure you want to leave this team?"
        @confirm="leaveTeam"
    />
</div>
</template>
