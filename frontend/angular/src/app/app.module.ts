import { BrowserModule } from '@angular/platform-browser';
import { NgModule, Injector } from '@angular/core';
import { createCustomElement } from "@angular/elements";

import { AppComponent } from './app.component';


@NgModule({
    declarations: [
        AppComponent
    ],
    imports: [
        BrowserModule
    ],
    providers: [],
    bootstrap: [],
    entryComponents:[
        AppComponent
    ]
})
export class AppModule {
    constructor(private injector: Injector) {}

    ngDoBootstrap() {
        window.alert(123);
        const el = createCustomElement(AppComponent, { injector: this.injector });
        customElements.define('map-component', el);
    }
}
