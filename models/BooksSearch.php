<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Books;

/**
 * BooksSearch represents the model behind the search form about `app\models\Books`.
 */
class BooksSearch extends Books
{

    public $date_start;
    public $date_end;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id'], 'integer'],
            [['name', 'preview', 'date', 'date_create', 'date_update'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        if (!isset($params["BooksSearch"])) {
            if (isset(Yii::$app->session["BooksSearch"])){
                $params["BooksSearch"] = Yii::$app->session["BooksSearch"];
            }
        } else {
            Yii::$app->session["BooksSearch"] = $params["BooksSearch"];
        }

        $query = Books::find();

        if ($params['BooksSearch']['author_id'] == -1) {
          unset($params['BooksSearch']['author_id']);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }



        $query->andFilterWhere([
            'id' => $this->id,
            'author_id' => $this->author_id,
            //'date' => $this->date,
            //'date_create' => $this->date_create,
            //'date_update' => $this->date_update,
        ]);


        $query->andFilterWhere(['like', 'name', $this->name])
        //    ->andFilterWhere(['like', 'preview', $this->preview])
        ;

        if (!empty($params['BooksSearch']['date_start'])) {
           //\Yii::info($params['BooksSearch']['date_start'], 'xlog');
           $query->andFilterWhere(['>=', 'date', \Utils::convertDate($params['BooksSearch']['date_start'])]);
           $this->date_start = \Utils::convertDate($params['BooksSearch']['date_start']);
        }

        if (!empty($params['BooksSearch']['date_end'])) {
           $query->andFilterWhere(['<=', 'date', \Utils::convertDate($params['BooksSearch']['date_end'])]);
           $this->date_end = \Utils::convertDate($params['BooksSearch']['date_end']);
        }

        return $dataProvider;
    }
}
