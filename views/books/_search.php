<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Authors;

/* @var $this yii\web\View */
/* @var $model app\models\BooksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?/*= $form->field($model, 'id') */?>

    <?/*= $form->field($model, 'author_id') */?>
    <?= $form->field($model, 'author_id', ['options' => ['style' => 'width: 25%; display: inline-block; float: left; margin-right: 20px;']])->dropDownList(Authors::dropDownList(true), ['empty'=>'(Select a Author)']) ?>

    <?= $form->field($model, 'name', ['options' => ['style' => 'width: 25%; display: inline-block; float: left;']])->textInput() ?>
    <div style="clear: both;"></div>
    <?/*= $form->field($model, 'preview') */?>

    <div class="form-group field-bookssearch-date">
        <label class="control-label" for="bookssearch-date">Дата выхода книги</label>
        <div style="clear: both;"></div>
        <div style="position: relative; width: 150px; display: inline-block; float: left; margin-right: 20px;">
           <input id="bookssearch-date" class="form-control bdi" type="text" name="BooksSearch[date_start]" placeholder="Начальная дата" value="<?= (!empty($model->date_start))?date( 'd/m/Y', strtotime($model->date_start)):'' ?>">
        </div>
        <div style="position: relative; width: 150px; display: inline-block; float: left;">
          <input id="bookssearch-date" class="form-control bdi" type="text" name="BooksSearch[date_end]" placeholder="Конечная дата" value="<?= (!empty($model->date_end))?date( 'd/m/Y', strtotime($model->date_end)):'' ?>">
        </div>
        <div class="help-block"></div>
    </div>

    <?/*= $form->field($model, 'date') */?>

    <?php // echo $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'date_update') ?>

    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
        <?/*= Html::resetButton('Reset', ['class' => 'btn btn-default']) */?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
