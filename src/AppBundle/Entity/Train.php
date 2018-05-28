<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Train
 *
 * @ORM\Table(name="train")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrainRepository")
 */
class Train
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
     * @ORM\Column(name="train_name", type="string", length=100)
     */
    private $trainName;


    /**
     * One Train has a TrainStation
     *
     * @ORM\ManyToOne(targetEntity="TrainStation")
     * @ORM\JoinColumn(name="start_station", referencedColumnName="id")
     */
    private $startStation;

    /**
     * One Train has a TrainStation
     *
     * @ORM\ManyToOne(targetEntity="TrainStation")
     * @ORM\JoinColumn(name="end_station", referencedColumnName="id")
     */
    private $endStation;

    /**
     * @var \DateTime
     * @ORM\Column(name="start_time", type="datetime")
     */
    private $startTime;

    /**
     * @var \DateTime
     * @ORM\Column(name="end_time", type="datetime")
     */
    private $endTime;

    /**
     * @ManyToMany(targetEntity="WeekDay")
     * @JoinTable(name="availableDays",
     *      joinColumns={@JoinColumn(name="train_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="day_id", referencedColumnName="id")}
     *      )
     */
    private $availableDays;

    /**
     * @ManyToMany(targetEntity="TrainLine")
     * @JoinTable(name="trainLines_trains",
     *      joinColumns={@JoinColumn(name="train_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="line_id", referencedColumnName="id")}
     *      )
     */
    private $trainLines;

    /**
     * One Train has a User
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set trainName
     *
     * @param string $trainName
     *
     * @return Train
     */
    public function setTrainName($trainName)
    {
        $this->trainName = $trainName;

        return $this;
    }

    /**
     * Get trainName
     *
     * @return string
     */
    public function getTrainName()
    {
        return $this->trainName;
    }

    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return Train
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return Train
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set startStation
     *
     * @param \AppBundle\Entity\TrainStation $startStation
     *
     * @return Train
     */
    public function setStartStation(\AppBundle\Entity\TrainStation $startStation = null)
    {
        $this->startStation = $startStation;

        return $this;
    }

    /**
     * Get startStation
     *
     * @return \AppBundle\Entity\TrainStation
     */
    public function getStartStation()
    {
        return $this->startStation;
    }

    /**
     * Set endStation
     *
     * @param \AppBundle\Entity\TrainStation $endStation
     *
     * @return Train
     */
    public function setEndStation(\AppBundle\Entity\TrainStation $endStation = null)
    {
        $this->endStation = $endStation;

        return $this;
    }

    /**
     * Get endStation
     *
     * @return \AppBundle\Entity\TrainStation
     */
    public function getEndStation()
    {
        return $this->endStation;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->availableDays = new \Doctrine\Common\Collections\ArrayCollection();
        $this->trainLines = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add availableDay
     *
     * @param \AppBundle\Entity\WeekDay $availableDay
     *
     * @return Train
     */
    public function addAvailableDay(\AppBundle\Entity\WeekDay $availableDay)
    {
        $this->availableDays[] = $availableDay;

        return $this;
    }

    /**
     * Remove availableDay
     *
     * @param \AppBundle\Entity\WeekDay $availableDay
     */
    public function removeAvailableDay(\AppBundle\Entity\WeekDay $availableDay)
    {
        $this->availableDays->removeElement($availableDay);
    }

    /**
     * Get availableDays
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAvailableDays()
    {
        return $this->availableDays;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Train
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
     * Add trainLine
     *
     * @param \AppBundle\Entity\TrainLine $trainLine
     *
     * @return Train
     */
    public function addTrainLine(\AppBundle\Entity\TrainLine $trainLine)
    {
        $this->trainLines[] = $trainLine;

        return $this;
    }

    /**
     * Remove trainLine
     *
     * @param \AppBundle\Entity\TrainLine $trainLine
     */
    public function removeTrainLine(\AppBundle\Entity\TrainLine $trainLine)
    {
        $this->trainLines->removeElement($trainLine);
    }

    /**
     * Get trainLines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrainLines()
    {
        return $this->trainLines;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Train
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
}
