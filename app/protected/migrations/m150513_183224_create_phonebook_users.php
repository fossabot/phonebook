<?php

class m150513_183224_create_phonebook_users extends CDbMigration
{
	public function up()
	{
        $this->createTable('phonebook_users', array(
            'id' => 'pk',
            'group' => "enum('USER','ADMIN') NOT NULL DEFAULT 'USER'",
            'username' => "varchar(50) NOT NULL DEFAULT ''",
            'password' => "varchar(32) DEFAULT NULL"
        ));
        $this->insert('phonebook_users', array(
            'group' => 'ADMIN',
            'username' => 'admin',
            'password' => md5('admin')
        ));
        $this->insert('phonebook_users', array(
            'group' => 'USER',
            'username' => 'user',
            'password' => md5('user')
        ));
	}

    public function safeDown()
    {
        $this->dropTable('phonebook_users');
    }
}