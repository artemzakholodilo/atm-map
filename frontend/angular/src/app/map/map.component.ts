import { Component, OnInit } from '@angular/core';
import { AtmGeoservice } from '../model/atm.geoservice';
import { Atm } from '../model/Atm';

@Component({
  selector: 'app-map',
  templateUrl: './map.component.html',
  styleUrls: ['./map.component.css']
})
export class MapComponent implements OnInit {
  mapsData = [];

  constructor(private atmGeoService: AtmGeoservice) { }

  ngOnInit() {
    this.getAtmMapData();
    this.renderMap();
  }

  getAtmMapData() {
    this.atmGeoService.getData().then(atm => this.mapsData = atm);
  }

  renderMap() {

  }
}
