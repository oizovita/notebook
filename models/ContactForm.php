<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $contact;
    public $name;
    public $birthday;
    public $photo;
    public $phone;
    public $country;
    public $city;
    public $email;
    public $facebook;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'phone', 'country', 'city', 'birthday'], 'required'],
            ['name', 'unique', 'targetClass' => '\app\models\Contact', 'message' => 'This name has already been taken.'],
            ['phone', 'unique', 'targetClass' => '\app\models\Contact', 'message' => 'This phone has already been taken.'],
            ['phone','string',  'min' => 10, 'max' => 12],
            [['photo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\Contact', 'message' => 'This email address has already been taken.'],
        ];
    }



    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function addNewContact()
    {

        if (!$this->validate()) {
            return null;
        }

        $this->contact = new Contact();
        $this->contact->user_id = Yii::$app->user->getId();
        $this->contact->name = $this->name;
        $this->contact->birthday = $this->birthday;
        $this->contact->photo = $this->photo;
        $this->contact->email = $this->email;
        $this->contact->phone = $this->phone;
        $this->contact->country = $this->country;
        $this->contact->city = $this->city;
        $this->contact->facebook = $this->facebook;
        return $this->contact->save() ? $this->contact : null;
    }


    public function getID(){
        return $this->contact->getId();
    }


}
