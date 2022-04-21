import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'filter'
})
export class FilterPipe implements PipeTransform {
  transform(value: any, arg: any): any {
    if (arg === '' || arg.lengh<3) return value;
    const resultPosts = [];
    for(const paciente of value){
      if(paciente.rut.indexOf(arg) > -1 || paciente.N_pacientes.toLowerCase().indexOf(arg.toLowerCase()) > -1 ){
        resultPosts.push(paciente);
      };
    };
    return resultPosts;
  }





}
