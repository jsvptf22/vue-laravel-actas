module.exports = {
    pages: {
        index: {
            // entry for the page
            entry: 'src/entries/home.js',
            // the source template
            template: 'public/index.html',
            // output as dist/index.html
            filename: 'index.html'
        },
        home: {
            // entry for the page
            entry: 'src/entries/home.js',
            // the source template
            template: 'public/index.html',
            // output as dist/index.html
            filename: 'index.html'
        },
        approve: {
            // entry for the page
            entry: 'src/entries/approve.js',
            // the source template
            template: 'public/index.html',
            // output as dist/index.html
            filename: 'approve.html',
            // when using title option,
            // template title tag needs to be <title><%= htmlWebpackPlugin.options.title %></title>
            title: 'Aprobación'
            // chunks to include on this page, by default includes
            // extracted common chunks and vendor chunks.
            // chunks: ['chunk-vendors', 'chunk-common', 'expedientes']
        }
    }
};
