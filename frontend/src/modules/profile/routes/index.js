import ProfileView from '../ProfileView.vue'
import EditProfile from './../layout/UpdateProfile.vue'

export const profileRoute = [
  {
    path: '/profile',
    name: 'profile',
    alias: '/me',
    component: ProfileView
  },
  {
    path: '/profile/:id/edit',
    name: 'edit-profile',
    alias: '/edit-me',
    component: EditProfile
  }
]
