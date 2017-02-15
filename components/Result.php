<?php
namespace app\components;

use yii\base\Component;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrorInfo
 *
 * @author hamed
 */
class Result extends Component{
    //put your code here
    public  $status;
    public $errors=[];
    public $data=[];
    
    function __construct($status,$errors,$data) {
       parent::__construct();
       $this->status=$status;
       if($errors!=null){
            $this->errors=$errors;
       }
       if($data!=null){
       $this->data=$data;
       }
   }
    
}
