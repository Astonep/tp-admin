<?php
namespace app\admin\controller;

use think\Loader;


/**
* 用户管理
* @author aierui github  https://github.com/Aierui
* @version 1.0 
*/
class User extends Admin
{

    function _initialize()
    {
        parent::_initialize();
    }

    /**
     * 列表
     */
    public function index()
    {
        return view();
    }

    /**
     * 异步获取列表数据
     *
     * @author chengbin
     * @return mixed
     */
    public function getList()
    {
        if(!request()->isAjax()) {
            $this->error(lang('Request type error'), 4001);
        }

        $request = request()->param();
        $data = model('User')->getList( $request );
        return $data;
    }

    /**
     * 添加
     */
    public function add()
    {
        $roleData = model('role')->getKvData();
        $this->assign('roleData', $roleData);
        return $this->fetch('edit');
    }

    /**
     * 编辑
     * @param  string $id 数据ID（主键）
     */
    public function edit($id = 0)
    {   
        if(intval($id) < 0){
            return info(lang('Data ID exception'), 0);
        }
        if (intval($id == 1)) {
            return info(lang('Edit without authorization'), 0);
        }
        $roleData = model('role')->getKvData();
        $this->assign('roleData', $roleData);
        $data = model('User')->get(['id'=>$id]);
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 保存数据
     * @param array $data
     *
     * @author chengbin
     */
    public function saveData()
    {
        $this->mustCheckRule( 'admin/user/edit' );
        if(!request()->isAjax()) {
            return info(lang('Request type error'));
        }

        $data = input('post.');
        return model('User')->saveData( $data );
    }

    /**
     * 删除
     * @param  string $id 数据ID（主键）
     */
    public function delete($id = 0){
        if(empty($id)){
            return info(lang('Data ID exception'), 0);
        }
        if (intval($id == 1)) {
            return info(lang('Delete without authorization'), 0);
        }
        return Loader::model('User')->deleteById($id);
    }

   
}