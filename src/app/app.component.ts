import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { PacientesService } from './pacientes.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'crud';
  rut = 0;
  router: any;
  

  
  constructor(  private url:ActivatedRoute,) { }

  
  
  
  
  //division de seccion de buscar

}




