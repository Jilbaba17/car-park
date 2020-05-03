<?php

namespace app\controllers;

use app\models\AdminLoginForm;
use app\models\Block;
use app\models\CheckinForm;
use app\models\Floor;
use app\models\ParkingLot;
use app\models\ParkingSlip;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'get-block', 'get-slot'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'getBlock' => ['post'],
                    'getSlot' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @return string
     */
    public function actionIndex()
    {
        $model = new ParkingSlip();
        $floors = ArrayHelper::map(Floor::find()->select('floor_id, floor_number')->asArray()->all(), 'floor_id', 'floor_number');
        $model->scenario = ParkingSlip::SCENARIO_CHECKIN;
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $model->parking_slip_customerid = Yii::$app->user->identity->customer->customer_id;
            $model->parking_slip_datefrom = date('Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Parking slot reserved successfully, proceed to park');
                $model = new ParkingSlip();
            } else {
                Yii::$app->session->setFlash('danger', 'Parking slot was not reserved, contact the administrator');
            }

        }
        return $this->render('index', [
            'model' => $model,
            'floors' => $floors
        ]);
    }

    public function actionGetBlock()
    {
        $model = new CheckinForm();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $out = Block::find()
                ->select('block_id as id, block_code as name')
                ->where('block_floorid=:floor', [':floor' => $model->floor])
                ->asArray()
                ->all();

            return ['output' => $out, 'selected' => ''];
        }
        return ['output' => '', 'selected' => ''];
    }

    public function actionGetSlot()
    {
        $model = new CheckinForm();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if (!empty($model->park_blockid)) {
                if (isset($_GET['slotNum'])) {
                    $slotLimits = ParkingLot::find()
                        ->select('park_id, park_slotnumberfrom, park_slotnumberto')
//                    ->with('parkingSlip')
                        ->where('park_blockid=:block', [':block' => $model->park_blockid])
                        ->one();
                    $tSlots = $slotLimits->parkingslipTaken;
                    $out = [];
                    $takenSlots = [];
                    if (count($tSlots) > 0) {
                        $takenSlots = array_flip(ArrayHelper::getColumn($tSlots, 'parking_slip_slotnumber'));
                    }
                    $slotRange = range($slotLimits->park_slotnumberfrom, $slotLimits->park_slotnumberto);
                    foreach ($slotRange as $slot) {
                        if (isset($takenSlots[$slot])) {
                            continue;
                        }
                        $out[] = [
                            'id' => $slot,
                            'name' => $slot
                        ];

                    }
                    return ['output' => $out, 'selected' => ''];
                }

                $out = ParkingLot::find()
                    ->select('park_id as id, park_code as name')
                    ->where('park_blockid=:block', [':block' => $model->park_blockid])
                    ->asArray()
                    ->all();

                return ['output' => $out, 'selected' => ''];
            }

            return ['output' => '', 'selected' => ''];
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public
    function actionLogin()
    {
        $this->layout = 'login';
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
     * @return Response
     */
    public
    function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public
    function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public
    function actionAbout()
    {
        return $this->render('about');
    }
}
