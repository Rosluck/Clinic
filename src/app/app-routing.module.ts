import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import { AddPacientesComponent } from './add-pacientes/add-pacientes.component';
import { BusPacientesComponent } from './bus-pacientes/bus-pacientes.component';
import { EditPacientesComponent } from './edit-pacientes/edit-pacientes.component';
import { ListPacientesComponent } from './list-pacientes/list-pacientes.component';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';

export const routes: Routes = [

{path: 'lista-pacientes', component: ListPacientesComponent, pathMatch: 'full'},
{path: 'add-pacientes', component: AddPacientesComponent},
{path: 'edit/:id', component: EditPacientesComponent},
{path: 'bus-pacientes', component: BusPacientesComponent},


];

@NgModule({
declarations:[],
imports:[
  
    CommonModule,
    RouterModule.forRoot(routes),
    MatFormFieldModule,
    MatInputModule
],
exports: [RouterModule,MatInputModule,
],


})

export class AppRoutingModule{

}
