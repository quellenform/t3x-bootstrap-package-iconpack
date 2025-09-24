const sass = require('sass-embedded');
module.exports = function (grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    baseClass: 'bpi',
    patterns: {
      svg: '*.svg'
    },
    startCodepoint: 61440, // 61440 = 0xF000, 61697 = 0xF101
    paths: {
      root: '../',
      sources: 'Sources/',
      sourceHtml: '<%= paths.sources %>Pug/',
      sourceIconpack: '<%= paths.sources %>Iconpack/',
      sourceIconpackTemplates: '<%= paths.sourceIconpack %>Templates/',
      resources: '<%= paths.root %>Resources/',
      resourcesPrivate: '<%= paths.resources %>Private/',
      resourcesPublic: '<%= paths.resources %>Public/',
      iconpackTarget: '<%= paths.resourcesPublic %>Iconpack/'
    },
    styles: {
      bpi: {
        family: 'Bootstrap Package Iconpack',
        name: 'bootstrappackageiconpack',
        file: 'bpi'
      }
    },

    // Minify/optimize icons and copy them to target directory
    imagemin: {
      main: {
        options: {
          optimizationLevel: 3,
          // https://svgo.dev/docs/plugins/
          svgoPlugins: [{
            cleanupListOfValues: true
          }, {
            // Converting styles such as style="enable-background:new 0 0 24 24", style="fill:none" to attributes
            // allows plugins such as cleanupEnableBackground, removeUselessStrokeAndFill to do further processing
            convertStyleToAttrs: true
          }, {
            removeOffCanvasPaths: true
          }, {
            removeRasterImages: true
          }, {
            removeScriptElement: true
          }, {
            removeStyleElement: true
          }, {
            removeUselessStrokeAndFill: {
              // Remove elements that have computed fill and stroke equal to "none"
              removeNone: true
            }
          }, {
            removeAttrs: {
              attrs: [
                'fill-rule',
                'stroke-linejoin',
                'stroke-miterlimit',
                'clip-rule'
              ]
            }
          }, {
            removeViewBox: false
          }, {
            sortAttrs: true
          }],
        },
        files: [{
          expand: true,
          cwd: '<%= paths.sourceIconpack %>',
          src: '<%= patterns.svg %>',
          dest: '<%= paths.iconpackTarget %>svgs/'
        }]
      }
    },

    // Create webfont from SVG icons
    webfont: {
      options: {
        stylesheet: 'scss',
        templateOptions: {
          baseClass: '<%= baseClass %>',
          classPrefix: '<%= baseClass %>-'
        },
        template: '<%= paths.sourceIconpackTemplates %>_font.scss',
        htmlDemo: false,
        codepointsFile: '<%= paths.iconpackTarget %>metadata/codepoints.json',
        types: 'woff,woff2,ttf',
        relativeFontPath: '../webfonts/',
        engine: 'fontforge',
        optimize: false,
        autoHint: true,
        version: '<%= pkg.version %>'
      },
      bpi: {
        src: '<%= paths.iconpackTarget %>svgs/*.svg',
        dest: '<%= paths.iconpackTarget %>webfonts/',
        destScss: '<%= paths.iconpackTarget %>scss/',
        options: {
          font: '<%= styles.bpi.name %>',
          fontFamilyName: '<%= styles.bpi.family %>',
          fontFilename: '<%= styles.bpi.file %>'
        }
      }
    },

    // Create one single SVG Sprite from multiple SVG icons
    svgstore: {
      options: {
        prefix: '',
        formatting: {
          indent_size: 2
        },
        includedemo: false,
        inheritviewbox: true,
        includeTitleElement: false,
        svg: {
          xmlns: 'http://www.w3.org/2000/svg',
          'xmlns:xlink': 'http://www.w3.org/1999/xlink'
        }
      },
      bpi: {
        files: {
          '<%= paths.iconpackTarget %>sprites/<%= styles.bpi.file %>.svg': ['<%= paths.iconpackTarget %>svgs/*.svg']
        }
      }
    },

    // Compile core SCSS
    sass: {
      options: {
        implementation: sass,
        outputStyle: 'expanded',
        precision: 8,
        sourceMap: false,
        silenceDeprecations: [
          'legacy-js-api'
        ]
      },
      main: {
        files: {
          '<%= paths.iconpackTarget %>css/<%= styles.bpi.file %>.css': '<%= paths.iconpackTarget %>scss/<%= styles.bpi.file %>.scss'
        }
      }
    },

    // Minify CSS
    cssmin: {
      options: {
        keepSpecialComments: '*',
        advanced: false
      },
      main: {
        expand: true,
        cwd: '<%= paths.iconpackTarget %>css/',
        src: ['*.css', '!*.min.css'],
        dest: '<%= paths.iconpackTarget %>css/',
        ext: '.min.css'
      }
    },

    // Minify SVG Sprites
    xmlmin: {
      main: {
        options: {
          preserveComments: false
        },
        files: [{
          expand: true,
          cwd: '<%= paths.iconpackTarget %>sprites/',
          src: ['*.svg'],
          dest: '<%= paths.iconpackTarget %>sprites/'
        }]
      }
    },

    // Cleanup
    clean: {
      ttf: {
        options: {
          force: true
        },
        src: ['<%= paths.iconpackTarget %>webfonts/*-hinted.ttf']
      }
    },

    // Compile HTML
    pug: {
      options: {
        data: {
          debug: true
        },
        client: false,
        pretty: true
      },
      main: {
        files: [{
          expand: true,
          cwd: '<%= paths.sourceHtml %>',
          src: ['**/*.pug'],
          dest: '<%= paths.resourcesPrivate %>',
          ext: '.html'
        }]
      }
    },

    // Prettify HTML
    jsbeautifier: {
      options: {
        html: {
          braceStyle: 'collapse',
          indentWithTabs: false,
          indentSize: 4,
          maxPreserveNewlines: 0,
          preserveNewlines: false,
          unformatted: [],
          wrapLineLength: 0,
          endWithNewline: true,
          extraLiners: 'head,body,f:layout',
          indentInnerHtml: false,
          wrapAttributes: 'preserve-aligned'
        }
      },
      main: {
        expand: true,
        cwd: '<%= paths.resourcesPrivate %>',
        src: ['**/*.html'],
        ext: '.html'
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-pug');
  grunt.loadNpmTasks('grunt-jsbeautifier');
  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-svgstore');
  grunt.loadNpmTasks('grunt-webfont');
  grunt.loadNpmTasks('grunt-xmlmin');

  /**
   * Copy scss
   */
  grunt.registerTask('copy', function () {
    grunt.file.copy(
      grunt.config('paths.sourceIconpackTemplates') + '_core.scss',
      grunt.config('paths.iconpackTarget') + 'scss/' + grunt.config('styles.bpi.file') + '.scss'
    );
  });

  /**
   * Create metadata from source icons
   */
  grunt.registerTask('metadata', 'Grunt task to extract metadata from source package.', function () {
    YAML = require('yamljs');

    const sourceIconpack = grunt.config('paths.sourceIconpack');
    const targetPath = grunt.config('paths.iconpackTarget');
    const pattern = grunt.config('patterns.svg');
    const baseClass = grunt.config('baseClass');
    const startCodepoint = grunt.config('startCodepoint');

    let icons = [];
    let count = 0;

    grunt.file.expand({
      cwd: sourceIconpack,
      filter: 'isFile',
    }, pattern)
      .forEach(function (sourceFile, index) {
        const icon = getIconFromFilePath(sourceFile);
        if (!(icon in icons)) {
          icons.push(icon);
        }
        count = index + 1;
      });

    // Write metadata
    grunt.file.write(
      targetPath + 'metadata/icons.yml',
      YAML.stringify(icons)
    );

    // Create icon variables for SCSS
    let scssContent = '';
    let codepoints = {};
    let iconVariables = [];
    let iconIdentifier = [];
    Object.values(icons).sort().forEach(function (icon, index) {
      const codepoint = startCodepoint + index
      codepoints[icon] = codepoint;
      iconVariables.push('$' + baseClass + '-' + icon + ': "\\\\' + codepoint.toString(16) + '";');
      iconIdentifier.push('"' + icon + '": $' + baseClass + '-' + icon + ',');
    });
    scssContent += iconVariables.join('\n') + '\n\n';
    scssContent += '$' + baseClass + '-icons: (\n  ' + iconIdentifier.join('\n  ') + '\n);';
    grunt.file.write(targetPath + 'metadata/codepoints.json', JSON.stringify(codepoints));
    grunt.file.write(targetPath + 'scss/_icons.scss', scssContent);

    grunt.log.write('Processed metadata for ');
    grunt.log.write((count + '').blue);
    grunt.log.writeln(' icons');
  });

  /**
   * Extract icon name from file path
   */
  function getIconFromFilePath(filePath) {
    return filePath.replace(/([^\.]*).*/, "$1").replace(/_/g, '-') ??
      grunt.fail.fatal('Icon name could not be extracted from file path!');
  }



  grunt.registerTask('sprites', ['svgstore', 'xmlmin']);
  grunt.registerTask('webfonts', ['webfont', 'copy', 'sass', 'cssmin']);
  grunt.registerTask('css', ['copy', 'sass', 'cssmin']);
  grunt.registerTask('html', ['pug', 'jsbeautifier']);

  grunt.registerTask('build', ['imagemin', 'metadata', 'webfont', 'svgstore', 'xmlmin', 'copy', 'sass', 'cssmin', 'clean']);
  grunt.registerTask('default', ['build']);
};
