<?php


namespace app\models;


use yii\db\ActiveRecord;

class Contact extends ActiveRecord
{
    public function getId()
    {
        return $this->getPrimaryKey();
    }
}