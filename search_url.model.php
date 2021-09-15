<?php
/**
 * Description of inventory
 * @author Andy
 */
class search_url{   
    public function setSearch_key_str($search_key){
        $default_search_key = property::$default_search_key;
        if($search_key['v']['value']==='2'){
            $default_search_key['it']='18';
        }
        $search_order = array();
        foreach($search_key as $k=>$l){
            $search_order[] = $l['order'];
        }
        array_multisort($search_order,SORT_ASC,SORT_NUMERIC,$search_key);
        $search_key_str = '';
        foreach($search_key as $k=>$l){
            if($default_search_key[$k]!=$l['value']){
                if($search_key_str!=='')$search_key_str.='_';
                $search_key_str.=$l['key'].'-'.$l['value'];
            }
        }
        return $search_key_str;
    }
    public function addOrChageSearch_key($search_key,$key,$value){
        switch($key){
            case 'v':
            {   
                $search_key[$key]['key'] = $key;
                $search_key[$key]['field'] = 'view';
                $search_key[$key]['value'] = $value;
                $search_key[$key]['order'] = 0;
                if(!in_array($value,array('0','1','2','3'))){
                    TF_debug('û�����v');  
                }
                break;
            }
            case 't':
            {
                $search_key[$key]['key'] = $key;
                $search_key[$key]['field'] = 'search_tab';
                $search_key[$key]['value'] = $value;
                $search_key[$key]['order'] = 1;
                if(!in_array($value,array('0','1','2','3','4','5'))){
                    TF_debug('û�����t');
                }
                break;
            }
            case 'odmin':
            {
                $search_key[$key]['key'] = $key;
                $search_key[$key]['field'] = 'outdoor_size_min';
                $search_key[$key]['value'] = $value;
                $search_key[$key]['order'] = 2;
                if(preg_match('/^[0-9]{1,5}$/',$value)===0){
                    TF_debug('odmin �������');
                }
                break;
            }
            case 'odmax':
            {   
                $search_key[$key]['key'] = $key;
                $search_key[$key]['field'] = 'outdoor_size_max';
                $search_key[$key]['value'] = $value;
                $search_key[$key]['order'] = 3;
                if(preg_match('/^[0-9]{1,6}$/',$value)===0){
                    TF_debug('odmax �������');
                }
                break;
            }
            case 'c':
            {
                $search_key[$key]['key'] = $key;
                $search_key[$key]['field'] = 'city';
                $search_key[$key]['value'] = $value;
                $search_key[$key]['order'] = 4;
                if(preg_match('/^[0-9]{1,9}$/',$value)===0){
                    TF_debug('c �������');
                }
                break;
            }
            case 'pmin':
            {
                $search_key[$key]['key'] = $key;
                $search_key[$key]['field'] = 'min_price';
                $search_key[$key]['value'] = $value;
                $search_key[$key]['order'] = 5;
                if(preg_match('/^[0-9]{1,8}$/',$value)===0){
                    TF_debug('pmin �������');
                }
                break;
            }
            case 'pmax':
            {
                $search_key[$key]['key'] = $key;
                $search_key[$key]['field'] = 'max_price';
                $search_key[$key]['value'] = $value;
                $search_key[$key]['order'] = 6;
                if(preg_match('/^[0-9]{1,8}$/',$value)===0){
                    TF_debug('pmax �������');
                }
                break;
            }
            case 'u':
            {
                $search_key[$key]['key'] = $key;
                $search_key[$key]['field'] = 'user_id';
                $search_key[$key]['value'] = $value;
                $search_key[$key]['order'] = 7;
                if(preg_match('/^[0-9]{1,11}$/',$value)===0){
                    TF_debug('u �������');
                }
                break;
            }
            case 'r':
            {
                $search_key[$key]['key'] = $key;
                $search_key[$key]['field'] = 'region';
                $search_key[$key]['value'] = $value;
                $search_key[$key]['order'] = 8;
                if(preg_match('/^[0-9]{1,9}$/',$value)===0){
                    TF_debug('r �������');
                }
                break;
            }
            case 'a':
            {
                $search_key[$key]['key'] = $key;
                $search_key[$key]['field'] = 'area';
                $search_key[$key]['value'] = $value;
                $search_key[$key]['order'] = 9;
                if(preg_match('/^[0-9]{1,10}$/',$value)===0){
                    TF_debug('r �������');
                }
                break;
            }
            case 'ro':
            {
                $search_key[$key]['key'] = $key;
                $search_key[$key]['field'] = 'room';
                $search_key[$key]['value'] = $value;
                $search_key[$key]['order'] = 10;
                if(!in_array($value,array('0','1','2','3','4','5','6','7','8','9','10','m10'))){
                    TF_debug('û�����ro');
                }
                break;
            }
            case 'sv':
            {
                $search_key[$key]['key'] = $key;
                $search_key[$key]['field'] = 'search_view';
                $search_key[$key]['value'] = $value;
                $search_key[$key]['order'] = 11;
                if(!in_array($value,array('0','1','2','3','4','6','7','8','9','10','11','12','13','14'))){
                    TF_debug('û�����sv');
                }
                break;
            }
            case 'f':
            {
                $search_key[$key]['key'] = $key;
                $search_key[$key]['field'] = 'search_facing';
                $search_key[$key]['value'] = $value;
                $search_key[$key]['order'] = 12;
                if(!in_array($value,array('0','1','2','3','4','5','6','7','8','9','10'))){
                    TF_debug('û�����f');
                }
                break;
            }
}
