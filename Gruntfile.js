// Gruntfile.js
module.exports = function(grunt) {
  grunt.loadNpmTasks('grunt-symlink');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  // Création du répertoire d'image pour l'application s'il n'existe pas.
  grunt.file.mkdir('app/Resources/public/images/');

  // properties are css files
  // values are less files
  var filesLess = {};

  // Configuration du projet
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // Définition de la tache 'less'
    // https://github.com/gruntjs/grunt-contrib-less
    less: {
      bundles: {
        options: {
          compress: true,
          yuicompress: true,
          optimization: 2
        },
        files: filesLess
      }
    },
    // Définition de la tache 'symlink'
    // https://github.com/gruntjs/grunt-contrib-symlink
    symlink: {
      // app/Resources/public/ doit être disponible via web/bundles/app/
      app: {
        dest: 'web/bundles/app',
        relativeSrc: '../../app/Resources/public/',
        options: {type: 'dir'}
      }
    },
    concat: {
      dist: {
        src: [
          'web/vendor/jquery/dist/jquery.js',
          'web/vendor/bootstrap/js/transition.js',
          'web/vendor/bootstrap/js/alert.js',
          'web/vendor/bootstrap/js/modal.js',
          'web/vendor/bootstrap/js/dropdown.js',
          'web/vendor/bootstrap/js/scrollspy.js',
          'web/vendor/bootstrap/js/tab.js',
          'web/vendor/bootstrap/js/tooltip.js',
          'web/vendor/bootstrap/js/popover.js',
          'web/vendor/bootstrap/js/button.js',
          'web/vendor/bootstrap/js/collapse.js',
          'web/vendor/bootstrap/js/carousel.js',
          'web/vendor/bootstrap/js/typeahead.js',
          'web/vendor/bootstrap/js/affix.js',
          'web/bundles/app/js/main.js'
        ],
        dest: 'web/built/app/js/main.js'
      }
    },
    // Lorsque l'on modifie des fichiers LESS, il faut relancer la tache 'css'
    // Lorsque l'on modifie des fichiers JS, il faut relancer la tache 'javascript'
    watch: {
      css: {
        files: ['web/bundles/*/less/*.less'],
        tasks: ['css']
      },
      javascript: {
        files: ['web/bundles/app/js/*.js'],
        tasks: ['javascript']
      }
    },
    uglify: {
      dist: {
        files: {
          'web/built/app/js/main.min.js': ['web/built/app/js/main.js']
        }
      }
    }
  });

  // Default task(s).
  grunt.registerTask('default', ['css', 'javascript']);
  grunt.registerTask('css', ['less:discovering', 'less']);
  grunt.registerTask('javascript', ['concat', 'uglify']);
  grunt.registerTask('assets:install', ['symlink']);
  grunt.registerTask('deploy', ['assets:install', 'default']);
  grunt.registerTask('less:discovering', 'This is a function', function() {
    // LESS Files management
    // Source LESS files are located inside : bundles/[bundle]/less/
    // Destination CSS files are located inside : built/[bundle]/css/
    var mappingFileLess = grunt.file.expandMapping(
      ['*/less/*.less', '*/less/*/*.less'],
      'web/built/', {
        cwd: 'web/bundles/',
        rename: function(dest, matchedSrcPath, options) {
          return dest + matchedSrcPath.replace(/less/g, 'css');
        }
      });

    grunt.util._.each(mappingFileLess, function(value) {
      // Why value.src is an array ??
      filesLess[value.dest] = value.src[0];
    });
  });

};
