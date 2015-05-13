<?php

class m150513_181135_create_phonebook_contacts extends CDbMigration
{
	public function up()
	{
        $this->createTable('phonebook_contacts', array(
            'id' => 'pk',
            'firstname' => "varchar(255) NOT NULL DEFAULT ''",
            'lastname' => "varchar(255) NOT NULL DEFAULT ''",
            'phone' => "varchar(15) NOT NULL DEFAULT ''",
            'date_added' => "datetime DEFAULT NULL",
        ));
	}

    public function safeDown()
    {
        $this->dropTable('phonebook_contacts');
    }
}