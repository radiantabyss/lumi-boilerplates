let self = {
    register() {
        Gate.define('super-admin-only', () => {
            return Auth.user.type == 'super_admin' ? true : false;
        });

        Gate.define('admin-only', () => {
            return ['admin', 'super_admin'].includes(Auth.user.type);
        });

        Gate.define('owns-team', (team) => {
            return team.role == 'owner';
        });

        Gate.define('manage-team', (team) => {
            return ['owner', 'admin'].includes(team.role);
        });
    },
};

export default self;
