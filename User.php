<?php
require_once '../lib/Db.php';
class User{
    private $table="user";
    private $db;
    private $openid;
    
    public function __construct($arr){
        $this->db=Db::instance("user");
        $this->insert($arr);
        
    }
    
    
    /**
     * 获取用户的信息，存入数据中
     * @param unknown $arr
     */
    public function insert($arr){
        $this->openid=$arr['openid'];
        //1.判断是否有数据
        $result = $this->query($arr['openid']);
        if(isset($reuslt))
        {
            //没有数据
            $data=array("openid"=>$arr['openid'],"nickname"=>$arr['nickname'],"headimgurl"=>$arr['headimgurl']);
            //插入数据库
            return $this->db->insert($this->table)->cols($data)->query();
        }else{
            //有数据
            $openid =$arr['openid'];
            $data=array("nickname"=>$arr['nickname'],"headimgurl"=>$arr['headimgurl']);
            return $this->db->update($this->table)->cols($data)->where("openid='$openid'")->query();
			echo "";
        }
        
        
    }
    
    public function query($openid){
        
        return $this->db->select("*")->from($this->table)->where("openid='$openid'")->row();
        
    }
    
    /**
     * 该用户是否有抽奖资格
     * 上一次的抽奖时间
     */
    public function getRaffleTimes(){
        $result = $this->db->select("lastTime")->from($this->table)->where("openid='$this->openid'")->single();
        if($result&&$result==date("Y/m/d"))
        {
        //不能抽奖
            echo "no";
        }else{
        //可以抽奖
            echo "yes";
        }
    }
    
    /**
     * 抽奖,修改当前的时间
     * 
     */
    public function runRaffle(){
        $this->db->update($this->table)->cols(array("lastTime"=>date("Y/m/d")))->where("openid='$this->openid'")->query();    
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}


