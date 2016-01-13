<?php

namespace app\models\interface_file;


/* 与活动有关的功能接口 */
interface IActivityManger {
	
	
	/* 
	 * 根据活动名字查询活动
	 * @return array($activity)
	 *  */
	public function getActivityByActName($actName);
	
	
	/* 
	 * 根据活动时间查询活动 
	 * @return array($activity)
	 * @param $date eg:2012
	 *  */
	public function getActivityByDate($date);
	
	
	/* 
	 * 根据参与者姓名查询活动    ?考虑同名处理
	 * @return array($activity)
	 * */
	public function getActivityByPartName($name);
	
	
	/* 
	 * 根据参与者ID查询活动
	 * @return array($activity)
	 *  */
	public function getActivityByParyId($id);
	
	
}