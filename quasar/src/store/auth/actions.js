import { axiosInstance } from 'boot/axios'

export function getPosts (state) {
  return axiosInstance.get('/posts')
}

export function createPost (state, data) {
  return axiosInstance.post('/post', data)
}

export function getPost (state, slug) {
  return axiosInstance.get('/post/' + slug)
}
