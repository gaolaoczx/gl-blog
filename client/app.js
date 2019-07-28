//app.js
import regeneratorRuntime from '/utils/wxPromise.min.js';
import '/utils/wxPromise.min.js';
import EventEmitter from 'eventemitter3'

App({
  onLaunch()
  {
    this.globalData.event = new EventEmitter();
  },
  async code2token() {
    console.log("code2token");
    if (this.globalData.token) return true;
    // 登录
    await wx.pro.login().then(
      res=>{
        console.log(res.code);
        return wx.pro.request(
          {
            url: this.globalData.hostUrl,
            data: { 'code': res.code }
          }
        );
      }).then(
        async ret=>{
          // console.log(ret);
          if (ret.data) {
            this.globalData.token = ret.data.data.token;

            if (ret.data.data.guid < 1) {
              console.log("用户未注册");
              await this.doRegister();
            }
            else {
              console.log("用户已注册");
              // console.log(ret.data.data.guid);
              this.globalData.guid = ret.data.data.guid;
            }
          }
        });
    },
 async doRegister()
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
  async saveUserRemote(userInfo,goback = true)
  {
    console.log("保存用户信息");
    // console.log(userInfo);
    await wx.pro.request({
      url: this.globalData.hostUrl+'/reg',
      data: { 'token': this.globalData.token, 'nickName': userInfo.nickName, 'avartar': userInfo.avatarUrl},
      method:'POST',
      header:{'content-type':'application/x-www-form-urlencoded'}
      }).then(ret=>
      {
        // console.log(ret);
        if ( ret.data.data && ret.data.data.guid && ret.data.data.guid > 0 )
        {
          console.log("保存用户成功");
          this.globalData.guid = ret.data.data.guid;
          // console.log(this.globalData);
          if( goback ) wx.navigateBack();
        }
      }
    );
  },
  globalData: {
    userInfo: null,
    hostUrl: 'http://localhost:8000',
    token:'',
    guid:0,
    event:null
  }
})