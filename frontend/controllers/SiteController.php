<?php
namespace frontend\controllers;

use common\models\ParkingSlip;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use common\controllers\MainController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Customer;
use common\models\ParkingLot;
use yii\web\Response;
use common\models\User;
use yii\db\Expression;

/**
 * Site controller
 */
class SiteController extends MainController
{
    /**
     * @inheritdoc
     */
     public function behaviors()
     {
         return [
             'access' => [
                 'class' => AccessControl::className(),
                 'only' => ['logout', 'signup', 'index'],
                 'rules' => [
                     [
                         'actions' => ['signup'],
                         'allow' => true,
                         'roles' => ['?'],
                     ],
                     [
                         'actions' => ['logout', 'index'],
                         'allow' => true,
                         'roles' => ['@'],
                     ],
                 ],
             ],
             'verbs' => [
                 'class' => VerbFilter::className(),
                 'actions' => [
                     'logout' => ['post'],
                 ],
             ],
         ];
     }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {

        // if ajax call
    	if(\Yii::$app->request->isAjax) {
    		\Yii::$app->response->format = Response::FORMAT_JSON;

    		// Get total company slots
    		$companySpaces = Customer::findOne(\Yii::$app->user->identity['customer_id'])->noslots;
    		// Get available customer slots
    		$subQuery = ParkingLot::find()
    		->select('park_tagid')
    		->where('customer_id =' . \Yii::$app->user->identity['customer_id']);
    		
    		$takenSpaces = ParkingSlip::find()
    		->select('park_tagid')
    		->where(['IN', 'park_tagid', $subQuery])
    		->andWhere(['AND', 'park_tagstatus=1'])
    		->count();
    		$availableSpaces = $companySpaces - $takenSpaces;
    		$parkingAvailablePercentage = floor(($takenSpaces / $companySpaces) * 100);
    		
    		//print_r($user); die;
    		return [
    			'companySpaces' => $companySpaces,
    			'availableSpaces' => $availableSpaces,
    			'takenSpaces' => $takenSpaces,
    			'parkingAvailablePercentage' => $parkingAvailablePercentage,
    		];
    	}
    	$user = User::find()
    	->where('user_id=' . \Yii::$app->user->id)
    	->select(new Expression("user_id, CONCAT_WS(' ', user_firstName, user_lastName) AS names"))
    	->asArray()
    	->one();
    	///var_dump($availableSpaces); die;
        return $this->render('index', [
        		'user' => $user,
        		'companyName' => Customer::findOne(\Yii::$app->user->identity->user_customer_id)->customer_name,
        		
        		
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = '@common/views/layouts/login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
         $model = new LoginForm();
         if ($model->load(Yii::$app->request->post()) && $model->login()) {
             return $this->goBack();
         } else {
             return $this->render('login', [
                 'model' => $model,
             ]);
         }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('user/recovery/request', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('user/recovery/reset', [
            'model' => $model,
        ]);
    }
}

