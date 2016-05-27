<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 27.04.16
 * Time: 14:53
 */

namespace app\models\ar;

class Projects extends \app\models\ar\base\Projects
{

    public function beforeSave($insert)
    {
        $this->user = \Yii::$app->user->id;
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function getEntityForAutocomplete(){
        if($this->documents){
            foreach($this->documents as $doc){
              $docIds[] = $doc->id;
            }
        }
        $itemsToReturn = [];
        $entityToAutocomplite = parent::find()->where(['doc_id' => $docIds])->andWhere('(entity IS NOT NULL OR entity_type IS NOT NULL OR manual_date IS NOT NULL)')->select('entity,entity_type,manual_date')->asArray()->all();
        if($entityToAutocomplite){
            foreach($entityToAutocomplite as $items){
                foreach ($items as $item) {
                  if($item != null) $itemsToReturn[] = $item;
                }
            }
        }
        $itemsToReturn = array_unique($itemsToReturn);
        $string = implode("', '",$itemsToReturn);


        return "['$string']";
    }

}