import { Action, createReducer, on } from '@ngrx/store';
import * as ParticipantsActions from '../actions/participants.actions';

export const participantsFeatureKey = 'participants';

export interface State {
  status: Array<any>,
  profiles: Array<any>,
  allParticipants: any,
  hasParticipants: boolean,
  hasFilters: boolean
}

export const initialState: State = {
  status: [
    {
      id: 1,
      name: 'pending',
      title: 'Pendente',
      color: '#DDDDEE'
    },
    {
      id: 2,
      name: 'confirmed',
      title: 'Confirmado',
      color: '#2AC644'
    },{
      id: 3,
      name: 'toConfirm',
      title: 'A Confirmar',
      color: '#FFB200'
    },{
      id: 4,
      name: 'inactive',
      title: 'Inativo',
      color: '#F03E5E'
    }
  ],
  profiles: [
    {
      id: 1,
      name: 'Trade'
    },
    {
      id: 2,
      name: 'Coordenador Regional'
    },
    {
      id: 3,
      name: 'Distribuidor'
    },
    {
      id: 4,
      name: 'Vendedor'
    },
    {
      id: 5,
      name: 'Executivo'
    },
    {
      id: 6,
      name: 'Embaixador'
    },
  ],
  allParticipants:[
  ],
  hasParticipants: false,
  hasFilters: false
};

export const reducer = createReducer(
  initialState,

  on(ParticipantsActions.toggleFilters, (state, action) => {
    return {
      ...state, 
      hasFilters: action.value
    }
  }),
  on(ParticipantsActions.participantsSuccess, (state, action) => {
    
    return {
      ...state,
      allParticipants: action.participants,
      hasParticipants: true
    }
  }),
  on(ParticipantsActions.loadParticipantsFiltered, (state, action) => {
    return {
      ...state,
      allParticipants: action.participants
    }
  }),
  on(ParticipantsActions.participantsFailure, (state, action) => state),

);
