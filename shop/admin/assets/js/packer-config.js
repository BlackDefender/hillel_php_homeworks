// patches are relative to packer.js file
exports.config = {
    bundlePath: 'bundle.js',
    libs: [
        /*'./sources/jquery.min.js',
        './sources/jquery.form.min.js',
        './sources/jquery.maskedinput.min.js'*/
    ],
    app: [
        './sources/app.js',
        './sources/pages'
    ],
    wrapIntoContentLoadedEvent: true,
    watcher:{
        path: './sources',
        delay: 200
    }
};