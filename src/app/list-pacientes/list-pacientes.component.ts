import { Component, OnInit } from '@angular/core';
import { PacientesService } from '../pacientes.service';


@Component({
  selector: 'app-list-pacientes',
  templateUrl: './list-pacientes.component.html',
  styleUrls: ['./list-pacientes.component.css']
})
export class ListPacientesComponent implements OnInit {
  pacientes: any;
  form : any;
  dataSource: any;
 
  constructor(private pacientesservice: PacientesService) { }
  filterPost = '';



  ngOnInit(): void {

    //ngOnInit
   this.dataSource= this.pacientesservice.GetPacientes().subscribe(
      (result: any)=>{
        //console.log(result)
        
         this.pacientes = result.data;
        //filtro  
      }
      )    
  }
  
  deletePaciente(paciente:any){
    this.pacientesservice.deletePaciente(paciente.id).subscribe(
      data => { this.pacientes = this.pacientes.filter((u: any)=> u !== paciente);
        console.log(data);
      }
    )
  }

}


