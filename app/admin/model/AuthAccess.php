<?php
namespace app\admin\model;

use \think\Config;
use think\Db;
use \think\Model;
use \think\Session;


/**
 * 角色权限
 *
 * @author chengbin
 */
class AuthAccess extends Admin
{
    public function getRuleVals( $uid )
    {
        $role_id = model('User')->where(['id'=>$uid])->value('role_id');
        $rule_ids = model('AuthAccess')->where(['role_id'=>$role_id])->column('rule_id');
        return model('AuthRule')->where('id', 'in', $rule_ids)->column('rule_val');
    }

    public function getIds( $uid )
    {
        $role_id = model('User')->where(['id'=>$uid])->value('role_id');
        return model('AuthAccess')->where(['role_id'=>$role_id])->column('rule_id');
    }

    public function saveData( $role_id, $data )
    {
        if(empty($data)) {
            return info(lang('Save success'), 1);
        }
        Db::startTrans();
        try{
            $this->where(['role_id'=>$role_id])->delete();
            $insertData = [];
            foreach($data as $val) {
                $insertData[] = ['role_id'=>$role_id, 'rule_id'=>$val];
            }
            $this->insertAll( $insertData );
            Db::commit();
        }catch (\Exception $e) {
            Db::rollback();
        }
        return info(lang('Save success'), 1);
    }
}
