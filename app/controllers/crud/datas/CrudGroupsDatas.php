<?php
namespace controllers\crud\datas;

use Ubiquity\controllers\crud\CRUDDatas;
 /**
  * Class CrudGroupsDatas
  */
class CrudGroupsDatas extends CRUDDatas{
    public function getFieldNames($model){
        return ['Prénom','Nom','Email','Suspendu?','Groupes'];
    }

    public function getFormFieldNames($model, $instance)
    {
        return ['Prénom','Nom','Email','Suspendu?','Groupes'];
    }

    public function _getInstancesFilter($model)
    {
        return ;
    }

    public function getManyToManyDatas($fkClass, $instance, $member)
    {
        return ;
    }
}
