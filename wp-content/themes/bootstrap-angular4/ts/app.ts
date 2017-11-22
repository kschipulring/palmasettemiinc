//our root app component
import {Component} from '@angular/core';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map';
import {
  WpApiPosts,
  WpApiPages,
  WpApiComments,
  WpApiTypes,
  WpApiMedia,
  WpApiUsers,
  WpApiTaxonomies,
  WpApiStatuses,
  WpApiTerms,
  WpApiCustom
} from 'wp-api-angular';

@Component({
  selector: 'my-app',
  providers: [],
  template: `
    <div>
      <h2>Latest Pig Slaughters:</h2>
      <p *ngFor="let post of posts$ | async">{{post.title.rendered}}<p>
    </div>
  `,
  directives: []
})
export class App {
  posts$: Observable<any>;
  constructor(
    private wpApiPosts: WpApiPosts,
    private wpApiPages: WpApiPages,
    private wpApiComments: WpApiComments,
    private wpApiTypes: WpApiTypes,
    private wpApiMedia: WpApiMedia,
    private wpApiUsers: WpApiUsers,
    private wpApiTaxonomies: WpApiTaxonomies,
    private wpApiStatuses: WpApiStatuses,
    private wpApiTerms: WpApiTerms,
    private wpApiCustom: WpApiCustom
  ) {
    this.posts$ = wpApiPosts.getList()
      .map(response => response.json())
  }
}