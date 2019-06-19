<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact}}`.
 */
class m190616_171410_create_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contact}}');
    }

    public function up()
    {

        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('contact', [
            'id' => $this->primaryKey(),
            'user_id' =>$this->integer(),
            'name' => $this->text()->notNull(),
            'birthday'=>$this->date(),
            'photo' => $this->text(),
            'phone' => $this->string(13)->notNull(),
            'country' => $this->text()->notNull(), //Номер категории
            'city' => $this->text()->notNull(),
            'email' => $this->string(30)->notNull()->unique(), // Название статьи
            'facebook' => $this->text(), // Сокращенный текст
        ], $tableOptions);
        $this->addForeignKey('user_id','contact','user_id', 'user', 'id');
    }
}
