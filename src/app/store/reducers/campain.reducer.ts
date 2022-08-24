import { Action, createReducer, on } from '@ngrx/store';
import * as CampainActions from '../actions/campain.actions';

export const campainFeatureKey = 'campain';

export interface State {
  allCampains: Array<any>,
  imports: any,
  steps: Array<any>,
}

export const initialState: State = {
  allCampains: [],
  imports: [],
  steps: [
    // {
    //   id: 1,
    //   idCampain: 1,
    //   title: 'Fim de ano 2021',
    //   dateStart: '2021-12-01',
    //   dateEnd: '2021-12-31',
    //   metrics: [
    //     {
    //       id: 8,
    //       name: 'MSL Checkout BB',
    //       profile: 'Cliente',
    //       region: 'Sul',
    //       sub_region: 'PR',
    //       entry_key: '',
    //       variables: []
    //     },
    //     {
    //       id: 2,
    //       name: '2 MSL Checkout BB',
    //       profile: '2 Cliente',
    //       region: 'Sul',
    //       sub_region: 'PR',
    //       entry_key: '',
    //       variables: []
    //     }
    //   ]
    // },
    // {
    //   id: 2,
    //   idCampain: 1,
    //   title: 'Primeiro Trimestre',
    //   dateStart: '2022-01-01',
    //   dateEnd: '2022-03-31',
    //   metrics: []
    // },
    // {
    //   id: 3,
    //   idCampain: 1,
    //   title: 'Segundo Trimestre',
    //   dateStart: '2022-04-01',
    //   dateEnd: '2022-06-01',
    //   metrics: []
    // },
  ]
};

export const reducer = createReducer(
  initialState,

  on(CampainActions.loadCampains, state => state),
  on(CampainActions.loadCampainsSuccess, (state, action) => {
    return {
      ...state,
      allCampains: action.data.item,
      imports: action.data.history_imports
    }
  }),
  on(CampainActions.loadCampainsFailure, (state, action) => state),
  on(CampainActions.loadStepsCampainSuccess, (state, action) => {
    return {
      ...state,
      steps: action.steps.data
    }
  })

);
