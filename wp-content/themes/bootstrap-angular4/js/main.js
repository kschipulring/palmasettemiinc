/**
 * Main Javascript.
 * This file is for who want to make this theme as a new parent theme and you are ready to code your js here.
 */

System.config({
  //use typescript for compilation
  transpiler: 'typescript',
  //typescript compiler options
  typescriptOptions: {
    emitDecoratorMetadata: true
  },
  //map tells the System loader where to look for things
  map: {
    app: ".."+window.themeFolder+"/ts",
    '@angular': 'https://npmcdn.com/@angular',
    'rxjs': 'https://npmcdn.com/rxjs@5.0.0-beta.6',
    'wp-api-angular': 'https://npmcdn.com/wp-api-angular@3.0.0-beta8/wp-api-angular.umd.min.js'
  },
  //packages defines our app package
  packages: {
    app: {
      main: 'main.ts',
      defaultExtension: 'ts'
    },
    '@angular/core': {
      main: 'bundles/core.umd.js',
      defaultExtension: 'js'
    },
    '@angular/compiler': {
      main: 'bundles/compiler.umd.js',
      defaultExtension: 'js'
    },
    '@angular/common': {
      main: 'bundles/common.umd.js',
      defaultExtension: 'js'
    },
    '@angular/http': {
      main: 'bundles/http.umd.js',
      defaultExtension: 'js'
    },
    '@angular/platform-browser-dynamic': {
      main: 'bundles/platform-browser-dynamic.umd.js',
      defaultExtension: 'js'
    },
    '@angular/platform-browser': {
      main: 'bundles/platform-browser.umd.js',
      defaultExtension: 'js'
    },
    rxjs: {
      defaultExtension: 'js',
      main: 'bundles/Rx.umd.min.js',
    },
    'rxjs/Observable': {
      defaultExtension: 'js'
    },
    'rxjs/Subject': {
      defaultExtension: 'js'
    },
    'wp-api-angular': {
      defaultExtension: 'js'
    }
  }
});