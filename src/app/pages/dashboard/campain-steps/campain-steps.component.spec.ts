import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CampainStepsComponent } from './campain-steps.component';

describe('CampainStepsComponent', () => {
  let component: CampainStepsComponent;
  let fixture: ComponentFixture<CampainStepsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CampainStepsComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CampainStepsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
