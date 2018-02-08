import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { DataTableModule } from 'angular-4-data-table-bootstrap-4';
import { HttpModule  } from '@angular/http';

import { RouterModule, Routes } from '@angular/router';

import { AppComponent } from './app.component';
import { WpAppComponent } from './wp-app.component';

import { DbOperationsService } from './db-operations.service';
import { WpRestapiService } from './wp-restapi.service';



const appRoutes: Routes = [
  { path: 'crisis-center', component: WpAppComponent },
  { path: 'heroes', component: WpAppComponent },
  { path: '#lordshitbreath', component: WpAppComponent },
  { path: '', component: WpAppComponent },
];

@NgModule({
	declarations: [
		AppComponent, WpAppComponent
	],
	imports: [
		BrowserModule,
		CommonModule,
		HttpModule,
		FormsModule,
		ReactiveFormsModule,
		DataTableModule,
		RouterModule.forRoot(
			appRoutes,
			//{ enableTracing: true } // <-- debugging purposes only
		)
	],
	providers: [DbOperationsService, WpRestapiService],
	bootstrap: [AppComponent]
})
export class AppModule { }
