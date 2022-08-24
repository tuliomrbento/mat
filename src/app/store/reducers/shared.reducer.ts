import { Action, createReducer, on } from '@ngrx/store';
import * as SharedActions from '../actions/shared.actions'

export const sharedFeatureKey = 'shared';

export interface State {
  itemsByPages: Array<any>,
  properties: any,
  user: any
}

export const initialState: State = {
  user: {},
  itemsByPages: [
    {
      key: 'home',
      icon: 'assets/icons/home.svg',
      title: 'Página Inicial',
      path: '/dashboard/home',
      sub: [],
    },
    {
      key: 'participants',
      icon: 'assets/icons/people.svg',
      title: 'Participantes',
      sub: [
        {
          title: 'Gestão de Participantes',
          path: '/dashboard/participants',
        },
        {
          title: 'Importar Participantes',
          path: '/dashboard/participants/import',
        },
      ],
      path: '',
    },
    {
      key: 'campain',
      icon: 'assets/icons/mechanics.svg',
      title: 'Campanha',
      path: '',
      sub: [
        {
          title: 'Etapas da Campanha',
          path: '/dashboard/campain',
        },
        {
          title: 'Importar Resultados',
          path: '/dashboard/campain/import',
        }
      ]
    }
  ],
  properties: {
    colors: {
      primary: '#ffff63',
      secondary: '#212529',
      secondary_light: '#9a9a9a',
      background_dark: 'linear-gradient(rgb(33, 33, 33), rgb(59, 59, 59))'
    }
  }
};

export const reducer = createReducer(
  initialState,

  on(SharedActions.loadSharedUser, (state, action) => {
    return {
      ...state,
      user: {
        id: atob(action.user.token).split(':')[1],
        empresa: action.user.empresa,
        perfil: action.user.perfil
      }
    }
  }),

  on(SharedActions.loadSharedPropertiesSuccess, (state, action) => {
    console.log(action)
    return {
      ...state,
      properties: {
        colors: {
          primary: action.data.item.cor1,
          secondary: action.data.item.cor2,
          secondary_light: action.data.item.cor3,
          background_dark: action.data.item.cor4
        }
      }
    }
  })
);
