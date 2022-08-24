import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CampainStepsManagementComponent } from './campain-steps-management.component';

describe('CampainStepsManagementComponent', () => {
  let component: CampainStepsManagementComponent;
  let fixture: ComponentFixture<CampainStepsManagementComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CampainStepsManagementComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CampainStepsManagementComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
