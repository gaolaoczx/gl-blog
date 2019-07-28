import regeneratorRuntime from '../../utils/wxPromise.min.js';

Page({
  data: {
    content:'',
    fid:0
  },

  onLoad(options) {
    console.log(options);
    this.setData({ 'fid': parseInt(options.fid ,10 )});
  },

  async loadFeed()
  {
    if(!(this.data.fid > 0))
    {
      wx.showToast({
        title: '错误的feed id'+this.data.fid,
        icon:"none"
      })
    }

    await wx.pro.request({
      url:getApp().globalData.hostUrl+'/feed_detail',
      data:{'token':getApp().globalData.token,'fid':this.data.fid}
    }).then(ret=>{
      // console.log(ret);
      this.setData({'content':ret.data.data.content});
    })
  },
  async onReady() {
    await this.loadFeed();
  },
  update(e)
  {
    // console.log(e);
    if( e.detail.value.textarea.length < 1 )
    { 
      wx.showToast({
        title: '内容不能为空',
        icon:'none'
      })
      return false;
    }
    wx.pro.request({
      url:getApp().globalData.hostUrl+'/feed_modify',
      data:{ 
        'token':getApp().globalData.token,
         'fid': this.data.fid,
        'content':e.detail.value.textarea
      }
    }).then(ret=>{
      // console.log(ret);
      if (ret.data && ret.data.data && ret.data.data.id == this.data.fid)
      {
        //修改成功
        wx.showToast({
          title: '修改成功'
        });
        this.setData({'content':''});

        getApp().globalData.event.emit('feedlistupdate',{'feed':ret.data.data});
        setTimeout(()=>{wx.navigateBack();},500);
      }
    })
  }
})
