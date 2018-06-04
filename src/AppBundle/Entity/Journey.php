<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Journey
 *
 * @ORM\Table(name="journey")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JourneyRepository")
 */
class Journey
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
     * @ORM\ManyToOne(targetEntity="Bus",inversedBy="journeys")
     * @ORM\JoinColumn(name="bus", referencedColumnName="id")
     */
    private $bus;


    /**
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="startCity", referencedColumnName="id")
     */
    private $from;

    /**
     * @var \DateTime
     * @ORM\Column(name="start_time", type="datetime")
     */
    private $startTime;



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
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return Journey
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
     * Set bus
     *
     * @param \AppBundle\Entity\Bus $bus
     *
     * @return Journey
     */
    public function setBus(\AppBundle\Entity\Bus $bus = null)
    {
        $this->bus = $bus;

        return $this;
    }

    /**
     * Get bus
     *
     * @return \AppBundle\Entity\Bus
     */
    public function getBus()
    {
        return $this->bus;
    }

    /**
     * Set from
     *
     * @param \AppBundle\Entity\City $from
     *
     * @return Journey
     */
    public function setFrom(\AppBundle\Entity\City $from = null)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return \AppBundle\Entity\City
     */
    public function getFrom()
    {
        return $this->from;
    }



}
