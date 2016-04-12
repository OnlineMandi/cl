<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form about `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'seller_id', 'category_id', 'quantity', 'price', 'market_price', 'status', 'soldout', 'created_at', 'updated_at'], 'integer'],
            [['name',  'description'], 'safe'],
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
    public function search($params , $seller_id = 0 , $category_id = 0)
    {
        $query = Product::find();
		if($seller_id){
			$query->where(['seller_id' => $seller_id]);
            $query->orderBy(['id' => SORT_ASC]);
		}else {
			$query->orderBy(['id' => SORT_ASC]);
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
            'seller_id' => $this->seller_id,
            'category_id' => $this->category_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'market_price' => $this->market_price,
            'status' => $this->status,
            'soldout' => $this->soldout,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
