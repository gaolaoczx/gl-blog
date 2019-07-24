//index.js
//获取应用实例
const app = getApp()

Page({
  data:
  {
    currentTab:0,
    sinceId:0,
    feedlist:[]
  },
  onLoad()
  {
    if (getApp().globalData.token) getApp().doRegister();
    setTimeout(() => { this.loadList(0)} , 1000);
  },
  loadList(since=0)
  {
    wx.request({
      url: getApp().globalData.hostUrl+'/feed_list',
      data: { 'token': getApp().globalData.token, 'since':this.data.sinceId},
      success:ret=>
      {
        console.log(ret);
        console.log(since)
        if(ret.data && ret.data.data && ret.data.data.length > 0)
        {
          if(since == 0)
          {
            this.setData({ 'feedlist': ret.data.data, sinceId: parseInt(ret.data.data[ret.data.data.length - 1].id, 10) });
          }
          else
          {
            this.setData({ 'feedlist': this.data.feedlist.concat(ret.data.data), sinceId: parseInt(ret.data.data[ret.data.data.length - 1].id,10 )});
          }
        }
      }
    })
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
  onTop(e) 
  {
    wx.showToast({
      title: '正在更新',
      icon:'none'
    });
    this.loadList(0);
  },
  onBottom(e) 
  {
    wx.showToast({
      title: '正在载入数据',
      icon: 'none'
    })
    this.loadList(this.data.sinceId);
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
