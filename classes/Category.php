<?php

/**
 * Created by PhpStorm.
 * User: Indra
 * Date: 8/28/2016
 * Time: 6:47 AM
 */
class Category
{
    private $id;
    private $category;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getAllCategories(){
        $db = SiteManager::getDBInstance();

        $sql = "SELECT * FROM category WHERE 1";
        $res = $db->query($sql,array());

        $categoryList = array();

        if($res && $res->num_rows > 0) {
            while ($row = $db->fetchArray($res)) {
                array_push($categoryList,$row);
            }
        }

        return $categoryList;
    }


    public function searchCategories($searchTerm){
        $db = SiteManager::getDBInstance();
        $args = array(
            '::searchTerm' => $searchTerm
        );
        $sql = "SELECT * FROM category WHERE category LIKE CONCAT('%','::searchTerm','%')
 ORDER BY category LIKE CONCAT('::searchTerm','%') DESC, IFNULL(NULLIF(INSTR(category,CONCAT(' ','::searchTerm')),0),99999), IFNULL(NULLIF(INSTR(category,'::searchTerm'),0),99999), category";

        $res = $db->query($sql,$args);

        $categoryList = array();

        if($res && $res->num_rows > 0) {
            while ($row = $db->fetchArray($res)) {
                array_push($categoryList,$row);
            }
        }

        return $categoryList;
    }

}