<?php
/* Пример простого клиента для работы с API SkyLots */
class SkyAPI_client{
	private $server='http://api.skylots.org/';		# Путь к API
	private $api_key;										# Ключ
	
	# Инициализация параметров
	function __construct($api_key){
		$this->api_key=$api_key;
	}
	
	# Получение данных с API сервера
	public function get_data($options){ 
		$file=file_get_contents($this->server."?key=".$this->api_key.'&'.$options);  
		if($file!=false)
			$data=json_decode($file,true); 
		if(is_array($data))
			return $data;
		else
			return false;
	}
	
	# Получение информации о пользователе
	# $user_id - id пользователя 
	public function get_user_info($user_id){
		return $this->get_data("seller=".intval($user_id)."&get=user_info");
	}
	
	# Получение информации о 50 лотах пользователя
	# $user_id - id пользователя 
	# $orderby - сортировка, rand - случайная, none - по дате выставления
	# $cat_id  - id категории 
	public function get_last_lots($user_id, $orderby="none",$cat_id=0){
		$q="";
		if($cat_id!=0)
			$q="&catid=".intval($cat_id);
		if($orderby=="rand")
			$q.="&orderby=rand";
		return $this->get_data("seller=".intval($user_id)."&get=lots".$q);
	}
	
	# Получение информации о последних 50 отзывах
	# $user_id - id пользователя 
	public function get_last_reviews($user_id){
		return $this->get_data("seller=".intval($user_id)."&get=last_reviews");
	}
	
	# Проверка связи с сервером API 
	public function get_status(){
		$data=$this->get_data("");
		if(is_array($data))
			if(array_key_exists('status',$data))
				if($data['status']=="ok")
					return true;
		return false;
	}
}