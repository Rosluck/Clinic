import { Injectable } from '@angular/core';
import {HttpClient, HttpParams} from '@angular/common/http';
import { Pacientes } from './pacientes';

@Injectable({
  providedIn: 'root'
})
export class PacientesService {
  id: any;
 

  constructor(private http:HttpClient) { }

 
    baseUrl:string ='http://localhost/crud/api/';
   
   //recibe la informacion por parte de pacientes.ts
   
    GetPacientes() {
      // PACIENTES EN GENERAL
      return this.http.get<Pacientes[]>(this.baseUrl+'view.php');
       
    }

    GetPacientesh() {
      // PACIENTES EN GENERAL
      return this.http.get<Pacientes[]>(this.baseUrl+'viewH.php');
       
    }

    GetSinglePaciente(id: any) {
      //PACIENTE EN EDITAR
      return this.http.get<Pacientes[]>(this.baseUrl+'view.php?id='+id);
       
    }

    deletePaciente(id:any){
      console.log(id);
      //ELIMINR PACIENTES
      return this.http.delete(this.baseUrl+'delete.php?id='+ id);
    }
    createPaciente(paciente:any){
     // console.log(id);
     //CREAR PACIENTE
      return this.http.post(this.baseUrl+'insert.php', paciente);
    }

    editPaciente(paciente:any){
      // console.log(id);
      //CREAR PACIENTE
       return this.http.put(this.baseUrl+'update.php', paciente);
     }

     searchPaciente(rut: any){
      return this.http.get<Pacientes[]>(this.baseUrl+'buscaR.php?rut='+rut);
     }

     sendPacienteh(paciente:any){
      return this.http.post(this.baseUrl+'insertH.php', paciente);
     }


}
