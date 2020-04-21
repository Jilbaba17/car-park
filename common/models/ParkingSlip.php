<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "entry".
 *
 * @property integer $tagid
 * @property string $intime
 * @property string $outtime
 * @property integer $status
 */
class ParkingSlip extends \yii\db\ActiveRecord
{
	const SCENARIO_CHECKIN = 'checkIn';
	const SCENARIO_CHECKOUT = 'checkOut';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parking_slip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['status'], 'default', 'value' => 1],
            [['tagid', 'intime', 'status'], 'required', 'on' => 'checkIn'],
        	[['tagid', 'outtime', 'status'], 'required', 'on' => 'checkOut'],
            [['tagid', 'status'], 'integer'],
        	['tagid', 'validateCheckinStatus', 'on' => 'checkOut'],
        	[['tagid'], 'exist', 'targetAttribute' => 'tagid', 'targetClass' => ParkingLot::className()],
        	[['tagid'], 'validateCheckin', 'on' => 'checkIn'],
        	[['tagid'], 'validateCheckinFull', 'on' => 'checkIn'],	
        	
            [['intime', 'outtime'], 'safe'],
        ];
    }
    
    public function validateCheckin($attribute) {
    	if(!$this->hasErrors()) {
	    	$checkInCount = $this->find()
		    	->where(['AND', ['=', 'tagid', $this->tagid], ['=', 'status', 1]])
		    	->count();
	    	if($checkInCount > 0) {
	    		$this->addError($attribute, 'This vehicle has already been checked in');
	    		
	    	}
    	}
    }
    
    public function validateCheckinStatus($attribute) {
    	if(!$this->hasErrors()) {
    		if($this->scenario == ParkingSlip::SCENARIO_CHECKOUT && $this->status != 1) {
    			$this->addError($attribute, 'This vehicle has not been checked in');
    		}
    	}
    }
    
    public function validateCheckinFull($attribute) {
    	if(!$this->hasErrors()) {
    		$customerId = ParkingLot::findOne($this->tagid)->customer_id;
    		$subQuery = ParkingLot::find()->where('customer_id=' . $customerId)->select('tagid');
    		$customerCheckinCount = ParkingSlip::find()
    		->where('status=1')
    		->andWhere(['IN', 'tagid', $subQuery])
    		->count();
    		$totalSlots = Customer::findOne($customerId)->noslots;
    		//echo "$totalSlots ===> $companyCheckinCount"; die;
    		
    		if($customerCheckinCount == $totalSlots) {
    			$this->addError($attribute, 'There are no slots available for this company');
    		}
    		
    	}
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tagid' => Yii::t('app', 'Tag ID'),
            'intime' => Yii::t('app', 'Intime'),
            'outtime' => Yii::t('app', 'Outtime'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
