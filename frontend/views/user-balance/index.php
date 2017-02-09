<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserBalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Balances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-balance-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'value'     => function($data) {
                    return  $data->user->username;
                }
            ],
            'balance',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
