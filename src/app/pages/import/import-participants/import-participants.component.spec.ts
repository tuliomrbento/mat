import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ImportParticipantsComponent } from './import-participants.component';

describe('ImportParticipantsComponent', () => {
  let component: ImportParticipantsComponent;
  let fixture: ComponentFixture<ImportParticipantsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ImportParticipantsComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ImportParticipantsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
