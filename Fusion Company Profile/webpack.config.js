const path = require('path')

module.exports = {
    module: {
        noParse: /jquery|lodash/,
    },
    resolve: {
        alias: {
            // '@': path.resolve(__dirname, 'resources/js/vue'),
            // "@stimulsoft": path.resolve(__dirname, 'public/vendor/core/stimulsoft'),
        },
    },
}
