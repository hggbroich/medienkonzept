const Encore = require('@symfony/webpack-encore');
const GlobImporter = require('node-sass-glob-importer');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    .addEntry('app', './assets/js/app.js')

    .disableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())

    .enableSassLoader(function(options) {
        options.sassOptions.importer = GlobImporter();
    })
    .enablePostCssLoader()
    .enableVersioning(Encore.isProduction())

    .addLoader(
        {
            test: /bootstrap\.native/,
            use: {
                loader: 'bootstrap.native-loader'
            }
        }
    )
;

module.exports = Encore.getWebpackConfig();
