<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PaymentHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-history-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'attribute' => 'user_to',
                'value'     => function($data) {
                    return  $data->userTo->username;
                }
            ],
            'payment',
            [
                'attribute' => 'timestamp',
                'value'     => function($data) {
                    return date('M j Y g:i A', strtotime($data->timestamp));
                },
                'filter' => DatePicker::widget([
                    'model'         => $searchModel,
                    'attribute'     => 'timestamp',
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                        //'format' => 'M d, yyy'
                    ]
                ]),
                'filterInputOptions'=>[
                    'style' => 'width:120px',
                    'class' => 'form-control'
                ],
                'options' => ['style' => 'width: 25%'],
            ],

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
