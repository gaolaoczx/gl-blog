// component/feedlist/feedlist.js
import regeneratorRuntime from '../../utils/wxPromise.min.js';

Component({
  /**
   * 组件的属性列表
   */
  properties: {
    url:String
  },

  /**
   * 组件的初始数据
   */
  data: {
    sinceId:0,
    feedlist:null,
    url:''
  },

  lifetimes:{
    async attached() {
      console.log("in feedlist");
      await getApp().code2token();
      this.loadList(0);
    }
  },
  /**
   * 组件的方法列表
   */
  methods: {
    loadList(since = 0) {
      wx.request({
        url: this.data.url,
        data: { 'token': getApp().globalData.token, 'since': since },
        success: ret => {
          console.log(ret);
          // console.log(since)
          if (ret.data && ret.data.data && ret.data.data.length > 0) {
            if (since == 0) {
              this.setData({ 'feedlist': '' });//先清空，保证把全部item组件都卸载，之后重新赋值才会触发attche事件
              this.setData({ 'feedlist': ret.data.data, sinceId: parseInt(ret.data.data[ret.data.data.length - 1].id, 10) });
              // console.log(this.data.feedlist);
            }
            else {
              this.setData({ 'feedlist': this.data.feedlist.concat(ret.data.data), sinceId: parseInt(ret.data.data[ret.data.data.length - 1].id, 10) });
            }
          }
        }
      })
    },
    onTop(e) {
      console.log('onTop');
      wx.showToast({
        title: '正在更新',
        icon: 'none'
      });
      this.loadList(0);
    },
    onBottom(e) {
      console.log('onBottom');
      wx.showToast({
        title: '正在载入数据',
        icon: 'none'
      })
      this.loadList(this.data.sinceId);
    }
  }
})
