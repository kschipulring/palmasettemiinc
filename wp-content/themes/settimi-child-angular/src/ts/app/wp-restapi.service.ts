import { Injectable } from '@angular/core';
import {  Http, Response, Headers, RequestOptions } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/Rx';

@Injectable()
export class WpRestapiService {
	//apiURL = "http://localhost/rest_api_example/index";
	//apiURL = "http://localhost/projects/php-rest-api/";
	apiURL = "http://dev-palmasettimiinc.3ringprototype.dev/wp-json/wp/v2/pages/4";

  	constructor(private http: Http){}

	//Get all users
	getHomePage() {
		const headers = new Headers();

		headers.append("Cache-Control", "no-cache");
		headers.append('Access-Control-Allow-Origin', '*');
		headers.append('Access-Control-Allow-Methods', 'GET, POST');
		headers.append('Access-Control-Max-Age', '1728000');
		headers.append('Content-Type', 'application/x-www-form-urlencoded');
		return this.http.get(this.apiURL);
	}
}
