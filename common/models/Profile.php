<?php
namespace common\models;

use dektrium\user\models\Profile as BaseProfile;


class Profile extends BaseProfile {
	
	
	public function rules() {
		$rules = parent::rules();
		$rules['gender_department'] = [['gender', 'department'], 'string'];
		return $rules;
	}
}