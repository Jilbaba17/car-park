<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\LoginForm;
use common\models\Customer;
use yii\helpers\ArrayHelper;
use common\models\ParkingSlip;
use yii\web\Response;
use common\models\ParkingLot;
use common\controllers\MainController;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends MainController
{
    /**
     * @inheritdoc
     */
//     public function behaviors()
//     {
//         return [
//             'access' => [
//                 'class' => AccessControl::className(),
//                 'rules' => [
//                     [
//                         'actions' => ['login', 'error'],
//                         'allow' => true,
//                     ],
//                     [
//                         'actions' => ['logout', 'index'],
//                         'allow' => true,
//                         'roles' => ['SUPER_ADMIN'],
//                     ],
//                 ],
//             ],
//             'verbs' => [
//                 'class' => VerbFilter::className(),
//                 'actions' => [
//                     'logout' => ['post'],
//                 ],
//             ],
//         ];
//     }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($companyId = 0, $operation = 'checkIn') {
    	// if ajax call
    	if(\Yii::$app->request->isAjax && $companyId > 0) {
    		\Yii::$app->response->format = Response::FORMAT_JSON;
    		
    		// Get total company slots
    		$companySpaces = Customer::findOne($companyId)->noslots;
    		// Get available company slots
    		$subQuery = ParkingLot::find()
    		->select('tagid')
    		->where('company=' . $companyId);
    		
    		$takenSpaces = ParkingSlip::find()
    		->select('tagid')
    		->where(['IN', 'tagid', $subQuery])
//     		->andWhere(['AND', 'DATE(intime) = DATE(NOW())', 'outtime IS NULL'])
    		->andWhere(['=', 'status', 1])
    		->count();
    		$availableSpaces = $companySpaces - $takenSpaces;
    		$parkingAvailablePercentage = floor(($takenSpaces / $companySpaces) * 100);
    		
    		return [
    			'companySpaces' => $companySpaces,
    			'availableSpaces' => $availableSpaces,
    			'takenSpaces' => $takenSpaces,
    			'parkingAvailablePercentage' => $parkingAvailablePercentage
    		];
    	}
    	// Build company map and send it to view
    	$companyMap = ArrayHelper::map(Customer::find()
    	->select('cid, name')
        ->asArray()
    	->all(), 'cid', 'name');
    	//print_r(\Yii::$app->session->getAllFlashes(true)); die;
    	//echo $operation; die;
    	///var_dump($availableSpaces); die;
        return $this->render('index', [
        	'model' => new ParkingSlip(['scenario' => $operation]),
        	'companyMap' => $companyMap,
        	'operation' => $operation
        ]);
    }
    
    

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } 
        
        return $this->render('login', [
        	'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
