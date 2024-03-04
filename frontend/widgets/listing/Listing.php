<?php
/**
 * Created by PhpStorm.
 * User: miller
 * Date: 14/01/24
 * Time: 19:03
 */

namespace frontend\widgets\listing;


use backend\modules\listing\models\ListingItem;
use common\helpers\Myfunctions;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use Yii;

class Listing extends Widget
{
    public $options = [];
    public $urls = [];
    public $itemBaseUrl;
    public $item;
    public $secondPageUrl; /** url of the page for rendering one item */


    public function init()
    {
        //parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        //Myfunctions::echoArray($this->urls);
        $baseUrl = Yii::$app->request->baseUrl;
        if ($this->urls[0] === ''){
            $this->itemBaseUrl = $this->secondPageUrl . '/';
            $this->item = ListingItem::findItemBySeoLink($this->urls[0]);
        }elseif ($this->urls[0] !== ''){
            $this->itemBaseUrl =  $this->urls[0] . '/';
            $this->item = ListingItem::findItemBySeoLink($this->urls[1]);
        }elseif ($this->urls[1] !== ''){
            $this->itemBaseUrl = $this->urls[0] . '/' . $this->urls[1] .'/';
            $this->item = ListingItem::findItemBySeoLink($this->urls[1]);
        }

        $cat = $this->options['category'];
        $items = ListingItem::findItemsByCategory($cat);


        $dataProvider = new ActiveDataProvider([
            'query' => $items,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);
        if ($this->item === null){
            return $this->render('items', [
                'dataProvider' => $dataProvider,
                'itemBaseUrl' => $this->itemBaseUrl,
            ]);
        }
        else{
            return $this->render('item', [
                'item' => $this->item,
            ]);
        }


        //parent::run(); // TODO: Change the autogenerated stub
    }

}