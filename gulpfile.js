'use strict';

//импортируем все наши плагины и сам gulp
var gulp = require('gulp'),
    watch = require('gulp-watch'),
    prefixer = require('gulp-autoprefixer'),
    uglify = require('gulp-uglify'),
    sass = require('gulp-sass'),
    rename = require('gulp-rename'),
    sourcemaps = require('gulp-sourcemaps'),
    rigger = require('gulp-rigger'),
    cssmin = require('gulp-clean-css'),
    imagemin = require('gulp-imagemin'),
    pngquant = require('imagemin-pngquant'),
    rimraf = require('rimraf'),
    plumber = require( 'gulp-plumber' ),
    browserSync = require("browser-sync"),
    notify = require( 'gulp-notify' ),
    critical = require('critical'),
    jshint = require('gulp-jshint'),
    reload = browserSync.reload;

//все нужные нам пути, чтобы при необходимости легко в одном месте их редактировать
var path = {
    build: { //Тут мы укажем куда складывать готовые после сборки файлы
        html: 'build/',
        js: 'build/js/',
        css: 'build/css/',
        img: 'build/img/',
        fonts: 'build/fonts/'
    },
    src: { //Пути откуда брать исходники
        html: 'src/*.html', //Синтаксис src/*.html говорит gulp что мы хотим взять все файлы с расширением .html
        js: 'src/js/main.js',//В стилях и скриптах нам понадобятся только main файлы
        appjs: 'src/js/custom/app.js',//work file for custom js
        style: 'src/style/main.scss',
        img: 'src/img/**/*.*', //Синтаксис img/**/*.* означает - взять все файлы всех расширений из папки и из вложенных каталогов
        fonts: 'src/fonts/**/*.*'
    },
    watch: { //Тут мы укажем, за изменением каких файлов мы хотим наблюдать
        html: 'src/**/*.html',
        js: 'src/js/**/*.js',
        style: 'src/style/**/*.scss',
        img: 'src/img/**/*.*',
        fonts: 'src/fonts/**/*.*',
        php: './**/*.php'
    },
    home:{
        style: './'
    },
    clean: './build'
};

//Создадим переменную с настройками нашего dev сервера:
var config = {
    server: {
        baseDir: "./build"
    },
    tunnel: true,
    host: 'localhost',
    port: 9000,
    logPrefix: "Frontend_Devil",
    bowerDir: 'bower_components'
};

// see: https://www.browsersync.io/docs/options/
var browserSyncOptions = {
    watchTask: true,
    proxy: "http://sp:8888/"
}

//таск для сборки html
gulp.task('html:build', function () {
    gulp.src(path.src.html) //Выберем файлы по нужному пути
        .pipe(rigger()) //Прогоним через rigger
        .pipe(gulp.dest(path.build.html)) //Выплюнем их в папку build
        .pipe(reload({stream: true})) //И перезагрузим наш сервер для обновлений
        .pipe(notify({ title: 'HTML', message: 'html:build task complete' }));
});

//Таск по сборке скриптов

/*
с помощью rigger'a инклюдить в него все нужные нам js файлы в нужном нам порядке. ' +
'Именно ради контроля над порядком подключения — я и делаю это именно так, ' +
'вместо того что бы попросить gulp найти все *.js файлы и склеить их.
*/

gulp.task('js:build', function () {
    gulp.src(path.src.js) //Найдем наш main файл
        .pipe(rigger()) //Прогоним через rigger
        .pipe(sourcemaps.init()) //Инициализируем sourcemap
        //.pipe(jshint())
        //.pipe(jshint.reporter('fail'))
        .pipe(uglify()) //Сожмем наш js
        // Rename main.js file to main.min.
        .pipe(rename({basename: 'main.min'}))
        .pipe(sourcemaps.write('/maps')) //Пропишем карты
        .pipe(gulp.dest(path.build.js)) //Выплюнем готовый файл в build
        .pipe(reload({stream: true})) //И перезагрузим сервер
        .pipe(notify({ title: 'JS', message: 'js:build task complete' }));
});

//Check main js code
gulp.task('js:check', function () {
    gulp.src(path.src.appjs) //Найдем наш work file файл
        .pipe(jshint())
        .pipe(jshint.reporter('jshint-stylish'))
        .pipe(jshint.reporter('fail'))
        .pipe(reload({stream: true}))
        .pipe(notify({ title: 'JS', message: 'js:check task complete' }))
    ;
});


// Different options for the Sass tasks
var options = {};
options.sass = {
    errLogToConsole: true,
    precision: 8,
    noCache: true,
    //imagePath: 'assets/img',
    includePaths: [
        config.bowerDir + '/bootstrap/scss',
    ]
};

