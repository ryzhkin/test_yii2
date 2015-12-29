<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $preview
 * @property integer $author_id
 * @property string $date
 * @property string $date_create
 * @property string $date_update
 *
 * @property Authors $author
 */
class Books extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['author_id'], 'integer'],
            [['date', 'date_create', 'date_update'], 'safe'],
            [['name'], 'string', 'max' => 255],
            //[['preview'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['preview'], 'file', 'extensions' => 'jpeg, gif, png, jpg', 'on' => ['insert', 'update']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'preview' => 'Превью',
            'author_id' => 'Автор',
            'date' => 'Дата выхода книги',
            'date_create' => 'Дата добавления книги',
            'date_update' => 'Дата обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }

    public function getAuthorName() {
      $author = $this->getAuthor();
      if (!empty($author)) {
        $author = $author->one();
        return $author->firstname.' '.$author->lastname;
      } else {
        return 'автор не определен';
      }
    }

    /**
     * @inheritdoc
     * @return BooksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BooksQuery(get_called_class());
    }



}
