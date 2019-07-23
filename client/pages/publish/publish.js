// pages/publish/publish.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    if (getApp().globalData.token) getApp().doRegister();
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  },

  publish(e)
  {
    // console.log(e);
    const content = e.detail.value.textarea;
    if( content.length < 1 )
    {
      wx.showToast({
        title: '发布内容不能为空',
        icon:'none'
      });
      return false;
    }

    wx.request({
      url: getApp().globalData.hostUrl+'/feed_pbulish',
      data: { 'token': getApp().globalData.token, 'content': content },
      method:"POST",
      header: { 'content-type': 'application/x-www-form-urlencoded' },
      success:res=>{
        // console.log(res);
        if(res.data && res.data.data && res.data.data.feedid && res.data.data.feedid > 0)
        {
          wx.showToast({
            title: '发布成功',
          });
          this.setData({'content':''});  
        }
        else
        {
          wx.showToast({
            title: res.data.message,
            icon:'none'
          })
        }

      }
    })
  }

})