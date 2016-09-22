<?php

/**
 * Created by PhpStorm.
 * User: Indra
 * Date: 8/27/2016
 * Time: 2:55 PM
 */
class Product
{
    private $id;
    private $gtinCode;
    private $productName;
    private $category;

    private $brand;

    private $description;
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
    public function getGtinCode()
    {
        return $this->gtinCode;
    }

    /**
     * @param mixed $gtinCode
     */
    public function setGtinCode($gtinCode)
    {
        $this->gtinCode = $gtinCode;
    }

    /**
     * @return mixed
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param mixed $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
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

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public static function getProductByGtinCode($gtinCode){
        $db = SiteManager::getDBInstance();
        $args = array("::gtinCode" => $gtinCode);
        $sql = "SELECT * FROM product WHERE gtinCode='::gtinCode' LIMIT 1";
        $rs = $db->query($sql, $args);

        if($rs && $rs->num_rows > 0){
            $productRes = $db->fetchObject();

            if (isset($productRes->id))
            {
                $product = new Product();
                $product->setId($productRes->id);
                $product->setProductName($productRes->productName);
                $product->setGtinCode($productRes->gtinCode);
                $product->setBrand($productRes->brand);
                $product->setDescription($productRes->description);
                $product->setCategory($productRes->category);
                return true;
            }
            else
            {
                return false;
            }

        }
        else
        {
            return false;
        }
    }

    public function toJson(){
        /**
         * @TODO
         */
        $jsonProduct = [];

        if($this->id){
            foreach($this as $key => $value){
                $ignoreList = array('id','user','status');
                if(!in_array($key,$ignoreList)){
                    $jsonProduct[$key] = $value;
                }
            }
            return $jsonProduct;
        }
        else{
            return null;
        }

    }

}