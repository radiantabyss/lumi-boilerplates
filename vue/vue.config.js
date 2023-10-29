const path = require('path');

module.exports = {
    runtimeCompiler: true,
    productionSourceMap: false,
    devServer: {
        host: 'lumi-vue-boilerplate'
    },
    configureWebpack: {
        resolve: {
            alias: {
                '@lumi': path.resolve(__dirname, 'node_modules/@radiantabyss/lumi-vue/src'),
            },
        },
    },
};
