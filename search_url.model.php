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
