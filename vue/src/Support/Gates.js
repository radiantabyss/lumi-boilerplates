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

        Gate.define('manage-object', (object) => {
            if (Auth.user.type == 'super_admin' ) {
                return true;
            }

            //if the user doesn't have a set list of ad accounts he can manage then he can access everything
            if ( !Auth.user.meta.managed_ad_account_ids ) {
                return true;
            }

            return Auth.user.meta.managed_ad_account_ids.includes(object.type == 'ad_account' ? object.id : object.ad_account_id);
        });

        Gate.define('manage-rule', (rule) => {
            if (Auth.user.type == 'super_admin' ) {
                return true;
            }

            //members can only manage their own rules
            if ( Auth.user.team.role != 'owner' && rule.created_by != Auth.user.id  ) {
                return false;
            }

            return true;
        });
    },
};

export default self;
