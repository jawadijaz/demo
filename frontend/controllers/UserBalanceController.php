<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\UserBalance;
use common\models\PaymentHistory;
use frontend\models\UserBalanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * UserBalanceController implements the CRUD actions for UserBalance model.
 */
class UserBalanceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserBalance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserBalanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Add a new UserBalance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTransfer()
    {
        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new UserBalance();
        if ($model->load(Yii::$app->request->post())) {
            $user = User::find()->where(["username" => $model->user_id])->one();

            if(!empty($user)) {
                $model->user_id = $user->id;
            } else {
                $user = User::addUser($model->user_id);
                $model->user_id = $user->id;
            }

            $balance_to = UserBalance::find()->where(["user_id" => $model->user_id])->one();
            if(empty($balance_to)) {
                $balance_to = new UserBalance();
                $balance_to->user_id = $model->user_id;
                $balance_to->balance = $model->balance;
            } else {
                $balance_to->balance = $balance_to->balance + $model->balance;
            }
            
            $check = UserBalance::subtractMyBalance($model->balance);

            if($check) {
                if($balance_to->save(false)) {
                    PaymentHistory::recordPayment($model->user_id, Yii::$app->user->id, $model->balance);
                    return $this->redirect(['index']);
                } else {
                    $check = UserBalance::fillMyBalanceBack($model->balance);
                    return $this->render('add', [
                        'model' => $model,
                    ]);
                }

            } else {
                return $this->render('add', [
                    'model' => $model,
                ]);
            }

        } else {
            return $this->render('add', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Finds the UserBalance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserBalance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserBalance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
