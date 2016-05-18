module.exports = function(grunt) {
    grunt.initConfig({
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
        sass: {
            // this is the "production" Sass config used with the "grunt buildCss" command
            dist: {
                options: {
                    style: 'compressed',
                    loadPath: 'web/vendor/bootstrap-sass/assets/stylesheets'
                },
                files: {
                    'web/built/app/css/main.css': 'web/bundles/app/scss/main.sass'
                }
            },
            fos_user: {
                options: {
                    style: 'compressed',
                    loadPath: 'web/vendor/bootstrap-sass/assets/stylesheets'
                },
                files: {
                    'web/built/app/css/fos_user.css': 'web/bundles/app/scss/fos_user.sass'
                }
            }
        },
        coffee: {
          compile: {
            options: {
              join: true
            },
            files: {
              'web/bundles/tmp/main.js': ['web/bundles/app/coffee/*.coffee']
            }
          }
        },
        // configure the "grunt watch" task
        watch: {
            sass: {
                files: 'web/bundles/app/scss/*.sass',
                tasks: ['buildCss']
            },
            coffee: {
                files: 'web/bundles/app/coffee/*.coffee',
                tasks: ['buildJs']
            }
        },
        // concat
        concat: {
          js: {
            src: [
              'web/vendor/jquery/dist/jquery.js',
              'web/vendor/bootstrap-sass/assets/javascripts/bootstrap/transition.js',
              'web/vendor/bootstrap-sass/assets/javascripts/bootstrap/alert.js',
              'web/vendor/bootstrap-sass/assets/javascripts/bootstrap/modal.js',
              'web/vendor/bootstrap-sass/assets/javascripts/bootstrap/dropdown.js',
              'web/vendor/bootstrap-sass/assets/javascripts/bootstrap/scrollspy.js',
              'web/vendor/bootstrap-sass/assets/javascripts/bootstrap/tab.js',
              'web/vendor/bootstrap-sass/assets/javascripts/bootstrap/tooltip.js',
              'web/vendor/bootstrap-sass/assets/javascripts/bootstrap/popover.js',
              'web/vendor/bootstrap-sass/assets/javascripts/bootstrap/button.js',
              'web/vendor/bootstrap-sass/assets/javascripts/bootstrap/collapse.js',
              'web/vendor/bootstrap-sass/assets/javascripts/bootstrap/carousel.js',
              'web/vendor/bootstrap-sass/assets/javascripts/bootstrap/typeahead.js',
              'web/vendor/bootstrap-sass/assets/javascripts/bootstrap/affix.js',
              'web/vendor/photoswipe/dist/photoswipe.js',
              'web/bundles/tmp/modernizr-custom.js',
              'web/bundles/tmp/main.js'
            ],
            dest: 'web/built/app/js/main.min.js'
          },
          css: {
            src: [
              'web/built/app/css/main.css',
              'web/vendor/photoswipe/dist/photoswipe.css'
            ],
            dest: 'web/built/app/css/main.min.css'
          }
        },
        // minify
        uglify: {
          dist: {
            files: {
              'web/built/app/js/main.min.js': ['web/built/app/js/main.min.js']
            }
          }
        },
        modernizr: {
          dist: {
            "dest" : "web/bundles/tmp/modernizr-custom.js",
            "crawl" : false,
            "options": [
              "setClasses"
            ],
            "uglify": true,
            "tests" : ['svg']
          }
        },
        copy: {
          fonts: {
            files: [
              {expand: true, flatten: true, src: ['web/vendor/bootstrap-sass/assets/fonts/bootstrap/*'], dest: 'web/built/app/fonts/bootstrap/', filter: 'isFile'}
            ]
          },
          plupload: {
            files: [
              {src: ['vendor/moxiecode/plupload/js/plupload.full.min.js'], dest: 'web/bundles/app/js/plupload.full.min.js'},
              {src: ['vendor/moxiecode/plupload/js/Moxie.swf'], dest: 'web/bundles/app/js/Moxie.swf'},
              {src: ['vendor/moxiecode/plupload/js/Moxie.xap'], dest: 'web/bundles/app/js/Moxie.xap'}
            ]
          }
        }
    });

    grunt.loadNpmTasks('grunt-symlink');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-coffee');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks("grunt-modernizr");

    grunt.registerTask('default', ['buildCss', 'buildJs', 'assets:install']);
    grunt.registerTask('buildCss', ['sass:dist', 'concat:css', 'sass:fos_user']);
    grunt.registerTask('buildJs', ['modernizr:dist', 'coffee:compile', 'concat:js', 'uglify']);
    grunt.registerTask('assets:install', ['symlink', 'copy:fonts', 'copy:plupload']);
};
