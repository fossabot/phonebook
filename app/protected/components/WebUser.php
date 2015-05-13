<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 13.05.15
 * Time: 23:12
 */

class WebUser extends CWebUser {
    private $_model = null;

    function getRole() {
        if($user = $this->getModel()){
            return $user->group;
        }
    }

    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = User::model()->findByPk($this->id, array('select' => 'group'));
        }
        return $this->_model;
    }
}