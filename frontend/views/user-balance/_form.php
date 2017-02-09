<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\UserBalance;
/* @var $this yii\web\View */
/* @var $model common\models\UserBalance */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="user-balance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>
    <?= $form->field($model, 'balance')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
	$this->registerJs("
		$('#userbalance-user_id').select2();
	");
?>