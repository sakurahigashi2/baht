// 必要パッケージ定義
const gulp = require('gulp');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const plumber = require('gulp-plumber');
const notify = require('gulp-notify');
const cleanCSS = require('gulp-clean-css');
const postcss = require('gulp-postcss');
const postcssPresetEnv = require('postcss-preset-env');
const postcssNested = require('postcss-nested');
const postcssCustomMedia = require("postcss-custom-media")
const atImport = require('postcss-import');

// gulp-postcssのプラグイン設定
const postcssPlugins = [
  atImport,
  postcssNested(),
  postcssCustomMedia(),
  postcssPresetEnv({
    browsers: 'last 2 versions'
  }),
];

// postCSS出入力パス指定
const postcss_paths = {
  'src': 'css/**/*.css',
  'dist': '../assets/css'
};

// JS出入パス指定
const js_paths = {
  'src': 'js/**/*.js',
  'dist': '../assets/js'
};

// postcssをCSSに変換用gulpタスク設定
gulp.task('postcssToCss', ()=>{
  gulp.src(postcss_paths.src)
    .pipe(plumber({errorHandler: notify.onError('<%= error.message %>')}))
    .pipe(postcss(postcssPlugins))
    .pipe(cleanCSS())
    .pipe(gulp.dest(postcss_paths.dist));
});

// JSをコンパイル
gulp.task('jsCompile', function() {
  gulp.src(js_paths.src)
    .pipe(plumber({errorHandler: notify.onError('<%= error.message %>')}))
    .pipe(babel({
      presets: [
        ['env', {
          'targets': {
            'browsers': ['last 2 versions']
          }
        }]
      ]
    }))
    .pipe(uglify({compress: true}))
    .pipe(gulp.dest(js_paths.dist));
});

// 全てのassets変換用gulpタスク設定
gulp.task('allSetAssets', ()=>{
  gulp.src(postcss_paths.src)
    .pipe(plumber({errorHandler: notify.onError('<%= error.message %>')}))
    .pipe(postcss(postcssPlugins))
    .pipe(cleanCSS())
    .pipe(gulp.dest(postcss_paths.dist));

  gulp.src(js_paths.src)
    .pipe(plumber({errorHandler: notify.onError('<%= error.message %>')}))
    .pipe(babel({
      presets: [
        ['env', {
          'targets': {
            'browsers': ['last 2 versions']
          }
        }]
      ]
    }))
    .pipe(uglify({compress: true}))
    .pipe(gulp.dest(js_paths.dist));
});

// CSS,JS変更監視設定
gulp.task('watch', ()=>{
  gulp.watch(postcss_paths.src, ['postcssToCss']);
  gulp.watch(js_paths.src, ['jsCompile']);
});

gulp.task('default', ['allSetAssets']);
