import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { PacientesService } from '../pacientes.service';
@Component({
  selector: 'app-edit-pacientes',
  templateUrl: './edit-pacientes.component.html',
  styleUrls: ['./edit-pacientes.component.css']
})
export class EditPacientesComponent implements OnInit {
  AddForm:any;
  paciente_id: any;

  constructor(
    private formBuilder: FormBuilder, 
    private router: Router,
    private pacientesService:PacientesService,
    private url:ActivatedRoute,
    ) { 
      this.AddForm = this.formBuilder.group({
        id:[],
        rut: ['', [Validators.required]],
        N_pacientes: ['', [Validators.required]],
        E_mandante: ['', [Validators.required]],
 
        E_convenio: ['', [Validators.required]],
        f_ingreso: ['', [Validators.required, Validators.maxLength(10)]],
        consentimiento: ['', [Validators.required]],
        f_recepcion: ['',[Validators.required, Validators.maxLength(10)]],
      });
    }
  
  ngOnInit(): void {
    this.paciente_id =  this.url.snapshot.params['id'];
    if (this.paciente_id>0){
      this.pacientesService.GetSinglePaciente(this.paciente_id).subscribe((
        (data: any)=> {
         //console.log(data.data);
        this.AddForm.patchValue(data.data);
        } 
      )
      )
    } 
  }
  onEdit(){

  //console.log(this.AddForm.value)
  this.pacientesService.editPaciente(this.AddForm.value).subscribe(
  (data:any)=>{
   
   console.log(data);
    this.router.navigate(['/lista-pacientes']);
  },
  error =>{
    alert(error);
  }
  );

  }

  onsend(){

    //console.log(this.AddForm.value)
    this.pacientesService.sendPacienteh(this.AddForm.value).subscribe(
    (data:any)=>{
     
     console.log(data);
      this.router.navigate(['/lista-pacientes']);
    },
    error =>{
      alert(error);
    }
    );
  
    }
  

}
