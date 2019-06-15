<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(repositoryClass="App\Repository\CarRepository")
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
    protected $title;

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
    protected $mileageMin;
  
    /**
     * @MongoDB\Field(type="int")
     */
    protected $mileageMax;


    /**
     * @MongoDB\Field(type="string")
     */
    protected $fuelType;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $fuelTypeId;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $mark;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $markId;
    
    /**
     * @MongoDB\Field(type="string")
     */
    protected $model;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $modelId;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $fiscalPower;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $city;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $cityId;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $postedAt;
    /**
     * @MongoDB\Field(type="collection")
     */
    protected $images;
    
    /**
     * @MongoDB\Field(type="int")
     */
    protected $views;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $link;



    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of Title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

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

    /**
     * Get the value of views
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set the value of views
     *
     * @return  self
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get the value of link
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get the value of mileageMin
     */
    public function getMileageMin()
    {
        return $this->mileageMin;
    }

    /**
     * Set the value of mileageMin
     *
     * @return  self
     */
    public function setMileageMin($mileageMin)
    {
        $this->mileageMin = $mileageMin;

        return $this;
    }

    /**
     * Get the value of mileageMax
     */
    public function getMileageMax()
    {
        return $this->mileageMax;
    }

    /**
     * Set the value of mileageMax
     *
     * @return  self
     */
    public function setMileageMax($mileageMax)
    {
        $this->mileageMax = $mileageMax;

        return $this;
    }

    /**
     * Get the value of model
     */ 
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @return  self
     */ 
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMarkId()
    {
        return $this->markId;
    }

    /**
     * @param mixed $markId
     */
    public function setMarkId($markId): void
    {
        $this->markId = $markId;
    }

    /**
     * @return mixed
     */
    public function getModelId()
    {
        return $this->modelId;
    }

    /**
     * @param mixed $modelId
     */
    public function setModelId($modelId): void
    {
        $this->modelId = $modelId;
    }

    /**
     * @return mixed
     */
    public function getFuelTypeId()
    {
        return $this->fuelTypeId;
    }

    /**
     * @param mixed $fuelTypeId
     */
    public function setFuelTypeId($fuelTypeId): void
    {
        $this->fuelTypeId = $fuelTypeId;
    }

    /**
     * @return mixed
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * @param mixed $cityId
     */
    public function setCityId($cityId): void
    {
        $this->cityId = $cityId;
    }

}
