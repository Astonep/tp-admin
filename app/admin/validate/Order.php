<?php
namespace app\admin\validate;

use think\Validate;

class Order extends Validate
{

    protected $rule =   [
        'hnum'              => 'require|length:8',
    ];

    protected $message  =   [
        'hnum.require'      => '会员卡号不能为空',
        'hnum.length'       => '会员卡号不是正确的卡号，卡号为八位',
    ];

    protected $scene = [
        'add' => ['hnum'],
        'edit' => ['hnum']
    ];

}


