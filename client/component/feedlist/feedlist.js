// component/feedlist/feedlist.js
Component({
  /**
   * 组件的属性列表
   */
  properties: {
    list: Array
  },

  /**
   * 组件的初始数据
   */
  data: {

  },

  lifetimes:{
    attached() {
      console.log("in feedlist");
    }
  },
  /**
   * 组件的方法列表
   */
  methods: {
    onTop(e) {
      console.log("in onTop");
      this.triggerEvent('top', e.detail, {});
    },
    onBottom(e) {
      console.log("in onBottom");
      this.triggerEvent('bottom', e.detail, {});
    }
  }
})
