
const routes = [
  {
    path: '',
    component: () => import('layouts/MyLayout.vue'),
    children: [
      { path: '/',
        name: 'index',
        component: () => import('pages/Index.vue')
      },
      {
        path: '/posts',
        name: 'posts',
        component: () => import('pages/Post/Index')
      },
      {
        path: '/post/create',
        name: 'post-create',
        component: () => import('pages/Post/Create')
      },
      {
        path: '/post/:slug',
        name: 'post-show',
        component: () => import('pages/Post/Show')
      }
    ]
  }
]

// Always leave this as last one
if (process.env.MODE !== 'ssr') {
  routes.push({
    path: '*',
    component: () => import('pages/Error404.vue')
  })
}

export default routes
