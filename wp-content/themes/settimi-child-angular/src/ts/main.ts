//angular stuff
import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';
import { enableProdMode } from '@angular/core';
import { AppModule } from './ng-app/app.module';

import '../../node_modules/zone.js/dist/zone.js';
import '../js/main.js';




document.addEventListener("DOMContentLoaded", function(event) {
	//bootstrap(AppComponent);

	platformBrowserDynamic().bootstrapModule(AppModule);

	console.log("your'e a big fat asshole!");
});