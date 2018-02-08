import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Observable, Subscription, BehaviorSubject } from 'rxjs/Rx';
import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';
import 'rxjs/add/operator/toPromise';

@Injectable()
export class ConfigSpecificService {

	//REST API URL sections
	static apibase:string = "/wp-json/wp/v2/";
	static menus:string = "menus";
	static menuByIdNum:string = "menus/([0-9]+)";
	static menuByIdStr:string = "menus/(?P<id>[a-zA-Z(-]+)";
	static menuPrimary:string = "menus/(primary)+";

	static homepage:string = "frontpage";
	static pagesbase:string = "pages/";

	constructor(){
		console.log('ConfigSpecificService created');
	}
}
