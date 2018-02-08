import { Component,  OnInit } from '@angular/core';
import { Http, Response, Headers } from '@angular/http';
//import { DbOperationsService } from './db-operations.service';

import { ConfigSpecificService } from './config-specific.service';

@Component({
	selector: "app-component",
	template: "your grandmother is a tranny who eats {{eatingfood}}",
	providers: [ConfigSpecificService]
})

export class AppComponent implements OnInit{
	eatingfood:string = "monkeyshit";

	//constructor(private dbOperations: DbOperationsService){}
	constructor(){
		console.log( "hi mom, I'm hetero = ", ConfigSpecificService.apibase );
	}

	ngOnInit(): void{
		console.log("they say that life's a carousel");
	}
}