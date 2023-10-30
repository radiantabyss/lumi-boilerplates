import Store from '@lumi/Store';

export default {
    Auth: Store.state.Auth,
    app_url: process.env.VUE_APP_URL,
    back_url: process.env.VUE_APP_BACK_URL,
    uploads_url: process.env.VUE_APP_UPLOADS_URL,

    is_dev: process.env.NODE_ENV == 'development',
    is_local: process.env.VUE_APP_ENV == 'local',
    is_production: process.env.VUE_APP_ENV == 'production',
}
