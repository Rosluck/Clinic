import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HttpClientModule } from '@angular/common/http';
import { AddPacientesComponent } from './add-pacientes/add-pacientes.component';
import { ListPacientesComponent } from './list-pacientes/list-pacientes.component';
import { EditPacientesComponent } from './edit-pacientes/edit-pacientes.component';
import { FormsModule } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';
import { BusPacientesComponent } from './bus-pacientes/bus-pacientes.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { MatTableModule } from '@angular/material/table';
import { FilterPipe } from './pipes/filter.pipe';  

@NgModule({
  declarations: [
    AppComponent,
    AddPacientesComponent,
    ListPacientesComponent,
    EditPacientesComponent,
    BusPacientesComponent,
    FilterPipe,

  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    BrowserAnimationsModule,
    MatFormFieldModule,
    MatInputModule,
    MatTableModule
  ],
  providers: [
    
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
