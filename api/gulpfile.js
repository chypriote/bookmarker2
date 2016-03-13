var gulp = require('gulp');

var browserSync = require('browser-sync');


gulp.task('reload', function () {
	browserSync.reload();
});

gulp.task('serve', function () {
	browserSync({
		proxy: "127.0.0.1/movie-app/api/doc",
		online: false
	});
});

gulp.task('watch', function () {
	gulp.watch(['doc/**/*'], ['reload']);
});

gulp.task('default', ['serve', 'watch'], function () {
});