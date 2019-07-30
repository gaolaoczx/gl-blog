// pages/auth/auth.js
Page({
  doAuth(e) {
    console.log(e);
    if( e.detail.userInfo )
    {
      getApp().saveUserRemote(e.detail.userInfo);
    }
  }
})