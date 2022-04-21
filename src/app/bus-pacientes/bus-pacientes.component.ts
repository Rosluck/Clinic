import { Component, OnInit } from '@angular/core';
import { PacientesService } from '../pacientes.service';
@Component({
  selector: 'app-bus-pacientes',
  templateUrl: './bus-pacientes.component.html',
  styleUrls: ['./bus-pacientes.component.css']
})
export class BusPacientesComponent implements OnInit {
  pacientes: any;
  form : any;
  dataSource: any;

  constructor( private pacientesservice: PacientesService ) {    }
  ngOnInit(): void {
   //ngOnInit
   this.dataSource= this.pacientesservice.GetPacientesh().subscribe(
    (result: any)=>{
      //console.log(result)
      
       this.pacientes = result.data;
      //filtro  
    }
    )    
  }
 
}
