<?php
namespace Lazyphp\Controller;

class LazyphpController
{
	public function __construct()
    {
        
    }


    /**
     * 默认提示
     * @ApiDescription(section="Demo", description="默认提示")
     * @ApiLazyRoute(uri="/",method="GET")
     * @ApiReturn(type="object", sample="{'code': 0,'message': 'success'}")
     */
    public function index()
    {
        $weapp = new \JiaweiXS\WeApp\WeApp( c('wechat_miniapp_id') , c('wechat_miniapp_secret') , AROOT.DS.'_cache' );
        $info = json_decode($weapp->getSessionKey(v('code')),1);

        session_start();
        $_SESSION['openid'] = $info['openid'];
        $_SESSION['session_key'] = $info['session_key'];

        $data['guid'] = intval( db()->getData("SELECT `id` FROM `user`
            WHERE `openid`='".s( $info['openid'] )."'")->toVar());

        if($data['guid'] > 0) $_SESSION['guid'] = $data['guid'];

        $data['token'] = session_id();
        $data['title'] = $data['top_title'] = 'Version 4.5';
        return send_result( $data );
    }

    /**
     * 系统提示
     * @ApiDescription(section="Demo", description="系统提示")
     * @ApiLazyRoute(uri="/info",method="GET")
     * @ApiReturn(type="object", sample="{'code': 0,'message': 'success'}")
     */
    public function info()
    {
        //$data['notice'] = ;
        token_login();
    }
    
    /**
     * @ApiDescription(section="reg", description="用户注册")
     * @ApiLazyRoute(uri="/reg",method="GET|POST")
     * @ApiParams(name="nickName", type="string", nullable=false, description="nickName", check="check_not_empty", cnname="昵称")
     * @ApiParams(name="avartar", type="string", nullable=false, description="avartar", check="check_not_empty", cnname="头像")
     * @ApiReturn(type="object", sample="{'code': 0,'message': 'success'}")
     */
    public function reg($nickName,$avartar)
    {
        token_login();
        // print_r($nickName.$avartar);

        if( $user = db()->getData("SELECT * FROM `user` WHERE `openid` = '".s($_SESSION['openid'])."' LIMIT 1")->toLine() )
        {
            return lp_throw('ARGS','用户已注册');
        }

        $sql = "INSERT IGNORE INTO `user` ( `openid`,`nickname`,`avatar`,`create_time`) VALUES ( '".s($_SESSION['openid'])."','".s(t($nickName))."','".s(t($avartar))."','".s(lp_now())."')";
        // return send_result(['sql'=>$sql]);
        db()->runSql($sql);
        $guid = db()->lastId();
        $_SESSION['guid'] = $guid;

        return send_result(['guid'=>$guid]);
        
    }
  
    /**
     * @ApiDescription(section="feed_pbulish", description="信息发布")
     * @ApiLazyRoute(uri="/feed_pbulish",method="GET|POST")
     * @ApiParams(name="content", type="string", nullable=false, description="content", check="check_not_empty", cnname="发布内容")
     * @ApiReturn(type="object", sample="{'code': 0,'message': 'success'}")
     */
    public function feed_pbulish( $content )
    {
        token_login();
        // send_result(['content'=>$content]);

        $sql = "INSERT INTO `feed` ( `content`,`author_uid`,`author_openid`,`creat_at`) VALUES ( '".s(t($content))."','".intval($_SESSION['guid'])."','".s($_SESSION['openid'])."','".s(lp_now())."')";
        // return send_result(['sql'=>$sql]);
        db()->runSql($sql);

        $feedid = db()->lastId();

        return send_result(['feedid'=>$feedid]);
        
    }

    /**
     * @ApiDescription(section="feed_list", description="信息列表")
     * @ApiLazyRoute(uri="/feed_list",method="GET|POST")
     * @ApiParams(name="since", type="id", nullable=false, description="since id", check="intval", cnname="sinceid")
     * @ApiReturn(type="object", sample="{'code': 0,'message': 'success'}")
     */
    public function feed_list( $since = 0 )
    {
        token_login();

        $limit = 5;
        if( $since == 0 )
        {
            $sql = "SELECT * FROM `feed` ORDER BY `id` DESC LIMIT $limit ";
        }
        else
        {
            $sql = "SELECT * FROM `feed` WHERE `id` < $since ORDER BY `id` DESC LIMIT $limit ";
        }

        if( $feeds = db()->getData($sql)->toArray() )
        {
            foreach( $feeds as $feed )
            {
                $uids[] = $feed['author_uid'];
            }

            if( isset($uids))
            {
                $uids = array_unique($uids);
                if( $users = db()->getData("SELECT * FROM `user` WHERE `id` IN (".join(',',$uids).")")->toArray())
                {
                    foreach( $users as $user )
                    {
                        $user_array[$user['id']] = $user;
                    }
                }
            }

            if( isset($user_array) && count($user_array) > 0)
            {
                foreach($feeds as $key=>$feed)
                {
                    $feeds[$key]['user'] = $user_array[$feed['author_uid']];
                }
            }
        }

        return send_result($feeds);
        
    }

    /**
     * @ApiDescription(section="feed_mylist", description="关注的信息列表")
     * @ApiLazyRoute(uri="/feed_mylist",method="GET|POST")
     * @ApiParams(name="since", type="id", nullable=false, description="since id", check="intval", cnname="sinceid")
     * @ApiReturn(type="object", sample="{'code': 0,'message': 'success'}")
     */
    public function feed_mylist( $since = 0 )
    {
        token_login();
        
        $limit = 3;
        if( $since == 0 )
        {
            $sql = "SELECT * FROM `feed` ORDER BY `id` DESC LIMIT $limit ";
        }
        else
        {
            $sql = "SELECT * FROM `feed` WHERE `id` < $since ORDER BY `id` DESC LIMIT $limit ";
        }

        if( $feeds = db()->getData($sql)->toArray() )
        {
            foreach( $feeds as $feed )
            {
                $uids[] = $feed['author_uid'];
            }

            if( isset($uids))
            {
                $uids = array_unique($uids);
                if( $users = db()->getData("SELECT * FROM `user` WHERE `id` IN (".join(',',$uids).")")->toArray())
                {
                    foreach( $users as $user )
                    {
                        $user_array[$user['id']] = $user;
                    }
                }
            }

            if( isset($user_array) && count($user_array) > 0)
            {
                foreach($feeds as $key=>$feed)
                {
                    $feeds[$key]['user'] = $user_array[$feed['author_uid']];
                }
            }
        }

        return send_result($feeds);
        
    }

    /**
     * @ApiDescription(section="feed_del", description="删除feed")
     * @ApiLazyRoute(uri="/feed_del",method="GET|POST")
     * @ApiParams(name="fid", type="id", nullable=false, description="feed id", check="check_not_zero", cnname="fid")
     * @ApiReturn(type="object", sample="{'code': 0,'message': 'success'}")
     */
    public function feed_del( $fid )
    {
        token_login();
  
        if( !$feed = table('feed')->getAllById($fid)->toLine())
            lp_throw('ARGS','错误的feed id');
        
        if( $feed['author_uid'] != $_SESSION['guid'] )
            lp_throw('AUTH','只能删除自己的内容');

        $sql = "DELETE FROM `feed` WHERE `id`='".intval($fid)."' LIMIT 1";
        db()->runSql( $sql );

        return send_result($feed);
    }

    /**
     * Demo接口
     * @ApiDescription(section="Demo", description="乘法接口")
     * @ApiLazyRoute(uri="/demo/times",method="GET")
     * @ApiParams(name="first", type="string", nullable=false, description="first", check="check_not_empty", cnname="第一个数")
     * @ApiParams(name="second", type="string", nullable=false, description="second", check="check_not_empty", cnname="第二个数")
     * @ApiReturn(type="object", sample="{'code': 0,'message': 'success'}")
     */
    public function demo($first,$second)
    {
        return send_result(intval($first)*intval($second));
    }

}
