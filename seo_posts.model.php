<?php
/**
 * seo_posts model
 * @author Ben
 */
class seo_posts extends TFModel {
    public function __construct($tablename='seo_posts', $tags=true, $isCache=true){
        parent::__construct($tablename, $tags, $isCache);
    }
    /**
     * 
     * @param $where
     * @param string $what
     * @param string $page_item
     * @param string $page
     * @return Ambigous <boolean, string>|multitype:|NULL
     */
    public function get_all_posts($where,$what='*',$page_item=null,$page='1'){
        $sql = "SELECT ".$what." FROM ".$this->get_tableName()." ";
        $cache_key = 'seo_posts_'.$where;
        if (!empty($where) && is_string($where)){
            if (strpos($where, 'WHERE') !== false ) {
                $sql .= $where;
            }else{
                $sql .= "WHERE $where";
            }
        }
        if (!empty($where) && is_array($where)){
            $the_where_str = " WHERE 1 ";
            foreach ($where as $key => $item){
                $the_where_str .= " AND ".$key."=".$this->db->FilterValue($item);
            }
            $sql .= $the_where_str;
        }
        $sql .= " ORDER BY ID ";
        if(!empty($page_item)){
            $offset = $page_item*($page-1);
            $sql .= " LIMIT {$offset},{$page_item} ";
        }   
        $cache_result = TF_CacheFactory::GetCache("db_mysql_cache")->get("ExecuteQuery".$cache_key);
        if ($this->enable_cache === TRUE && isset($cache_result) && $cache_result !== FALSE){
            return $cache_result;
        }
    
        $result = $this->db->ExecuteArray($sql);
        if($this->enable_cache === true && count($result) > 0){
            TF_CacheFactory::GetCache("db_mysql_cache")->set('ExecuteQuery'.$cache_key, $result);
        }
    
        if (count($result)>0){
            return $result;
        }else {
            return null;
        }
    }
    
    /**
     * 
     * @param $post_id
     * @return Ambigous <NULL, boolean, string>
     */
    public function get_post($post_id){
        $where = "id = {$post_id} AND status = 'publish'";
        $post = parent::get_data($where);
        return $post;
    }
    
    /**
     * 
     * @param string $url
     * @param string $status
     * @return Ambigous <NULL, boolean, string>
     */
    public function get_post_by_url($url,$status=null){
        if(empty($status)){
            $where = " url = '{$url}' ";
        }
        else{
            $where = " url = '{$url}' AND status = '{$status}' ";
        }       
        $post = parent::get_data($where);
        return $post;
    }
    /**
     * update seo post
     *
     * @param intval $post_id
     * @param array $arr
     * @return boolean
     */
    public function updateData($post_id, $arr){
        $sql = "update `".$this->table_name."` set ";
        $update_arr = array();
        foreach ($arr as $key => $val){
            if('id' == $key){
                continue;
            }
            $update_arr[] = "`{$key}` = '{$val}'";
        }
        $sql .= implode(", ", $update_arr);
        $sql .= " where `id` = ".intval($post_id);
        //echo $sql;
        return $this->db->ExecuteQuery($sql);
    }
    
    /*
     * clear cache
     */
    public function clearCache($cacheKey=''){
        if(!empty($cacheKey)){
            TF_CacheFactory::GetCache("db_mysql_cache")->del($cacheKey);
        }
    }

    /**
     * Get posts by country code
     *
     * @param string $countryCode
     * @param int $limit
     *
     * @return array
     */
    public function getPostsByCountryCode($countryCode, $limit) {
        $sql = "SELECT a.post_id,b.post_title from wp_postmeta as a left join 
            wp_posts as b on a.post_id = b.ID where a.meta_key = 'select_country' 
            and a.meta_value = '$countryCode' and b.post_type = 'post' 
            and b.post_status = 'publish' order by b.post_date desc limit " . $limit;
        $cache_result = TF_CacheFactory::GetCache("db_mysql_cache")->get("ExecuteQuery" . $this->db->dbConfig_md5 . $sql);
        if ($this->enable_cache == true && $cache_result != FALSE) {
            return $cache_result;
        } else {
           $cache_result = $this->db->ExecuteArray($sql);
           TF_CacheFactory::GetCache("db_mysql_cache")->set('ExecuteQuery' . $this->db->dbConfig_md5 . $sql, $cache_result);
           return $cache_result;
        }
    }
}
