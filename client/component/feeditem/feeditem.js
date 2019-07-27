// component/feeditem/feeditem.js
import { format, render, cancel, register } from 'timeago.min.js';

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
      // console.log(this.data.feeddata.creat_at);
      this.setData({ 'time':format(this.data.feeddata.creat_at,'zh_CN') });
      // console.log(this.data.time);
    },
    ready() {
      // console.log('ready');
    },
    detached() {
      // console.log('detached');
      // console.log(this.data.feeddata);
    }
  },
  /**
   * 组件的方法列表
   */
  methods: {

  }
})
