import { Component } from '@angular/core';
import {AtmGeoservice} from "./model/atm.geoservice";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
  providers: [AtmGeoservice]
})
export class AppComponent {
  title = 'angular';
}
