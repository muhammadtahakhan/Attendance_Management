<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\Url;
use app\models\EmpAttnd;


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionData()
    {
         $inputFile = Url::to('@web/uploads/')."list.dat";  
        //   print_r($inputFile);
        // $objPHPExcel = \PHPExcel_IOFactory::load($inputFile);
        //  print_r($objPHPExcel);
        // return $this->render('files');
//         $myfile = fopen('http://localhost/'.$inputFile, "r") or die("Unable to open file!");
//         print_r($myfile);
// echo fread($myfile,filesize('http://localhost/'.$inputFile));
// fclose($myfile);

// $fileconis = file_get_contents('http://localhost/'.$inputFile);
// print_r(explode("\n ",$fileconis));
// $model = new EmpAttnd();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }

$i = 0;
$lines = file('http://localhost/'.$inputFile);
foreach ($lines as $line_num => $line) {
   
    $model = new EmpAttnd();
    $model->date = date('Y/m/d', substr($line ,2,8));
    $model->time = substr($line ,8,4);
    $model->emp_id = substr($line ,-7,2);
    $model->save();

    // echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";

// echo "<br/><br/>";
// echo $i++;echo "<br />";
// echo $line; echo "<br />";
// echo substr($line ,2,8)." DATE <br>";
// echo substr($line ,8,4)." TIME <br>";
// echo substr($line ,-7,2)." EMP NO <br>";
}
    }

    /**
     * Login action.
     *
     * @return Response|string
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
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
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
    public function actionAbout()
    {
        return $this->render('about');
    }
}
