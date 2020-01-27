<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\models;
/**
 * Description of SignupForm
 *
 * @author HP
 */

use yii\base\Model;


class SignupForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;
    
    
    public function rules(){
            return [
            [['username', 'password', 'password_repeat'], 'required'],
            [['username', 'password'], 'string', 'min'=>4 , 'max'=>16],
            ['password_repeat', 'compare', 'compareAttribute'=>'password']
    ];
    }
    
    public function signup(){
     
        $user= new User();
        $user->username= $this->username;
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        $user->access_token= \Yii::$app->security->generateRandomString();
        $user->auth_key= \Yii::$app->security->generateRandomString();
        
        IF($user->save()){
            return true;
        }
        
        \Yii::error( 'User was not saved '. VarDumper::dumpAsString($user->errors));
        
        return false;
    }
}
