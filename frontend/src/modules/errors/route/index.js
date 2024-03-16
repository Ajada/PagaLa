import notFound from './../NotFoundView.vue'

export const errorsPage = [
  {
    path: '/:pathMatch(.*)*',
    name: 'not-found',
    component: notFound
  }
]
