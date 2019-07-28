<?php 
namespace Lazyphp\Core {
Class RestException extends \Exception {}
Class RouteException extends \Lazyphp\Core\RestException {}
Class InputException extends \Lazyphp\Core\RestException {}
Class DatabaseException extends \Lazyphp\Core\RestException {}
Class DataException extends \Lazyphp\Core\RestException {}
Class AuthException extends \Lazyphp\Core\RestException {}
}
namespace{
$GLOBALS['meta'] = array (
  '70c907e8750f400eb470132e210b44cb' => 
  array (
    'Description' => 
    array (
      0 => 
      array (
        'section' => 'Demo',
        'description' => '默认提示',
      ),
    ),
    'LazyRoute' => 
    array (
      0 => 
      array (
        'route' => 'GET /',
        'ApiMethod' => '(type="GET")',
        'ApiRoute' => '(name="/")',
      ),
    ),
    'Return' => 
    array (
      0 => 
      array (
        'type' => 'object',
        'sample' => '{\'code\': 0,\'message\': \'success\'}',
      ),
    ),
    'binding' => false,
    'route' => 
    array (
      0 => 
      array (
        'uri' => 'GET /',
        'params' => false,
      ),
    ),
  ),
  '039a3032e1bca4289db765365162086a' => 
  array (
    'Description' => 
    array (
      0 => 
      array (
        'section' => 'Demo',
        'description' => '系统提示',
      ),
    ),
    'LazyRoute' => 
    array (
      0 => 
      array (
        'route' => 'GET /info',
        'ApiMethod' => '(type="GET")',
        'ApiRoute' => '(name="/info")',
      ),
    ),
    'Return' => 
    array (
      0 => 
      array (
        'type' => 'object',
        'sample' => '{\'code\': 0,\'message\': \'success\'}',
      ),
    ),
    'binding' => false,
    'route' => 
    array (
      0 => 
      array (
        'uri' => 'GET /info',
        'params' => false,
      ),
    ),
  ),
  '6a723d8b656f2e2e3320afc14aed61ae' => 
  array (
    'Description' => 
    array (
      0 => 
      array (
        'section' => 'reg',
        'description' => '用户注册',
      ),
    ),
    'LazyRoute' => 
    array (
      0 => 
      array (
        'route' => 'GET|POST /reg',
        'ApiMethod' => '(type="GET|POST")',
        'ApiRoute' => '(name="/reg")',
      ),
    ),
    'Params' => 
    array (
      0 => 
      array (
        'name' => 'nickName',
        'filters' => 
        array (
          0 => 'check_not_empty',
        ),
        'cnname' => '昵称',
      ),
      1 => 
      array (
        'name' => 'avartar',
        'filters' => 
        array (
          0 => 'check_not_empty',
        ),
        'cnname' => '头像',
      ),
    ),
    'Return' => 
    array (
      0 => 
      array (
        'type' => 'object',
        'sample' => '{\'code\': 0,\'message\': \'success\'}',
      ),
    ),
    'binding' => 
    array (
      'nickName' => 
      array (
        'name' => 'nickName',
      ),
      'avartar' => 
      array (
        'name' => 'avartar',
      ),
    ),
    'route' => 
    array (
      0 => 
      array (
        'uri' => 'GET|POST /reg',
        'params' => false,
      ),
    ),
  ),
  'ebe07d7bc3da9c7730ddfc740b046ea9' => 
  array (
    'Description' => 
    array (
      0 => 
      array (
        'section' => 'feed_pbulish',
        'description' => '信息发布',
      ),
    ),
    'LazyRoute' => 
    array (
      0 => 
      array (
        'route' => 'GET|POST /feed_pbulish',
        'ApiMethod' => '(type="GET|POST")',
        'ApiRoute' => '(name="/feed_pbulish")',
      ),
    ),
    'Params' => 
    array (
      0 => 
      array (
        'name' => 'content',
        'filters' => 
        array (
          0 => 'check_not_empty',
        ),
        'cnname' => '发布内容',
      ),
    ),
    'Return' => 
    array (
      0 => 
      array (
        'type' => 'object',
        'sample' => '{\'code\': 0,\'message\': \'success\'}',
      ),
    ),
    'binding' => 
    array (
      'content' => 
      array (
        'name' => 'content',
      ),
    ),
    'route' => 
    array (
      0 => 
      array (
        'uri' => 'GET|POST /feed_pbulish',
        'params' => false,
      ),
    ),
  ),
  '83b8fee66f4acfafc99c2a7e78b50cc2' => 
  array (
    'Description' => 
    array (
      0 => 
      array (
        'section' => 'feed_list',
        'description' => '信息列表',
      ),
    ),
    'LazyRoute' => 
    array (
      0 => 
      array (
        'route' => 'GET|POST /feed_list',
        'ApiMethod' => '(type="GET|POST")',
        'ApiRoute' => '(name="/feed_list")',
      ),
    ),
    'Params' => 
    array (
      0 => 
      array (
        'name' => 'since',
        'filters' => 
        array (
          0 => 'intval',
        ),
        'cnname' => 'sinceid',
      ),
    ),
    'Return' => 
    array (
      0 => 
      array (
        'type' => 'object',
        'sample' => '{\'code\': 0,\'message\': \'success\'}',
      ),
    ),
    'binding' => 
    array (
      'since' => 
      array (
        'name' => 'since',
        'default' => 0,
      ),
    ),
    'route' => 
    array (
      0 => 
      array (
        'uri' => 'GET|POST /feed_list',
        'params' => false,
      ),
    ),
  ),
  '72736f0ad6f8a8219bfd173c83d0a550' => 
  array (
    'Description' => 
    array (
      0 => 
      array (
        'section' => 'feed_mylist',
        'description' => '关注的信息列表',
      ),
    ),
    'LazyRoute' => 
    array (
      0 => 
      array (
        'route' => 'GET|POST /feed_mylist',
        'ApiMethod' => '(type="GET|POST")',
        'ApiRoute' => '(name="/feed_mylist")',
      ),
    ),
    'Params' => 
    array (
      0 => 
      array (
        'name' => 'since',
        'filters' => 
        array (
          0 => 'intval',
        ),
        'cnname' => 'sinceid',
      ),
    ),
    'Return' => 
    array (
      0 => 
      array (
        'type' => 'object',
        'sample' => '{\'code\': 0,\'message\': \'success\'}',
      ),
    ),
    'binding' => 
    array (
      'since' => 
      array (
        'name' => 'since',
        'default' => 0,
      ),
    ),
    'route' => 
    array (
      0 => 
      array (
        'uri' => 'GET|POST /feed_mylist',
        'params' => false,
      ),
    ),
  ),
  '3b9a62d60485833b4b274a19e192d101' => 
  array (
    'Description' => 
    array (
      0 => 
      array (
        'section' => 'feed_del',
        'description' => '删除feed',
      ),
    ),
    'LazyRoute' => 
    array (
      0 => 
      array (
        'route' => 'GET|POST /feed_del',
        'ApiMethod' => '(type="GET|POST")',
        'ApiRoute' => '(name="/feed_del")',
      ),
    ),
    'Params' => 
    array (
      0 => 
      array (
        'name' => 'fid',
        'filters' => 
        array (
          0 => 'check_not_zero',
        ),
        'cnname' => 'fid',
      ),
    ),
    'Return' => 
    array (
      0 => 
      array (
        'type' => 'object',
        'sample' => '{\'code\': 0,\'message\': \'success\'}',
      ),
    ),
    'binding' => 
    array (
      'fid' => 
      array (
        'name' => 'fid',
      ),
    ),
    'route' => 
    array (
      0 => 
      array (
        'uri' => 'GET|POST /feed_del',
        'params' => false,
      ),
    ),
  ),
  'eb12852dde30c86f2681120ef5001954' => 
  array (
    'Description' => 
    array (
      0 => 
      array (
        'section' => 'Demo',
        'description' => '乘法接口',
      ),
    ),
    'LazyRoute' => 
    array (
      0 => 
      array (
        'route' => 'GET /demo/times',
        'ApiMethod' => '(type="GET")',
        'ApiRoute' => '(name="/demo/times")',
      ),
    ),
    'Params' => 
    array (
      0 => 
      array (
        'name' => 'first',
        'filters' => 
        array (
          0 => 'check_not_empty',
        ),
        'cnname' => '第一个数',
      ),
      1 => 
      array (
        'name' => 'second',
        'filters' => 
        array (
          0 => 'check_not_empty',
        ),
        'cnname' => '第二个数',
      ),
    ),
    'Return' => 
    array (
      0 => 
      array (
        'type' => 'object',
        'sample' => '{\'code\': 0,\'message\': \'success\'}',
      ),
    ),
    'binding' => 
    array (
      'first' => 
      array (
        'name' => 'first',
      ),
      'second' => 
      array (
        'name' => 'second',
      ),
    ),
    'route' => 
    array (
      0 => 
      array (
        'uri' => 'GET /demo/times',
        'params' => false,
      ),
    ),
  ),
);
$app = new \Lazyphp\Core\Application();
$app->route('GET /',array( 'Lazyphp\Controller\LazyphpController','index'));
$app->route('GET /info',array( 'Lazyphp\Controller\LazyphpController','info'));
$app->route('GET|POST /reg',array( 'Lazyphp\Controller\LazyphpController','reg'));
$app->route('GET|POST /feed_pbulish',array( 'Lazyphp\Controller\LazyphpController','feed_pbulish'));
$app->route('GET|POST /feed_list',array( 'Lazyphp\Controller\LazyphpController','feed_list'));
$app->route('GET|POST /feed_mylist',array( 'Lazyphp\Controller\LazyphpController','feed_mylist'));
$app->route('GET|POST /feed_del',array( 'Lazyphp\Controller\LazyphpController','feed_del'));
$app->route('GET /demo/times',array( 'Lazyphp\Controller\LazyphpController','demo'));
$app->run();
}
