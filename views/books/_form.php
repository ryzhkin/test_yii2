<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Authors;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Название') ?>

    <?/*= $form->field($model, 'preview')->textInput(['maxlength' => true])->label('Превью') */?>
    <?php if (!empty($model->preview)) {
    ?>
      <img src="/uploads/<?= $model->preview ?>" style="width: 100px;"/>
    <?php } ?>
    <?= $form->field($model, 'preview')->fileInput([])->label('Превью') ?>



   <!-- --><?/*= $form->field($model, 'author_id')->textInput() */?>
    <?= $form->field($model, 'author_id', ['options' => []])->dropDownList(Authors::dropDownList(), ['empty'=>'(Select a Author)'])->label('Автор') ?>
    <div style="position: relative;">
        <?= $form->field($model, 'date')->textInput(['class' => 'form-control bdi', 'value' => date( 'd/m/Y', strtotime($model->date))]) ?>
    </div>
    <?/*= $form->field($model, 'date')->input('date', ['class' => 'bootstrap-date'])->label('Дата выхода книги') */?>


    <?/*= $form->field($model, 'date_create')->textInput(['disabled' => 'disabled'])->label('Дата добавления') */?>
    <div style="position: relative;">
      <?= $form->field($model, 'date_create')->textInput(['class' => 'form-control bdi', 'value' => date( 'd/m/Y', strtotime($model->date_create))]) ?>
    </div>

    <?= $form->field($model, 'date_update')->textInput(['disabled' => 'disabled'])->label('Дата обновления') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


