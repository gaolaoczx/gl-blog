//app.js
App({
  onLaunch: function () {
    // 登录
    wx.login({
      success: res => {
        // 发送 res.code 到后台换取 openId, sessionKey, unionId
        wx.request({
          url: this.globalData.hostUrl,
          data: {'code':res.code},
          success: (ret) => 
          {
            // console.log(ret);
            if(ret.data)
            {
              this.globalData.token = ret.data.data.token;

              if( ret.data.data.guid < 1)
              {
                console.log("用户未注册");
                this.doRegister();
              }
              else
              {
                console.log("用户已注册");
                // console.log(ret.data.data.guid);
                this.globalData.guid = ret.data.data.guid;
              }
            }
          }
        })
      }
    })
  },
  doRegister()
  {
    if ( this.globalData.guid < 1)
    {
      wx.getSetting({
        success: res=>{
          if (!res.authSetting['scope.userInfo'] )
          {
            console.log("用户未授权");
            wx.navigateTo({url: '/pages/auth/auth'});
          }
          else
          {
            console.log("用户已授权");
            wx.getUserInfo({
              success: (res) => {
                // console.log(res.userInfo);
                this.saveUserRemote( res.userInfo ,false);
              }
            })
          }
        }
      })
    }
  },
  saveUserRemote(userInfo,goback = true)
  {
    console.log("保存用户信息");
    // console.log(userInfo);
    wx.request({
      url: this.globalData.hostUrl+'/reg',
      data: { 'token': this.globalData.token, 'nickName': userInfo.nickName, 'avartar': userInfo.avatarUrl},
      method:'POST',
      header:{'content-type':'application/x-www-form-urlencoded'},
      success:(ret)=>{
        // console.log(ret);
        if ( ret.data.data && ret.data.data.guid && ret.data.data.guid > 0 )
        {
          console.log("保存用户成功");
          this.globalData.guid = ret.data.data.guid;
          // console.log(this.globalData);
          if( goback ) wx.navigateBack();
        }
      }
    })

  },
  globalData: {
    userInfo: null,
    hostUrl: 'http://localhost:8000',
    token:'',
    guid:0,
  }
})