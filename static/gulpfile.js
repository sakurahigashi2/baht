// 必要パッケージ定義
const gulp = require('gulp');
const babel = require('gulp-babel');
const gulpUglify = require('gulp-uglify');
const cleanCSS = require('gulp-clean-css');
const postcss = require('gulp-postcss');
const postcssPresetEnv = require('postcss-preset-env');
const postcssNested = require('postcss-nested');
const atImport = require('postcss-import');
const plumber = require('gulp-plumber');
const notify = require('gulp-notify');

// gulp-postcssのプラグイン設定
const postcssPlugins = [
  atImport,
  postcssNested(),
  postcssPresetEnv({
    browsers: 'last 2 versions'
  }),
];

// postCSS出入力パス指定
const postcss_paths = {
  'src': 'assets/css/postcss/*.css',
  'dist': 'assets/css'
};

// JS出入パス指定
const js_paths = {
  'src': 'assets/js/es6/*.js',
  'dist': 'assets/js'
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
    .pipe(gulpUglify({compress: true}))
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
    .pipe(gulpUglify({compress: true}))
    .pipe(gulp.dest(js_paths.dist));
});

// CSS,JS変更監視設定
gulp.task('watch', ()=>{
  gulp.watch(postcss_paths.src, ['postcssToCss']);
  gulp.watch(js_paths.src, ['jsCompile']);
});

gulp.task('default', ['allSetAssets']);
