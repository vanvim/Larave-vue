import Vue from 'vue'

export const store = Vue.observable({
  isReload: false,
  isUpdate: false,
  dataUpdate: null
})

export const actions =  {
  reload(status){
    store.isReload = status
  },
  update(status, data){
    store.isUpdate = status
    store.dataUpdate = data
  }
}
