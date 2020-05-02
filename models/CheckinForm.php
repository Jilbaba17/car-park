<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * CheckinForm is the model behind the check in form.
 *
 */
class CheckinForm extends Model
{
    public $floor, $park_blockid;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['floor', 'park_blockid'], 'safe'],
        ];
    }



}