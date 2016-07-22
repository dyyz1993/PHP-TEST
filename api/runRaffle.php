<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
require '../lib/Db.php';

$openid=$_SESSION['openid'];

//判断是否有资格抽奖
if(getRaffleTimes($openid)==1){
    $gift = new Gift();
    $prize = $gift->raffle();
    unset($prize['probability']);
    unset($prize['num']);
    runRaffle($openid);
    //存入数据库，中奖名单
    
    $cols = array(
        "openid"=>$openid,
        "getTime"=>date('Y-m-d H:i:s'),
        "gift_id"=>$prize['id']
    );
    Db::instance('user')->insert('user_gift')->cols($cols)->query();
    
    $arr= array(
        "type"=>"success",
        "status"=>1,
        "data"=>$prize
    );
}else{//不能抽奖
    $arr= array(
        "type"=>"fail",
        "status"=>-1,
        "data"=>null
    );
    
}

echo json_encode($arr);


/**
 * 抽奖,修改当前的时间
 *
 */
function runRaffle($openid){
    Db::instance('user')->update('user')->cols(array("lastTime"=>date("Y/m/d")))->where("openid='$openid'")->query();
}
function getRaffleTimes($openid){
    $result =Db::instance('user')->select("lastTime")->from('user')->where("openid='$openid'")->single();
    if($result&&$result==date("Y/m/d"))
    {
        //不能抽奖
        return 0;
    }else{
        //可以抽奖
        return 1;
    }
}

class Gift{
    private $prize_arr;
    private $table="gift";

    public function __construct(){
        $this->prize_arr=$this->get_Db();
    }

    /* 获取数据库中的信息 */
    private  function get_Db(){
        $arr = Db::instance('user')->select("*")->from($this->table)->query();
        return $arr;
    }

    /* 抽奖 */
    public function raffle(){
        foreach ($this->prize_arr as $key=>$val){
            $arr[$val['id']]=$val['num'];
        }
        $rid = $this->get_rand($arr);
        
        $this->update_Db($rid, 1);
        return $this->prize_arr[$rid-1];
       
        
    }


    /* 修改数据库信息 */
    public function update_Db($id,$num){
        $arr = Db::instance('user')->query("update `$this->table` set `num`=num-'$num' where id=2");
    }


    private function get_rand($proArr){
        $result='';
        $proSum=array_sum($proArr);
        foreach ($proArr as $key=>$proCur){
            $randNum=mt_rand(1, $proSum);
            if($randNum<=$proCur){
                $result=$key;
                break;
            }else{
                $proSum-=$proCur;
            }
        }
        unset($proArr);
        return $result;
    }

}

