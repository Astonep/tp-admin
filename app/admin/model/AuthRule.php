<?php
namespace app\admin\model;

use \think\Config;
use \think\Model;
use \think\Session;


/**
 * 权限规则
 *
 * @author chengbin
 */
class AuthRule extends Admin
{
    public function getList($request)
    {
        $request = $this->fmtRequest( $request );
        return $this->where($request['map'])->limit($request['offset'], $request['limit'])->select();
    }

    public function getStatusAttr($value)
    {
        // $status = self::getAllStatus();
        // return $status[$value];
    }

    public function saveData($data)
    {
        if(isset($data['rule_val'])) {
            $data['rule_val'] = strtolower($data['rule_val']);
        }
        $data['pid'] = $this->initParentId( $data['rule_val'] );
        if(isset($data['id']) && !empty($data['id'])) {
            $this->allowField(true)->save($data, ['id' => $data['id']]);
        } else {
            $this->insert($data);
        }
    }

    //是否需要检查节点，如果不存在权限节点数据，则不需要检查
    public function isCheck( $rule_val )
    {
        $rule_val = strtolower($rule_val);
        $map = ['rule_val'=>$rule_val];
        if($this->where($map)->count()){
            return true;
        }
        return false;
    }

    public function deleteById($id)
    {
        $result = AuthRule::destroy($id);
        if ($result > 0) {
            return info(lang('Delete succeed'), 1);
        }
    }

    public function initParentId( $rule_val )
    {
        $parentId = 0;
        if( count(explode('/', $rule_val)) <= 2 ) {
            return $parentId;
        }
        $parent_rule_val =  substr($rule_val, 0, strrpos($rule_val, '/'));
        $map = ['rule_val'=>$parent_rule_val];
        $parentId = $this->where($map)->value('id');
        if(empty($parentId)) {
            $parentData = [];
            $parentData['title'] = $this->_fmtTitle( $parent_rule_val );
            $parentData['pid'] = 0;
            $parentData['rule_val'] = $parent_rule_val;
            $parentData['update_time'] = time();
            $parentId = $this->insertGetId($parentData);
        }
        return $parentId;
    }

    private function _fmtTitle( $parent_rule_val )
    {
        $ex_tmp = explode('/', $parent_rule_val);
        $title = '';
        if(!empty($ex_tmp)) {
            foreach($ex_tmp as $val) {
                $tmp[] = ucwords($val);
            }
            $title = implode('/', $tmp);
            unset($tmp);
        }
        unset($ex_tmp);
        return $title;
    }

    public function getLevelData()
    {
        $data = $this->order('pid asc')->select();
        if( empty($data) ) {
            return $data;
        }

        $ret = [];
        foreach($data as $val) {
            if( $val->pid == 0 ) {
                $ret[$val->id] = ['id'=>$val->id,'title'=>$val->title,'pid'=>$val->pid, 'rule_val'=>$val->rule_val];
            } elseif (isset($ret[$val->pid])) {
                $ret[$val->pid]['children'][] = ['id'=>$val->id,'title'=>$val->title,'pid'=>$val->pid, 'rule_val'=>$val->rule_val];
            }
        }
        return $ret;
    }
}
