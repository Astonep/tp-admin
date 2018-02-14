<?php
namespace app\admin\model;

use think\Config;
use think\Db;
use think\Loader;
use think\Model;
use traits\model\SoftDelete;

class Order extends Admin
{
	public function getList( $request )
	{
		$request = $this->fmtRequest( $request );
		$data = $this->order('create_time desc')->where( $request['map'] )->limit($request['offset'], $request['limit'])->select();
		return $this->_fmtData( $data );
	}

	public function saveData( $data )
	{
		if( isset( $data['id']) && !empty($data['id'])) {
			$result = $this->edit( $data );
		} else {
			$result = $this->add( $data );
		}
		return $result;
	}


	public function add(array $data = [])
	{
		$userValidate = validate('Order');
		if(!$userValidate->scene('add')->check($data)) {
		    return info(lang($userValidate->getError()), 4001);
		}
		$data['create_time'] = time();
		$this->allowField(true)->save($data);
		if($this->id > 0){
            return info(lang('Add succeed'), 1, '', $this->id);
        }else{
            return info(lang('Add failed') ,0);
        }
	}

	public function edit(array $data = [])
	{
        $userValidate = validate('Order');
        if(!$userValidate->scene('add')->check($data)) {
            return info(lang($userValidate->getError()), 4001);
        }
		$res = $this->allowField(true)->save($data,['id'=>$data['id']]);
		if($res == 1){
            return info(lang('Edit succeed'), 1);
        }else{
            return info(lang('Edit failed'), 0);
        }
	}

	public function deleteById($id)
	{
		$result = Order::destroy($id);
		if ($result > 0) {
            return info(lang('Delete succeed'), 1);
        }   
	}

	//格式化数据
	private function _fmtData( $data )
	{
		if(empty($data) && is_array($data)) {
			return $data;
		}
		return $data;
	}

}
