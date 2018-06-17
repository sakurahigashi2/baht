// 必要パッケージ定義
const gulp = require('gulp');
const postcss = require('gulp-postcss');
const cssnext = require('postcss-cssnext');
const atImport = require('postcss-import');

// gulp-postcssの設定
const postcssPlugins = [
  atImport,
  cssnext({
    browsers: ['ie >= 10', 'last 2 versions']
  })
];

// 出入力パス指定
const paths = {
  'src': './assets/css/postcss/**.css',
  'dist': './assets/css'
};

// gulpタスク設定
gulp.task('postcssToCss', ()=>{
  return gulp.src(paths.src)
    .pipe(postcss(postcssPlugins))
    .pipe(gulp.dest(paths.dist));
});

// 監視対象設定
gulp.task('watch', ()=>{
  gulp.watch(paths.src, ['postcssToCss']);
});

gulp.task('default', ['postcssToCss']);
