<?php
namespace app\admin\controller;

use app\common\controller\Common;
use think\Controller;
use think\Loader;
use think\Request;
use think\Url;
use think\Session;
use think\Config;

/**
* 登录
* @author aierui github  https://github.com/Aierui
* @version 1.0 
*/
class Index extends Admin
{
	/**
	 * 后台登录首页
	 */
	public function index()
	{
		$data['ip'] = Loader::model('LogRecord')->UniqueIpCount();

		$this->assign('data', $data);
		return view();
	}
}