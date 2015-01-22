module.exports = function( gulp ){

    /**
     * Return full path on the file system.
     * @param _path
     * @returns {string}
     */
    function _packagePath(_path){
        return __dirname + '/' + _path;
    }

    var utils   = require('gulp-util'),
        concat  = require('gulp-concat'),
        uglify  = require('gulp-uglify'),
        less    = require('gulp-less'),
        jshint  = require('gulp-jshint');
//        livereload = require('gulp-livereload');


    var sourcePaths = {
        less: {
            core: _packagePath('themes/focalize/css/build/_core.less')
            //,app: _packagePath('themes/focalize/css/theme.less')
        },
        js: {
            core: [
                //_packagePath('bower_components/fastclick/lib/fastclick.js'),
//                _packagePath('bower_components/angular/angular.js'),
//                _packagePath('bower_components/angular-resource/angular-resource.js'),
//                _packagePath('bower_components/angular-route/angular-route.js'),
//                //_packagePath('bower_components/angular-animate/angular-animate.js'),
//                _packagePath('bower_components/gsap/src/uncompressed/TweenMax.js'),
//                _packagePath('bower_components/gsap/src/uncompressed/TimelineMax.js'),
//                _packagePath('bower_components/gsap/src/uncompressed/easing/EasePack.js'),
//                _packagePath('bower_components/gsap/src/uncompressed/plugins/CSSPlugin.js'),
//                _packagePath('bower_components/gsap/src/uncompressed/plugins/ScrollToPlugin.js'),
//                _packagePath('js/3rd_party/*.js')
            ],
            app: [
                _packagePath('themes/focalize/js/build/**/*.js')
            ]
        }
    };


    /**
     * Sass compilation
     * @param _style
     * @returns {*|pipe|pipe}
     */
    function runLess( files, _compress ){
        return gulp.src(files)
            .pipe(less({
                compress: (_compress === true)
            }))
            .on('error', function( err ){
                utils.log(utils.colors.red(err.message));
                this.emit('end');
            })
            .pipe(gulp.dest(_packagePath('themes/focalize/css/')));
    }


    /**
     * Javascript builds (concat, optionally minify)
     * @param files
     * @param fileName
     * @param minify
     * @returns {*|pipe|pipe}
     */
    function runJs( files, fileName, minify ){
        return gulp.src(files)
            .pipe(concat(fileName))
            .pipe(minify === true ? uglify() : utils.noop())
            .pipe(gulp.dest(_packagePath('themes/focalize/js/')));
    }


    /**
     * JS-Linter using JSHint library
     * @param files
     * @returns {*|pipe|pipe}
     */
    function runJsHint( files ){
        return gulp.src(files)
            .pipe(jshint(_packagePath('.jshintrc')))
            .pipe(jshint.reporter('jshint-stylish'));
    }


    /**
     * Individual tasks
     */
    gulp.task('less:core:dev', function(){ return runLess(sourcePaths.less.core); });
    gulp.task('less:core:prod', function(){ return runLess(sourcePaths.less.core, true); });
    //gulp.task('less:app:dev', function(){ return runLess(sourcePaths.less.app); });
    //gulp.task('less:app:prod', function(){ return runLess(sourcePaths.less.app, true); });
    gulp.task('jshint', function(){ return runJsHint(sourcePaths.js.app); });
    gulp.task('js:core:dev', function(){ return runJs(sourcePaths.js.core, 'core.js') });
    gulp.task('js:core:prod', function(){ return runJs(sourcePaths.js.core, 'core.js', true) });
    gulp.task('js:app:dev', ['jshint'], function(){ return runJs(sourcePaths.js.app, 'theme.js') });
    gulp.task('js:app:prod', ['jshint'], function(){ return runJs(sourcePaths.js.app, 'theme.js', true) });


    /**
     * Grouped tasks (by environment target)
     */
    gulp.task('build:dev', ['less:core:dev', 'js:core:dev', 'js:app:dev'], function(){
        utils.log(utils.colors.bgGreen('Dev build OK'));
    });

    gulp.task('build:prod', ['less:core:prod', 'js:core:prod', 'js:app:prod'], function(){
        utils.log(utils.colors.bgGreen('Prod build OK'));
    });


    /**
     * Watch tasks
     */
    gulp.task('watch', function(){
        //livereload.listen();
        gulp.watch(_packagePath('themes/focalize/css/build/**/*.less'), {interval:1000}, ['less:core:dev']);
        gulp.watch(_packagePath('themes/focalize/js/build/**/*.js'), {interval:1000}, ['js:app:dev']);

        // Livereload only on *.css (NOT .scss) file changes!
//        gulp.watch(_packagePath('css/*.css')).on('change', function(file){
//            livereload.changed(file.path);
//        });
    });

};