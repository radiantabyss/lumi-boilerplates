import Store from '@lumi/Store';

export default function() {
    return new Promise((resolve) => {
        //check if user was already set
        if ( Store.state.Auth.user !== false ) {
            return resolve();
        }

        //check if jwt token exists
        if ( !localStorage.getItem('jwt_token') ) {
            Store.commit('Auth/SET', null);
            return resolve();
        }

        //try to get user
        Request.get('/auth/user/get')
        .then(data => {
            Store.dispatch('Auth/login', data);
            resolve();
        })
        .catch(() => {
            //jwt token is invalid, remove it
            localStorage.removeItem('jwt_token');
            Store.commit('Auth/SET', null);
            resolve();
        });
    });
}
