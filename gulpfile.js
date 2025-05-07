const gulp = require('gulp');
const uglify = require('gulp-uglify');


gulp.task('minify-js', function() {
    return gulp.src('*.js') 
        .pipe(uglify())
        .pipe(gulp.dest('Optimized JavaScripts')); 
});


gulp.task('default', gulp.series('minify-js'));
