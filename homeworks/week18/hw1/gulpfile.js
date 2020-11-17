const { src, dest, parallel } = require('gulp');
const babel = require('gulp-babel');
const sass = require('gulp-sass');
const uglify = require('gulp-uglify');
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');
const autoprefixer = require('gulp-autoprefixer');

sass.compiler = require('node-sass');

function compileJs() {
  return src('src/*.js')
    .pipe(babel())
    .pipe(dest('dist'))
    .pipe(uglify())
    .pipe(rename({ extname: '.min.js' }))
    .pipe(dest('dist'));
}

function compileCss() {
  return src('src/scss/main.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({
      cascade: false,
    }))
    .pipe(dest('css'))
    .pipe(cleanCSS({ compatibility: 'ie8' }))
    .pipe(rename({ extname: '.min.css' }))
    .pipe(dest('css'));
}

exports.default = parallel(compileJs, compileCss);
