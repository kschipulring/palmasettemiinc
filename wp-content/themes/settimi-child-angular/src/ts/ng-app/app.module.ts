
import { NgModule } from '@angular/core';
import { BrowserModule }  from '@angular/platform-browser';
import { Http, Response, RequestOptions, Headers, HttpModule } from '@angular/http';

import { ConfigSpecificService } from './config-specific.service';
import { DbOperationsService } from './db-operations.service';
import { AppComponent } from './app.component';


@NgModule({
	imports: [
		BrowserModule,
		HttpModule
	],
	providers: [DbOperationsService, ConfigSpecificService],
	declarations: [
		AppComponent
	],
	bootstrap: [ AppComponent ]
})
export class AppModule {
	constructor(){
		console.log("squealing pigs who are getting killed are funny");
	}
}
