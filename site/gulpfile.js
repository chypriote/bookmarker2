var gulp = require('gulp');
var g = require('gulp-load-plugins')({
	pattern: ['gulp-*', 'gulp.*'],
	replaceString: /\bgulp[\-.]/
});

var browserSync = require('browser-sync'),
		clean = require('del'),
		run = require('run-sequence');


gulp.task('styles', function () {
	return gulp.src(['less/main.less'])
		.pipe(g.plumber({
			errorHandler: function (error) {console.log(error.message);this.emit('end');}
		}))
		.pipe(g.less())
		.pipe(g.autoprefixer('last 2 versions'))
		.pipe(g.rename({suffix: '.min'}))
		.pipe(g.cssnano())
		.pipe(gulp.dest('../public/css/'))
		.pipe(browserSync.reload({stream:true}));
});

gulp.task('scripts', function() {
		return gulp.src(['scripts/main.js'])
			.pipe(g.plumber({
				errorHandler: function (error) {console.log(error.message);this.emit('end');}
			}))
			// .pipe(g.xo())
			.pipe(g.rename({suffix: '.min'}))
			.pipe(g.uglify())
			.pipe(gulp.dest('../public/js/'))
			.pipe(browserSync.reload({stream:true}));
});

gulp.task('copy', function () {
	gulp.src(['fonts/*'])
		.pipe(g.changed('../public/fonts/*'))
		.pipe(gulp.dest('../public/fonts'));
	return gulp.src(['img/**/*'])
		.pipe(gulp.dest('../public/img'))
		.pipe(browserSync.reload({stream:true}));
});

gulp.task('clean', function () {
	return clean(['../public/**/*', '!public']);
});
gulp.task('build', gulp.parallel('styles', 'scripts', 'copy'));

gulp.task('reload', function () {
	browserSync.reload();
});

gulp.task('serve', function () {
	browserSync({
		proxy: "127.0.0.1/",
		online: false
	});
});

gulp.task('watch', function () {
	gulp.watch('less/**/*.less', ['styles']);
	gulp.watch('scripts/**/*.js', ['scripts']);
	gulp.watch('templates/**/*', ['reload']);
	gulp.watch(['fonts/**/*', 'img/**/*'], ['copy']);
});

gulp.task('default', gulp.series('build', 'serve', 'watch'));
