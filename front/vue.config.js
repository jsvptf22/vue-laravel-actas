module.exports = {
    publicPath: './',
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
        }
    }
};
