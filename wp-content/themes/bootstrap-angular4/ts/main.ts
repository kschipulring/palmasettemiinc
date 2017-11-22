import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';
import { Http } from '@angular/http';
import { App } from './app';
import {
  WpApiModule,
  WpApiLoader,
  WpApiStaticLoader
} from 'wp-api-angular';

export function WpApiLoaderFactory(http: Http) {
  return new WpApiStaticLoader(http, 'https://dev.julienrenaux.fr/wp-json/', /* namespace is optional, default: '/wp/v2' */);
}

@NgModule({
  imports: [
    BrowserModule,
    WpApiModule.forRoot({
      provide: WpApiLoader,
      useFactory: (WpApiLoaderFactory),
      deps: [Http]
    })
  ],
  declarations: [App],
  bootstrap: [App]
})
export class AppModule { }

platformBrowserDynamic().bootstrapModule(AppModule);
