//index.js
//获取应用实例
const app = getApp()

Page({
  data:
  {
    currentTab:0,
    feedlist:[]
  },
  onLoad()
  {
    if (getApp().globalData.token) getApp().doRegister();
    setTimeout(() => { this.loadList()} , 1000);
  },
  loadList()
  {
    wx.request({
      url: getApp().globalData.hostUrl+'/feed_list',
      data: { 'token': getApp().globalData.token},
      success:ret=>
      {
        console.log(ret);
        if(ret.data && ret.data.data && ret.data.data.length > 0)
        {
          this.setData({'feedlist': ret.data.data});
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
      title: '已到顶部',
      icon:'none'
    });
    this.loadList();
  },
  onBottom(e) 
  {
    wx.showToast({
      title: '已到底部',
      icon: 'none'
    })

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
