<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 25.04.15
 * Time: 19:57
 */

class User extends CActiveRecord
{
    public $username;
    public $password;

    private $_identity;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'phonebook_users';
    }

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('username, password', 'required'),
            // password needs to be authenticated
            array('password', 'authenticate'),
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }



    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('username',$this->username,true);
        /*$criteria->compare('password',$this->password,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('dtime_register',$this->dtime_register,true);
        $criteria->compare('cookie',$this->cookie,true);*/

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'username'=>'Логин',
            'password'=>'Пароль',
        );
    }


    public function authenticate() {
        if(!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            if(!$this->_identity->authenticate()) {
                $this->addError('password', 'Incorrect username or password');
            }
        }
    }

    public function login() {
        if($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }

        if($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = 3600*24*30;
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        }
        else {
            return false;
        }
    }

}