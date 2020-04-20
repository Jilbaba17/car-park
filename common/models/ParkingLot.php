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
					ActiveRecord::EVENT_BEFORE_INSERT => ['created_on'],
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
            [['car_model', 'car_regno', 'tagstatus', 'employee_code', 'customer_id'], 'required', 'on' => self::SCENARIO_ASSIGN],
        	[['tagid', 'tagstatus', 'employee_code'], 'integer'],
            [['doissue'], 'safe'],
        	[['tagid'], 'required'],
        	
            [['car_model'], 'string', 'max' => 50],
            [['employee_code'], 'required', 'on' => self::SCENARIO_ASSIGN],
            [['car_regno'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tagid' => Yii::t('app', 'Tagid'),
            'employee_code' => Yii::t('app', 'Employee'),
            'customer_id' => Yii::t('app', 'Customer'),
            'car_model' => Yii::t('app', 'Vehicle Model'),
            'car_regno' => Yii::t('app', 'Vehicle Registration'),
            'tagstatus' => Yii::t('app', 'Tag Status'),
            'doissue' => Yii::t('app', 'Date of issue'),
        ];
    }
    
    public function getUser() {
    	return $this->hasOne(User::className(), ['id' => 'employee_code'])
    	->select(new Expression("id, CONCAT_WS(' ', firstName, lastName) AS names"));
    }
    
    public function getCustomer() {
    	return $this->hasOne(Customer::className(), ['cid' => 'company'])->select('cid, name');
    }
    
    public function getProfile() {
    	return $this->hasOne(Profile::className(), ['user_id' => 'employee_code'])->select('user_id, department');
    }
}
