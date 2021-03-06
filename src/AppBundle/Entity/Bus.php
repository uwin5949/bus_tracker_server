<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(name="tel_no", type="string", length=15)
     */
    private $telNo;

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
     * @ORM\Column(name="isActive", type="boolean" , nullable=false)
     */
    private $isActive;



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
     * One Bus has Many Journeys.
     * @ORM\OneToMany(targetEntity="Journey", mappedBy="bus",cascade={"all"})
     */
    private $journeys;


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

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Bus
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set telNo
     *
     * @param string $telNo
     *
     * @return Bus
     */
    public function setTelNo($telNo)
    {
        $this->telNo = $telNo;

        return $this;
    }

    /**
     * Get telNo
     *
     * @return string
     */
    public function getTelNo()
    {
        return $this->telNo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->journeys = new ArrayCollection();
    }


    /**
     * Add journey
     *
     * @param \AppBundle\Entity\Journey $journey
     *
     * @return Bus
     */
    public function addJourney(\AppBundle\Entity\Journey $journey)
    {
        $journey->setBus($this);
        $this->journeys[] = $journey;

        return $this;
    }

    /**
     * Remove journey
     *
     * @param \AppBundle\Entity\Journey $journey
     */
    public function removeJourney(\AppBundle\Entity\Journey $journey)
    {
        $this->journeys->removeElement($journey);
    }

    /**
     * Get journeys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJourneys()
    {
        return $this->journeys;
    }
}
