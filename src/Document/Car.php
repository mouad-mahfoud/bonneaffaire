<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Car
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $price;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $modelYear;
    
    /**
     * @MongoDB\Field(type="int")
     */
    protected $mileage;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $fuelType;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $mark;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $fiscalPower;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $city;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $postedAt;
    /**
     * @MongoDB\Field(type="collection")
     */
    protected $images;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of modelYear
     */ 
    public function getModelYear()
    {
        return $this->modelYear;
    }

    /**
     * Set the value of modelYear
     *
     * @return  self
     */ 
    public function setModelYear($modelYear)
    {
        $this->modelYear = $modelYear;

        return $this;
    }

    /**
     * Get the value of mileage
     */ 
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * Set the value of mileage
     *
     * @return  self
     */ 
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;

        return $this;
    }

    /**
     * Get the value of fuelType
     */ 
    public function getFuelType()
    {
        return $this->fuelType;
    }

    /**
     * Set the value of fuelType
     *
     * @return  self
     */ 
    public function setFuelType($fuelType)
    {
        $this->fuelType = $fuelType;

        return $this;
    }

    /**
     * Get the value of mark
     */ 
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set the value of mark
     *
     * @return  self
     */ 
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }
    
    /**
     * Get the value of fiscalPower
     */ 
    public function getFiscalPower()
    {
        return $this->fiscalPower;
    }

    /**
     * Set the value of fiscalPower
     *
     * @return  self
     */ 
    public function setFiscalPower($fiscalPower)
    {
        $this->fiscalPower = $fiscalPower;

        return $this;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of postedAt
     */ 
    public function getPostedAt()
    {
        return $this->postedAt;
    }

    /**
     * Set the value of postedAt
     *
     * @return  self
     */ 
    public function setPostedAt($postedAt)
    {
        $this->postedAt = $postedAt;

        return $this;
    }

    /**
     * Get the value of images
     */ 
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set the value of images
     *
     * @return  self
     */ 
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }
}