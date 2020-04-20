<?php
namespace backend\controllers;

use common\models\Customer;
use yii\web\Response;
use common\models\CityMaster;
use common\models\Block;
use common\controllers\MainController;
use yii\web\NotFoundHttpException;
use yii\db\Query;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

class CompanyController extends MainController {
	
	public function actionIndex() {
	
		//if(\Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id) == 'COMPANY_ADMIN') {
		if(\Yii::$app->request->isAjax) {
			\Yii::$app->response->format = Response::FORMAT_JSON;
			$rsCompanies = Customer::find()
			->with(['building'])
			->asArray()
			->all();
			return [
				'data' => $rsCompanies
			];
		}
		
		return $this->render('index');
	}
	
	public function actionCreate() {
		$model = new Customer();
		if(\Yii::$app->request->isPost) {
			$this->save($model);
		}
		return $this->render('create', [
			'model' => $model
		]);
	}
	/**
	 * 
	 * @return string
	 */
	public function actionCsvInfo() {
		$content = '';
		$content = Html::img(\Yii::$app->homeUrl . 'images/company-csv.jpg');
		return $content;
	}
	
	public function actionUpdate($cid) {
		$model = $this->findModel($cid);
		if(\Yii::$app->request->isPost) {
			$this->save($model);
		}
		return $this->render('update', [
			'model' => $model
		]);
	}
	
	private function save(Customer &$model) {
		
		if( $model->load(\Yii::$app->request->post()) && $model->validate()) {
			$model->save(false);
			\Yii::$app->session->addFlash('success', 'Company saved successfully', false);
			return $this->redirect('index');
		}
		return $model;
		
		
	}
	
	public function actionAddCity() {
		return $this->redirect('//city/create', [
			'model' => new CityMaster()
		]);
	}
	
	public function actionAddBuilding() {
		return $this->redirect('//building/create', [
			'model' => new Block()
		]);
	}
	
	/**
	 *
	 * @param string $q
	 * @param string $id
	 * @return string
	 */
	public function actionGetCompanies($q = null, $id = null) {
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = ['results' => ['id' => '', 'text' => '']];
		if (!is_null($q)) {
			$query = new Query();
			$query->select('cid AS id, name AS text')
			->from(Customer::tableName())
			->where(['like', 'name', $q])
			->limit(20);
			$command = $query->createCommand();
			$data = $command->queryAll();
			
			$out['results'] = array_values($data);
		}
		elseif ($id > 0) {
			$out['results'] = ['id' => $id, 'text' => Customer::find($id)->name];
		}
		return $out;
	}
	
	public static function clean($val) {
		$val['text'] = rawurlencode($val['text']);
		return $val;
	}
	
	/**
	 * Finds the Company model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Customer the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		
		if (($company = Customer::findOne($id)) !== null) {
			//echo $invoiceModel->scenario;
			
			return $company;
		}
		throw new NotFoundHttpException('The requested company does not exist.');
		
	}
	
	
}