// pages/auth/auth.js
Page({
  // onLoad() {
  //   console.log("auth on load ");
  // },
  doAuth(e) {
    console.log(e);
    if( e.detail.userInfo )
    {
      getApp().saveUserRemote(e.detail.userInfo);
    }
  }
})