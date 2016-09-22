<?php

/**
 * Created by PhpStorm.
 * User: Indra
 * Date: 8/28/2016
 * Time: 6:47 AM
 */
class Brand
{
    private $id;
    private $brand;

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
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    public function getAllBrands(){
        $db = SiteManager::getDBInstance();

        $sql = "SELECT * FROM brand WHERE 1";
        $res = $db->query($sql,array());

        $brandList = array();

        if($res && $res->num_rows > 0) {
            while ($row = $db->fetchArray($res)) {
                array_push($brandList,$row);
            }
        }

        return $brandList;
    }


    public function searchBrands($searchTerm){
        $db = SiteManager::getDBInstance();
        $args = array(
            '::searchTerm' => $searchTerm
        );
        $sql = "SELECT * FROM brand WHERE brand LIKE CONCAT('%','::searchTerm','%')
 ORDER BY brand LIKE CONCAT('::searchTerm','%') DESC, IFNULL(NULLIF(INSTR(brand,CONCAT(' ','::searchTerm')),0),99999), IFNULL(NULLIF(INSTR(brand,'::searchTerm'),0),99999), brand";

        $res = $db->query($sql,$args);

        $brandList = array();

        if($res && $res->num_rows > 0) {
            while ($row = $db->fetchArray($res)) {
                array_push($brandList,$row);
            }
        }

        return $brandList;
    }

}