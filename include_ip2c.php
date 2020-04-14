<?php

class ip2country {

	public $mysql_host='mysql873.umbler.com';
	public $db_name='luckprize';
	public $db_user='luckpriz';
	public $db_pass='190290ff';
	public $table_name='ip2c';

	private $ip_num=0;
	private $ip='';
	private $country_code='';
	private $country_name='';
	private $con=false;

	function ip2country()
	{
		$this->set_ip();
	}

	public function get_ip_num()
	{
		return $this->ip_num;
	}
	public function set_ip($newip='')
	{
		if($newip=='')
		$newip=$this->get_client_ip();

		$this->ip=$newip;
		$this->calculate_ip_num();
		$this->country_code='';
		$this->country_name='';
	}
	public function calculate_ip_num()
	{
		if($this->ip=='')
		$this->ip=$this->get_client_ip();

		$this->ip_num=sprintf("%u",ip2long($this->ip));
	}
	public function get_country_code($ip_addr='')
	{
		if($ip_addr!='' && $ip_addr!=$this->ip)
		$this->set_ip($ip_addr);

		if($ip_addr=='')
		{
			if($this->ip!=$this->get_client_ip())
			$this->set_ip();
		}

		if($this->country_code!='')
		return $this->country_code;

		if(!$this->con)
		$this->mysql_con();

		$sq="SELECT country_code,country_name FROM ".$this->table_name. " WHERE ". $this->ip_num." BETWEEN begin_ip_num AND end_ip_num";
		$r=@mysql_query($sq,$this->con);

		if(!$r)
		return '';

		$row=@mysql_fetch_assoc($r);
		$this->close();
		$this->country_name=$row['country_name'];
		$this->country_code=$row['country_code'];
		return $row['country_code'];
	}

	public function get_country_name($ip_addr='')
	{
		$this->get_country_code($ip_addr);
		return $this->country_name;
	}

	public function get_client_ip()
	{
		$v='';
		$v= (!empty($_SERVER['REMOTE_ADDR']))?$_SERVER['REMOTE_ADDR'] :((!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR']: @getenv('REMOTE_ADDR'));
		if(isset($_SERVER['HTTP_CLIENT_IP']))
		$v=$_SERVER['HTTP_CLIENT_IP'];
		return htmlspecialchars($v,ENT_QUOTES);
	}

	public function mysql_con()
	{
		$this->con=@mysql_connect($this->mysql_host,$this->db_user,$this->db_pass);
		
		if(!$this->con)
		return false;

		if( !mysql_query('USE ' . $this->db_name))
		{
			$this->close();
			return false;
		}
		return true;

	}
	public function get_mysql_con()
	{
		return $this->con;
	}
	public function create_mysql_table()
	{
		if(!$this->con)
		return false;
		mysql_query('DROP table ' . $this->table_name,$this->con);
		return mysql_query("CREATE table " . $this->table_name ." (id int(10) unsigned auto_increment, begin_ip varchar(20),end_ip varchar(20),begin_ip_num int(11) unsigned,end_ip_num int(11) unsigned,country_code varchar(3),country_name varchar(150), PRIMARY KEY(id),INDEX(begin_ip_num,end_ip_num))ENGINE=MyISAM",$this->con);
	}

	public function close()
	{
		@mysql_close($this->con);
		$this->con=false;
	}
}
?>
