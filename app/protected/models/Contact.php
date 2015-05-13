<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 08.05.15
 * Time: 17:02
 */

class Contact extends Model
{
    /**
     * First name
     * @var string
     */
    public $firstname;

    /**
     * Last name
     * @var string
     */
    public $lastname;

    /**
     * Date added
     * @var
     */
    public $date_added;


    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            // firstname, lastname and phone are required
            array('firstname, lastname, phone', 'required'),
        );
    }

        /**
     * @param string $className
     * @return CActiveRecord
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Название таблицы
     * @return string
     */
    public function tableName() {
        return 'phonebook_contacts';
    }

    /**
     * Связи
     * @return array
     */
    public function relations()
    {
        return array(

        );
    }
}