import {HttpClient} from '@angular/common/http';
import {Inject, Injectable} from '@angular/core';
import {environment} from "../../environments/environment";
import {Atm} from "./Atm";

import 'rxjs/add/operator/toPromise';

@Injectable()
export class AtmGeoservice {
    atmUrl = environment.apiUrl + '/atm';

    constructor(
        private http: HttpClient
    ) {
    }

    getData(): Promise<Atm[]> {
        return this.http.get(this.atmUrl)
            .toPromise()
            .then(response => response as Atm[])
            .catch(this.handleError);
    }

    getDetail(id: number): Promise<Atm> {
        return this.http.get(`${this.atmUrl}/${id}`)
            .toPromise()
            .then(response => response as Atm)
            .catch(this.handleError);
    }

    private handleError(error: any): Promise<any> {
        console.error('An error occurred', error);
        return Promise.reject(error.message || error);
    }
}