import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BusPacientesComponent } from './bus-pacientes.component';

describe('BusPacientesComponent', () => {
  let component: BusPacientesComponent;
  let fixture: ComponentFixture<BusPacientesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BusPacientesComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(BusPacientesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
