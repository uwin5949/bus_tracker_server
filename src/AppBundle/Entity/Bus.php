<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Bus
 *
 * @ORM\Table(name="bus")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BusRepository")
 * @UniqueEntity("busNo")
 */
class Bus
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="bus_name", type="string", length=100, nullable=true)
     */
    private $busName;

    /**
     * @var string
     *
     * @ORM\Column(name="bus_no", type="string", length=10, unique=true)
     */
    private $busNo;

    /**
     * @var string
     *
     * @ORM\Column(name="last_lat", type="string", length=20 ,nullable=true)
     */
    private $lastLoc;

    /**
     * @var string
     *
     * @ORM\Column(name="last_long", type="string", length=20 ,nullable=true)
     */
    private $lastLong;

    /**
     * One Bus has a RoadRoute
     *
     * @ORM\ManyToOne(targetEntity="RoadRoute")
     * @ORM\JoinColumn(name="route", referencedColumnName="id")
     */
    private $route;

    /**
     * One Bus has a User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */
    private $user;


    /**
     * @var string
     *
     * @ORM\Column(name="published", type="boolean" , nullable=false)
     */
    private $published;

    /**
     * @var string
     *
     * @ORM\Column(name="isConnected", type="boolean" , nullable=true)
     */
    private $isConnected;



    /**
     * One Bus has a BusType
     *
     * @ORM\ManyToOne(targetEntity="BusType")
     * @ORM\JoinColumn(name="busType", referencedColumnName="id")
     */
    private $busType;

    /**
     * One Bus has a OwnerType
     *
     * @ORM\ManyToOne(targetEntity="OwnerType")
     * @ORM\JoinColumn(name="ownerType", referencedColumnName="id")
     */
    private $ownerType;






    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set busName
     *
     * @param string $busName
     *
     * @return Bus
     */
    public function setBusName($busName)
    {
        $this->busName = $busName;

        return $this;
    }

    /**
     * Get busName
     *
     * @return string
     */
    public function getBusName()
    {
        return $this->busName;
    }

    /**
     * Set busNo
     *
     * @param string $busNo
     *
     * @return Bus
     */
    public function setBusNo($busNo)
    {
        $this->busNo = $busNo;

        return $this;
    }

    /**
     * Get busNo
     *
     * @return string
     */
    public function getBusNo()
    {
        return $this->busNo;
    }

    /**
     * Set lastLoc
     *
     * @param string $lastLoc
     *
     * @return Bus
     */
    public function setLastLoc($lastLoc)
    {
        $this->lastLoc = $lastLoc;

        return $this;
    }

    /**
     * Get lastLoc
     *
     * @return string
     */
    public function getLastLoc()
    {
        return $this->lastLoc;
    }

    /**
     * Set route
     *
     * @param \AppBundle\Entity\RoadRoute $route
     *
     * @return Bus
     */
    public function setRoute(\AppBundle\Entity\RoadRoute $route = null)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return \AppBundle\Entity\RoadRoute
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\Bus $user
     *
     * @return Bus
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }


    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return Bus
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set busType
     *
     * @param \AppBundle\Entity\BusType $busType
     *
     * @return Bus
     */
    public function setBusType(\AppBundle\Entity\BusType $busType = null)
    {
        $this->busType = $busType;

        return $this;
    }

    /**
     * Get busType
     *
     * @return \AppBundle\Entity\BusType
     */
    public function getBusType()
    {
        return $this->busType;
    }

    /**
     * Set ownerType
     *
     * @param \AppBundle\Entity\OwnerType $ownerType
     *
     * @return Bus
     */
    public function setOwnerType(\AppBundle\Entity\OwnerType $ownerType = null)
    {
        $this->ownerType = $ownerType;

        return $this;
    }

    /**
     * Get ownerType
     *
     * @return \AppBundle\Entity\OwnerType
     */
    public function getOwnerType()
    {
        return $this->ownerType;
    }

    /**
     * Set isConnected
     *
     * @param boolean $isConnected
     *
     * @return Bus
     */
    public function setIsConnected($isConnected)
    {
        $this->isConnected = $isConnected;

        return $this;
    }

    /**
     * Get isConnected
     *
     * @return boolean
     */
    public function getIsConnected()
    {
        return $this->isConnected;
    }

    /**
     * Set lastLong
     *
     * @param string $lastLong
     *
     * @return Bus
     */
    public function setLastLong($lastLong)
    {
        $this->lastLong = $lastLong;

        return $this;
    }

    /**
     * Get lastLong
     *
     * @return string
     */
    public function getLastLong()
    {
        return $this->lastLong;
    }
}
