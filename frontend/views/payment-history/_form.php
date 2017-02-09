<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PaymentHistory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-history-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_from')->textInput() ?>

    <?= $form->field($model, 'user_to')->textInput() ?>

    <?= $form->field($model, 'payment')->textInput() ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
