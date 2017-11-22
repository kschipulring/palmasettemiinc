"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
exports.__esModule = true;
//our root app component
var core_1 = require("@angular/core");
require("rxjs/add/operator/map");
var App = (function () {
    function App(wpApiPosts, wpApiPages, wpApiComments, wpApiTypes, wpApiMedia, wpApiUsers, wpApiTaxonomies, wpApiStatuses, wpApiTerms, wpApiCustom) {
        this.wpApiPosts = wpApiPosts;
        this.wpApiPages = wpApiPages;
        this.wpApiComments = wpApiComments;
        this.wpApiTypes = wpApiTypes;
        this.wpApiMedia = wpApiMedia;
        this.wpApiUsers = wpApiUsers;
        this.wpApiTaxonomies = wpApiTaxonomies;
        this.wpApiStatuses = wpApiStatuses;
        this.wpApiTerms = wpApiTerms;
        this.wpApiCustom = wpApiCustom;
        this.posts$ = wpApiPosts.getList()
            .map(function (response) { return response.json(); });
    }
    App = __decorate([
        core_1.Component({
            selector: 'my-app',
            providers: [],
            template: "\n    <div>\n      <h2>Latest Pig Slaughters:</h2>\n      <p *ngFor=\"let post of posts$ | async\">{{post.title.rendered}}<p>\n    </div>\n  ",
            directives: []
        })
    ], App);
    return App;
}());
exports.App = App;
