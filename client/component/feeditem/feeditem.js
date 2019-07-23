// component/feeditem/feeditem.js
// import { format , render, cancel, register } from 'timeago.js';

Component({
  /**
   * 组件的属性列表
   */
  properties: {
    feeddata: Object
  },

  /**
   * 组件的初始数据
   */
  data: {
    feeddata: null
  },

  lifetimes: {
    attached() {
      console.log("in feeditem");
      // this.setData({ 'time':format(this.data.feeddata.creat_at,'zh_CN') });
      // console.log(this.data.feeddata);
    }
  },
  /**
   * 组件的方法列表
   */
  methods: {

  }
})
