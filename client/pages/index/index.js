//index.js
import regeneratorRuntime from '../../utils/wxPromise.min.js';

//获取应用实例
const app = getApp()

Page({
  data:
  {
    currentTab:0,
    urlList: getApp().globalData.hostUrl +'/feed_list',
    urlMyList: getApp().globalData.hostUrl +'/feed_mylist',
  },
  async onReady()
  {
    // console.log("index onReady");
    // await app.code2token();
  },
  clickTab(e)
  {
    // console.log('click');
    // console.log(e);
    if(this.data.currentTab === e.target.dataset.current)
    {
      return false;
    }
    else
    {
      this.setData({ currentTab: e.target.dataset.current});
    }
  },
  swiperTab(e) 
  {
    // console.log('swiper');
    // console.log(e);
    this.setData({ currentTab: e.detail.current });
  },
  getUserInfo() 
  {
    wx.request({
      url: app.globalData.hostUrl+'/info',
      data: { 'token': app.globalData.token },
      success: (ret) => {
        if (ret.data) {
          // console.log('token0:' + app.globalData.token);
          console.log(ret.data);
        }
      }
    })
  }
})
