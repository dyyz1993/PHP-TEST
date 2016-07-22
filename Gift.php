<?php
require 'lib/Db.php';
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
        return $this->get_rand($arr);
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