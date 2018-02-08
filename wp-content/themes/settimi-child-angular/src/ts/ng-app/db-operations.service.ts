//Import Injectable
import {
	Injectable
} from '@angular/core';

//Import http modules
/*import {
	Http,
	Response,
	Headers,
	RequestOptions
} from '@angular/http';*/

import {HttpClientModule, HttpClient} from '@angular/common/http';

//Import observable
import {
	Observable
} from 'rxjs';
import 'rxjs/Rx';

import ConfigSpecificService from './config-specific.service';

@Injectable()
export class DbOperationsService {
	//apiURL:string = "http://localhost/php-rest-api";
	public apiURL:string = "";

	public results:object = {};

	//private http: Http = new Http();

	//initializer function
	//constructor(private http: Http) {
	constructor(private http: HttpClient) {
		//console.log("This prints a %s and a %d", ConfigSpecificService.apibase, ConfigSpecificService.menuByIdStr );

		//console.log("This prints a %s and a %d", ConfigSpecificService, "horseshit");

		console.log("you are all fools.  The mob rules.");
	}

	getDataCore(){
		this.http.get('/wp-json/wp/v2/pages/5').subscribe(data => {
			// Read the result field from the JSON response.
			this.results = data['results'];

			console.log( "this.results = ", this.results );
		});
	}

	/*
	//Get all users
	getDataCore(url:string) {
		const headers = new Headers();
		headers.append("Cache-Control", "no-cache");
		headers.append('Access-Control-Allow-Origin', '*');
		headers.append('Access-Control-Allow-Methods', 'GET, POST');
		headers.append('Access-Control-Max-Age', '1728000');
		headers.append('Content-Type', 'application/x-www-form-urlencoded');


		//return this.http.get(this.apiURL, {
		return this.http.get(url, {
			headers: headers
		});
	}

	getNavbar(id:number){

		return this.getDataCore("/wp-json/wp/v2/");
	}
	*/
}
