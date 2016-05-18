var gulp = require('gulp'),
	plugins = require('gulp-load-plugins')({
		'rename' : {
			'gulp-util' : 'gutil'
		}
	});

// A single variable to hold all the paths
var paths = {
	'front_scripts' : ['./assets/javascript/front/*.js', '!./assets/javascript/front/*.min.js', '!./**/build.js'],
	'admin_scripts' : ['./assets/javascript/admin/*.js', '!./assets/javascript/admin/*.min.js', '!./**/build.js'],
	'styles'        : ['./assets/styles/**/*.scss'],
};

var runTimestamp = Math.round(Date.now()/1000);

// Combine and minify scripts
gulp.task('front_scripts', function() {
	'use strict';
	return gulp.src(paths.front_scripts)
		.pipe(plugins.plumber(
			function(err) {
				console.log( err );
				plugins.gutil.log(plugins.gutil.colors.red( 'Error on ' + err.plugin + '\n' + err.message ) );
				plugins.gutil.beep();
				this.emit('end');
			}
		))
		.pipe(plugins.changed('./dist/javascript'))
		.pipe(plugins.concat('script.js'))
		.pipe(gulp.dest('./dist/javascript'))
		.pipe(plugins.notify('<%= file.relative %> updated'))
		.pipe(plugins.rename({
			'suffix' : '.min'
		}))
		.pipe(plugins.uglify())
		.pipe(gulp.dest('./dist/javascript'));
});

// Combine and minify admin scripts
gulp.task('admin_scripts', function() {
	'use strict';
	return gulp.src(paths.admin_scripts)
		.pipe(plugins.plumber(
			function(err) {
				console.log( err );
				plugins.gutil.log(plugins.gutil.colors.red( 'Error on ' + err.plugin + '\n' + err.message ) );
				plugins.gutil.beep();
				this.emit('end');
			}
		))
		.pipe(plugins.changed('./dist/javascript/admin'))
		.pipe(plugins.concat('admin.js'))
		.pipe(gulp.dest('./dist/javascript/admin'))
		.pipe(plugins.notify('<%= file.relative %> updated'))
		.pipe(plugins.rename({
			'suffix' : '.min'
		}))
		.pipe(plugins.uglify())
		.pipe(gulp.dest('./dist/javascript/admin'));
});

// Compile and minify scss files
gulp.task('styles', function() {
	'use strict';
	return gulp.src(paths.styles)
		.pipe(plugins.plumber(
			function(err) {
				plugins.gutil.log(plugins.gutil.colors.red( 'Error on ' + err.plugin + '\n' + err.messageFormatted ) );
				plugins.gutil.beep();
				this.emit('end');
			}
		))
		.pipe(plugins.sass())
		.pipe(plugins.autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
		.pipe(gulp.dest('./dist/styles'))
		.pipe(plugins.rename({
			'suffix' : '.min'
		}))
		.pipe(plugins.cleanCss())
		.pipe(gulp.dest('./dist/styles'))
		.pipe(plugins.notify({
			'message' : 'Styles updated',
			'onLast'  : true
		}));
});

// Live update these files
gulp.task('watch', function() {
	'use strict';
	gulp.watch(paths.scripts, ['front_scripts']);
	gulp.watch(paths.admin_scripts, ['admin_scripts']);
	gulp.watch(paths.styles, ['styles']);

	plugins.livereload.listen();

	gulp.watch(['./dist/**/*']).on('change', plugins.livereload.changed);
});

gulp.task('default', [
	'front_scripts',
	'admin_scripts',
	'styles',
	'watch'
]);