options.sassmin = {
    errLogToConsole: true,
    precision: 8,
    noCache: true,
    outputStyle: 'compressed',
    //imagePath: 'assets/img',
    includePaths: [
        config.bowerDir + '/bootstrap/scss',
    ]
};

// Sass
gulp.task('sass', function() {
    gulp.src(path.src.style) //Выберем наш main.scss
        .pipe(plumber())
        .pipe(sass(options.sass).on('error', sass.logError))
        .pipe(prefixer())
        // Rename main.scss file to style.css.
        .pipe(rename({basename: 'style'}))
        .pipe(gulp.dest(path.home.style)) //theme_dir
        .pipe(browserSync.reload({stream: true}))
        .pipe(notify({ title: 'Sass', message: 'sass task complete'  }));
});

// Sass-min - Release build minifies CSS after compiling Sass
gulp.task('sass-min', function() {
    gulp.src(path.src.style) //Выберем наш main.scss
        .pipe(plumber())
        .pipe(sass(options.sassmin).on('error', sass.logError))
        .pipe(prefixer())
        // Rename main.scss file to style.css.
        .pipe(rename( {basename: 'style'}, { suffix: '.min' } ) )
        .pipe(gulp.dest(path.home.style)) //theme_dir
        .pipe(browserSync.reload({stream: true}))
        .pipe(notify({ title: 'Sass', message: 'sass-min task complete' }));
});

//для сборки нашего SCSS
gulp.task('style:build', function () {
    gulp.src(path.src.style) //Выберем наш main.scss
        .pipe(plumber())
        .pipe(sourcemaps.init()) //То же самое что и с js
        .pipe(sass(options.sassmin).on('error', sass.logError)) //Скомпилируем
        .pipe(prefixer()) //Добавим вендорные префиксы
        .pipe(cssmin()) //Сожмем
        // Rename main.scss file to style.css.
        .pipe(rename({basename: 'style'}))
        .pipe(sourcemaps.write('/maps'))
        .pipe(gulp.dest(path.home.style)) //theme_dir
        .pipe(reload({stream: true}))
        .pipe(notify({ title: 'Sass', message: 'style:build task complete' }));
});

//Таск по картинкам
gulp.task('image:build', function () {
    gulp.src(path.src.img) //Выберем наши картинки
        .pipe(imagemin({ //Сожмем их
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()],
            interlaced: true
        }))
        .pipe(gulp.dest(path.build.img)) //И бросим в build
        .pipe(reload({stream: true}))
        .pipe(notify({ title: 'IMAGE', message: 'image:build task complete' }))
    ;
});


// Generate & Inline Critical-path CSS
gulp.task('critical', function (cb) {
    critical.generate({
        base: './',
        src: 'http://sp:8888/',
        dest: path.home.style + 'css/home.min.css',
        ignore: ['@font-face'],
        dimensions: [{
            width: 320,
            height: 480
        },{
            width: 768,
            height: 1024
        },{
            width: 1280,
            height: 960
        }],
        minify: true
    });
});


//Шрифты
gulp.task('fonts:build', function() {
    gulp.src(path.src.fonts)
        .pipe(gulp.dest(path.build.fonts))
});


//gulp каждый раз при изменении какого то файла запускать нужную задачу.
//gulp watch

gulp.task('watch', function(){
    watch([path.watch.html], function(event, cb) {
        gulp.start('html:build');
    });
    watch([path.watch.style], function(event, cb) {
        gulp.start('style:build');
    });
    watch([path.watch.js], function(event, cb) {
        gulp.start('js:check');
        gulp.start('js:build');
    });
    watch([path.watch.img], function(event, cb) {
        gulp.start('image:build');
    });
    watch([path.watch.fonts], function(event, cb) {
        gulp.start('fonts:build');
    });
});



// определим таск с именем «build», который будет запускать все

gulp.task('build', [
    'html:build',
    'js:build',
    'style:build',
    'fonts:build',
    'image:build'
]);

//локальный веб-сервер

/*К тому же gulp вежливо откроет наш проект в браузере,
    а в консоль напишет ссылки на локальный сервер,
    и на тунель, который мы можем скинуть
заказчику для демонстрации.*/

gulp.task('webserver', function () {
    browserSync(config);
});

//Очистка

//gulp clean = будет удаляться папка build.

gulp.task('clean', function (cb) {
    rimraf(path.clean, cb);
});

//определим дефолтный таск, который будет запускать всю нашу сборку.

// gulp

gulp.task('default', ['build', 'webserver', 'watch']);