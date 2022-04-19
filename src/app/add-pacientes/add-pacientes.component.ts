import { Component, OnInit } from '@angular/core';
import { FormArray, FormBuilder, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { PacientesService } from '../pacientes.service';

@Component({
  selector: 'app-add-pacientes',
  templateUrl: './add-pacientes.component.html',
  styleUrls: ['./add-pacientes.component.css']
})
export class AddPacientesComponent implements OnInit {
  AddForm:any;

 // E_mandanteList: string[] = ["BECHTELQB2", "FACH", "KOMATSU", "68-COVID", "BHP PAMPA NORTE", "EBCO", "ADUANA CHILE", "PYME COVID", "BECHTEL QB1", "MAHO"];


  constructor(
    private formBuilder: FormBuilder, 
    private router: Router,
    private pacientesService:PacientesService,
    ) { 
      this.AddForm = this.formBuilder.group({
        rut: ['', [Validators.required]],
        N_pacientes: ['', [Validators.required]],
        E_mandante: ['', [Validators.required]],
       // E_mandante: new FormControl(this.data),
        E_convenio: ['', [Validators.required]],
        f_ingreso: ['', [Validators.required, Validators.maxLength(10)]],
        consentimiento: ['', [Validators.required]],
      });
    }
   /*
    get authorizedArray(){
      return this.AddForm.get(E_mandanteField) as FormArray;

    }
*/
  ngOnInit(): void {
  }
  onSubmit(){

  //console.log(this.AddForm.value)
  this.pacientesService.createPaciente(this.AddForm.value).subscribe(
  (data:any)=>{
   this.router.navigate(['/']);
  },
  error =>{
    alert(error);
  }
  );

  }
}
