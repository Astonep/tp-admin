<?php
namespace app\admin\taglib;

use think\template\TagLib;
use think\Request;
use think\Config;

/**
* 工具类标签
*/

class Tool extends Taglib
{

    // 标签定义
    protected $tags = [
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'toolbar'           => ['attr' => 'id'],
    ];

    public function tagToolbar($tag, $content)
    {
       // 元素默认id
        if(empty($tag['id'])){
            $tag['id'] = 'toolbar';
        }

        $request = Request::instance();
        $module = $request->module();
        $controller = $request->controller();
        if (Config::get('url_domain_deploy'))
            $url = '/' . $controller;
        else
            $url = '/' . $module . '/' . $controller;

        $html  = '';
        $html .= '<div id="' . $tag['id'] . '" class="toolbar" data-module="'.$url.'">';
        $html .= '<div class="btn-group">';
        $html .= '<button type="button" data-name="add" class="btn btn-primary" data-event-type="view" data-event-value=""  data-target="modal"><i class="fa fa-plus" aria-hidden="true" style="margin-right: 2px"> </i>{$Think.lang.Add}</button><button type="button" data-name="delete" class="btn btn-default" data-event-type="default" data-event-value="" data-target="modal"><i class="fa fa-trash" aria-hidden="true" style="margin-right: 2px"> </i>{$Think.lang.Delete}</button>';
        $html .= '</div>';
        $html .= $content;
        $html .= '</div>';
        
        return $html;
    }

}
