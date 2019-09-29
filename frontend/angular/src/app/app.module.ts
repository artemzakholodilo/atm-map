import {BrowserModule} from '@angular/platform-browser';
import {Injector, NgModule} from '@angular/core';
import {createCustomElement} from '@angular/elements';

import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import {MapComponent} from './map/map.component';


@NgModule({
    declarations: [
        AppComponent,
        MapComponent
    ],
    imports: [
        BrowserModule,
        AppRoutingModule,
    ],
    providers: [],
    entryComponents: [AppComponent, MapComponent],
    bootstrap: [AppComponent]
})
export class AppModule {
    constructor(private injector: Injector){}

    ngDoBootstrap() {
        const el = createCustomElement(AppComponent,
            { injector: this.injector });
        customElements.define('my-own-element', el);
        const el2 = createCustomElement(MapComponent,
            { injector: this.injector });
        customElements.define('map-element', el2);
    }
}
