<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
              'attribute' => 'name',
              'label'     => 'Название',
            ],
            [
                'attribute' => 'preview',
                'label'     => 'Превью',
                'content'   => function($data){

                  // return Yii::$app->formatter->asDate(($data->date), 'd MMMM yyyy');
                  if (!empty($data->preview)) {
                    return '<a href="#" class="view-big-photo"><img src="/uploads/'.$data->preview.'" style="width: 50px;"/></a>';
                  }
                  return 'нет';
                },
            ],
            [
                'attribute' => 'author_id',
                'label'     => 'Автор',
                'content'   => function($data){
                   return $data->getAuthorName();
                },
            ],
            [
                'attribute' => 'date',
                'label'     => 'Дата выхода книги',
                'content'   => function($data){
                    return Yii::$app->formatter->asDate(($data->date), 'd MMMM yyyy');
                 },
            ],
            [
                'attribute' => 'date_create',
                'label'     => 'Дата добавления книги',
                'content'   => function($data){
                        $days = floor((strtotime($data->date) - strtotime($data->date_create))/(60*60*24));
                        $strings = [
                          'сегодня',
                          'вчера',
                          'позавчера',
                        ];
                        if ($days < 0) {
                          return 'это произойдет через '.abs($days).' дней';
                        }
                        return (isset($strings[$days]))?$strings[$days]:$days.' дней назад';
                        //return Yii::$app->formatter->asDate(($data->date_create), 'd MMMM yyyy');
                 },
            ],

            //'date_update',

            [
                'class'  => 'yii\grid\ActionColumn',
                'header' => 'Кнопки действий',
            ],
        ],
    ]); ?>

</div>


