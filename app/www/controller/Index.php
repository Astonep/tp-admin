<?php
namespace app\www\controller;

use app\common\controller\Common;

class Index extends Common
{
    const LOGIN_URL = '/admin/login/index';
    public function index()
    {
        $this->redirect(self::LOGIN_URL);
    }
}