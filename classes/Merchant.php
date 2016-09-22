<?php

/**
 * Created by PhpStorm.
 * User: Indra
 * Date: 8/27/2016
 * Time: 8:41 PM
 */
class Merchant
{
    private $id;
    private $merchantName;
    private $storeName;
    private $addressLine1;
    private $addressLine2;
    private $city;
    private $state;
    private $country;
    private $postalCode;
    private $locationIdentifier;
    private $phoneNumber;
    private $vatTIN;
    private $serviceTaxNumber;
    private $vat;
    private $serviceTax;
    private $user;
    private $updatedBy;

    /**
     * @return mixed
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param mixed $updatedBy
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
    }


    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

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
    public function getMerchantName()
    {
        return $this->merchantName;
    }

    /**
     * @param mixed $merchantName
     */
    public function setMerchantName($merchantName)
    {
        $this->merchantName = $merchantName;
    }

    /**
     * @return mixed
     */
    public function getStoreName()
    {
        return $this->storeName;
    }

    /**
     * @param mixed $storeName
     */
    public function setStoreName($storeName)
    {
        $this->storeName = $storeName;
    }

    /**
     * @return mixed
     */
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    /**
     * @param mixed $addressLine1
     */
    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;
    }

    /**
     * @return mixed
     */
    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    /**
     * @param mixed $addressLine2
     */
    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return mixed
     */
    public function getLocationIdentifier()
    {
        return $this->locationIdentifier;
    }

    /**
     * @param mixed $locationIdentifier
     */
    public function setLocationIdentifier($locationIdentifier)
    {
        $this->locationIdentifier = $locationIdentifier;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getVatTIN()
    {
        return $this->vatTIN;
    }

    /**
     * @param mixed $vatTIN
     */
    public function setVatTIN($vatTIN)
    {
        $this->vatTIN = $vatTIN;
    }

    /**
     * @return mixed
     */
    public function getServiceTaxNumber()
    {
        return $this->serviceTaxNumber;
    }

    /**
     * @param mixed $serviceTaxNumber
     */
    public function setServiceTaxNumber($serviceTaxNumber)
    {
        $this->serviceTaxNumber = $serviceTaxNumber;
    }

    /**
     * @return mixed
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @param mixed $vat
     */
    public function setVat($vat)
    {
        $this->vat = $vat;
    }

    /**
     * @return mixed
     */
    public function getServiceTax()
    {
        return $this->serviceTax;
    }

    /**
     * @param mixed $serviceTax
     */
    public function setServiceTax($serviceTax)
    {
        $this->serviceTax = $serviceTax;
    }

    public function loadByUser($userId){
        $db = SiteManager::getDBInstance();
        $args = array("::user" => $userId);
        $sql = "SELECT * FROM merchant WHERE user='::user' LIMIT 1";
        $rs = $db->query($sql, $args);

        if($rs && $rs->num_rows > 0){
            $cMerchant = $db->fetchObject($rs);
            if (isset($cMerchant->id))
            {
                $this->setId($cMerchant->id);
                $this->setMerchantName($cMerchant->merchantName);
                $this->setStoreName($cMerchant->storeName);
                $this->setAddressLine1($cMerchant->addressLine1);
                $this->setAddressLine2($cMerchant->addressLine2);
                $this->setCity($cMerchant->city);
                $this->setState($cMerchant->state);
                $this->setCountry($cMerchant->country);
                $this->setLocationIdentifier($cMerchant->locationIdentifier);
                $this->setPostalCode($cMerchant->postalCode);
                $this->setVatTIN($cMerchant->vatTIN);
                $this->setServiceTaxNumber($cMerchant->serviceTaxNumber);
                $this->setVat($cMerchant->vat);
                $this->setServiceTax($cMerchant->serviceTax);
                $this->setPhoneNumber($cMerchant->phoneNumber);
                $this->setUser($cMerchant->user);

                return true;
            }
            else{
                return false;
            }
        }

        else
        {
            return false;
        }
    }

    public function save($ignoreList){
        $db = SiteManager::getDBInstance();
        $args = array(
            "::merchantName" => $this->merchantName,
            "::storeName" => $this->storeName,
            "::addressLine1" => $this->addressLine1,
            "::addressLine2"=> $this->addressLine2,
            "::city" => $this->city,
            "::state" => $this->state,
            "::country"=> $this->country,
            "::postalCode" => $this->postalCode,
            "::locationIdentifier" => $this->locationIdentifier,
            "::phoneNumber" => $this->phoneNumber,
            "::vatTIN" => $this->vatTIN,
            "::serviceTaxNumber" => $this->serviceTaxNumber,
            "::vat" => $this->vat,
            "::serviceTax" => $this->serviceTax,
            "::user" => $this->user,
            "::updatedBy" => $this->updatedBy
        );
        if($this->id){

            $sql = "UPDATE merchant SET ";
            foreach($args as $key=>$value){
                $ignoreList = (count($ignoreList) > 0) ? $ignoreList : ['id','user'];
                if(!in_array(str_replace('::', '',$key),$ignoreList)){
                    $sql .= str_replace('::', '',$key) . "'" . $key . "',";
                }
            }

            $sql = substr($sql,0,(strlen($sql) - 1));
            $sql .= " WHERE user = '::user'";

//                $sql = "UPDATE user SET username = '::username',password = '::password',".
//                    "first_name = '::first_name',last_name = '::last_name',access = '::access' WHERE id = '::id'";
            if($db->query($sql,$args)){
                return true;
            }
            else{
                return false;
            }

        }
        else{

            $sql = "INSERT INTO merchant ";
            $subSql1 = "";
            $subSql2 = "";
            foreach($args as $key=>$value){
                $ignoreList = (count($ignoreList) > 0) ? $ignoreList : ['id'];
                if(!in_array(str_replace('::', '',$key),$ignoreList)){
                    $subSql1 .= (str_replace('::', '',$key) . ",");
                    $subSql2 .= ("'".$key . "',");
                }

            }

            $subSql1 = substr($subSql1,0,(strlen($subSql1) - 1));
            $subSql2 = substr($subSql2,0,(strlen($subSql2) - 1));

            $sql = $sql . "(" . $subSql1 . ") VALUES(" . $subSql2 . ") ";

//                $sql = "INSERT INTO user(username,password,first_name,last_name,access) VALUES('::username','::password','::first_name','::last_name','::access')";
            if($db->query($sql,$args)){
                $this->id = $db->lastInsertId();
                return true;
            }
            else{
                return false;
            }
        }
    }

    public function toJson(){
        $jsonMerchant = array();
        if($this->id) {
            $ignoreList = array('id', 'user');
            foreach ($this as $key => $value) {

                if (!in_array($key, $ignoreList)) {
                    $jsonMerchant[$key] = $value;
                }
            }
            return $jsonMerchant;
        }
        else{
            return null;
        }

    }

}