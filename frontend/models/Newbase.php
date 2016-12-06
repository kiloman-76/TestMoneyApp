<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Test;
/**
 * ContactForm is the model behind the contact form.
 */
class Newbase extends Model
{
    public $name;
    public $lastname;
    public $age;

    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'lastname', 'age'], 'required'],

        ];
    }

    public function newbase(){
        if (!$this->validate()) {
            return null;
        }
        $testitem = new Test();
        $testitem->name = $this->name;
        $testitem->lastname =  $this->lastname;
        $testitem->age = $this->age;
        $testitem->save();
    }

}
