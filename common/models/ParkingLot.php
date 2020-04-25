<?php

namespace common\models;

use Yii;
use yii\db\Expression;
use dektrium\user\models\Profile;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tag_master".
 *
 * @property integer $tagid
 * @property integer $customer_id
 * @property string $employee_code
 * @property string $car_model
 * @property string $car_regno
 * @property integer $tagstatus
 * @property string $doissue
 */
class ParkingLot extends \yii\db\ActiveRecord {
	const SCENARIO_ASSIGN = 'assign';
	/**
	 * 
	 * {@inheritDoc}
	 * @see \yii\base\Component::behaviors()
	 */
	public function behaviors(){
		return [
			[
				'class' => TimestampBehavior::className(),
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => ['park_created_on'],
					ActiveRecord::EVENT_BEFORE_UPDATE => null,
				],
				// if you're using datetime instead of UNIX timestamp:
				'value' => new Expression('NOW()'),
			],
		];
	}
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parking_lot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['park_car_model', 'park_car_regno', 'park_tagstatus', 'park_employee_code', 'park_customer_id'], 'required', 'on' => self::SCENARIO_ASSIGN],
        	[['park_tagid', 'park_tagstatus', 'park_employee_code'], 'integer'],
            [['park_doissue'], 'safe'],
        	[['park_tagid'], 'required'],
            [['park_tagid'], 'unique'],
        	
            [['park_car_model'], 'string', 'max' => 50],
            [['park_employee_code'], 'required', 'on' => self::SCENARIO_ASSIGN],
            [['park_car_regno'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'park_tagid' => Yii::t('app', 'Slot ID'),
            'park_employee_code' => Yii::t('app', 'Employee'),
            'park_customer_id' => Yii::t('app', 'Customer'),
            'park_car_model' => Yii::t('app', 'Vehicle Model'),
            'park_car_regno' => Yii::t('app', 'Vehicle Registration'),
            'park_tagstatus' => Yii::t('app', 'Tag Status'),
            'park_doissue' => Yii::t('app', 'Date of issue'),
        ];
    }
    
    public function getUser() {
    	return $this->hasOne(User::className(), ['user_id' => 'park_employee_code'])
    	->select(new Expression("user_id, CONCAT_WS(' ', user_firstName, user_lastName) AS names"));
    }
    
    public function getCustomer() {
    	return $this->hasOne(Customer::className(), ['customer_id' => 'park_customer_id'])->select('customer_id, customer_name');
    }
    

}
