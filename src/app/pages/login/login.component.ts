import { DOCUMENT } from '@angular/common';
import { Component, Inject, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { Store } from '@ngrx/store';
import { State } from 'src/app/store';
import * as fromAuthLogin from 'src/app/store/actions/auth-login.actions';
import { selectAuthError, selectAuthLoading } from 'src/app/store/selectors/auth-login.selectors';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  window: any
  registerForm!: FormGroup;
  submitted: boolean = false;
  icon: string = ''
  logo: string = ''
  client: string = ''
  loading!: boolean
  oAuthError!: any

  constructor(
    private formBuilder: FormBuilder, 
    private store: Store<State>,
    @Inject(DOCUMENT) private document: Document  
  ) {
    this.window = this.document.defaultView
    this.store.select(selectAuthError).subscribe((e) => this.oAuthError = e)
    this.store.select(selectAuthLoading).subscribe((load) => this.loading = load)
  }

  ngOnInit() {
    this.registerForm = this.formBuilder.group({
      username: ['', Validators.required],
      password: ['', [Validators.required, Validators.minLength(5)]],
    });

    this.client = this.window.global_.cliente
    this.icon = this.window.global_.logo
    this.logo = this.window.global_.logo
  }
  
  get f() { return this.registerForm.controls; }

  handleOAuthError(){
    if(this.oAuthError){
      this.store.dispatch(fromAuthLogin.toggleError({ error: null }))
    }
  }
  
  onSubmit() {
    this.submitted = true;
    this.store.dispatch(fromAuthLogin.toggleLoading({ loading: true }))

    if (!this.registerForm.invalid) {
      this.store.dispatch(
        fromAuthLogin.login({
          username: this.registerForm.value.username,
          password: this.registerForm.value.password
        })
      )
    }
  }

}
