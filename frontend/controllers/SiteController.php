<?php
namespace frontend\controllers;

use common\controllers\MainController;
use common\models\Company;
use common\models\Entry;
use common\models\TagMaster;
use common\models\User;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use yii\base\InvalidParamException;
use yii\db\Expression;
use yii\web\BadRequestHttpException;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends MainController {
	/**
	 * @inheritdoc
	 */
//     public function behaviors()
	//     {
	//         return [
	//             'access' => [
	//                 'class' => AccessControl::className(),
	//                 'only' => ['logout', 'signup'],
	//                 'rules' => [
	//                     [
	//                         'actions' => ['signup'],
	//                         'allow' => true,
	//                         'roles' => ['?'],
	//                     ],
	//                     [
	//                         'actions' => ['logout'],
	//                         'allow' => true,
	//                         'roles' => ['@'],
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
	public function actions() {
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
		if (\Yii::$app->request->isAjax) {
			\Yii::$app->response->format = Response::FORMAT_JSON;

			// Get total company slots
			$companySpaces = Company::findOne(\Yii::$app->user->identity['company_id'])->noslots;
			// Get available company slots
			$subQuery = TagMaster::find()
				->select('tagid')
				->where('company=' . \Yii::$app->user->identity['company_id']);

			$takenSpaces = Entry::find()
				->select('tagid')
				->where(['IN', 'tagid', $subQuery])
				->andWhere(['AND', 'status=1'])
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
			->where('id=' . \Yii::$app->user->id)
			->select(new Expression("id, CONCAT_WS(' ', firstName, lastName) AS names"))
			->asArray()
			->one();
		///var_dump($availableSpaces); die;
		return $this->render('index', [
			'user' => $user,
			'companyName' => Company::findOne(\Yii::$app->user->identity['company_id'])->name,

		]);
	}

	/**
	 * Logs in a user.
	 *
	 * @return mixed
	 */
	public function actionLogin() {
		if (!Yii::$app->user->isGuest) {

			return $this->goHome();
		}
		die("fdgfdg");
		return $this->redirect(['user/security/login']);
		// $model = new LoginForm();
		// if ($model->load(Yii::$app->request->post()) && $model->login()) {
		//     return $this->goBack();
		// } else {
		//     return $this->render('login', [
		//         'model' => $model,
		//     ]);
		// }
	}

	/**
	 * Logs out the current user.
	 *
	 * @return mixed
	 */
	public function actionLogout() {
		Yii::$app->user->logout();

		return $this->goHome();
	}

	/**
	 * Displays contact page.
	 *
	 * @return mixed
	 */
	public function actionContact() {
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
	public function actionAbout() {
		return $this->render('about');
	}

	/**
	 * Signs user up.
	 *
	 * @return mixed
	 */
	public function actionSignup() {
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
	public function actionRequestPasswordReset() {
		$model = new PasswordResetRequestForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail()) {
				Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

				return $this->goHome();
			} else {
				Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
			}
		}

		return $this->render('requestPasswordResetToken', [
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
	public function actionResetPassword($token) {
		try {
			$model = new ResetPasswordForm($token);
		} catch (InvalidParamException $e) {
			throw new BadRequestHttpException($e->getMessage());
		}

		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
			Yii::$app->session->setFlash('success', 'New password saved.');

			return $this->goHome();
		}

		return $this->render('resetPassword', [
			'model' => $model,
		]);
	}
}
