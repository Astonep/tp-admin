<?php
namespace app\common\controller;


use think\Config;
use think\Controller;
use think\Lang;

/**
* 公用的控制器，pc、app、微信各端不需要控制权限的控制器，必须继承该控制器
 *
* @author aierui github  https://github.com/Aierui
* @version 1.0 
*/
class Common extends Controller
{
    public function _initialize()
    {
        $now_lang = $this->getSetLang();
        $this->assign('set_lang', $now_lang);
    }

    //暂时只做中英文切换
    public function getSetLang()
    {
        $lang = Lang::detect();
        if($lang == 'zh-cn') {
            return 'en-us';
        }
        return 'zh-cn';
    }
}