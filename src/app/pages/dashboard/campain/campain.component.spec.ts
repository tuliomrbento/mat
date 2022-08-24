import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CampainComponent } from './campain.component';

describe('CampainComponent', () => {
  let component: CampainComponent;
  let fixture: ComponentFixture<CampainComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ CampainComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(CampainComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
