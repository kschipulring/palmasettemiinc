import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import {  Http, Response, Headers } from '@angular/http';

import { ActivatedRoute, Router } from '@angular/router';

import { WpRestapiService } from './wp-restapi.service';

@Component({
	selector: 'wp-app',
	templateUrl: './wp-app.component.html'
})

export class WpAppComponent implements OnInit {
	private sub:any;
	pageContent:string = "";

	constructor(private http: Http, private wp: WpRestapiService, private route: ActivatedRoute, private router: Router){
	  	wp.getHomePage().subscribe(
	    	(response: Response) => { 
	    		/*this.persons = response.json();
	    		this.reloadItems(this.params);*/

	    		this.pageContent = response.json().content.rendered;

	    		//console.log( "response.json() = ", response.json() );
	    	} ,
	    	(error) => {console.log(error);}
		);;
	}

	ngOnInit(){

		// Subscribe to route params
		this.sub = this.route.params.subscribe(params => {
			console.log("Cantwell's Params = ", params );


			/*
			let id = params['id'];

			// Retrieve Pet with Id route param
			this.petService.findPetById(id).subscribe(dog => this.dog = dog);
			*/
		});

		this.router.events
		.subscribe((event) => {
			// example: NavigationStart, RoutesRecognized, NavigationEnd
			//if (event instanceof NavigationEnd) {
				console.log("this is the following big O event = ", event);

				console.log( "this.sub = ", this.sub );
			//}
		});


	}


}