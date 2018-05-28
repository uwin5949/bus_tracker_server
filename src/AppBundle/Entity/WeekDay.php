<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WeekDay
 *
 * @ORM\Table(name="week_day")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WeekDayRepository")
 */
class WeekDay
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
     * @ORM\Column(name="metacode", type="string", length=10)
     */
    private $metacode;
    /**
     * @var string
     *
     * @ORM\Column(name="dayName", type="string", length=10)
     */
    private $dayName;



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
     * Set metacode
     *
     * @param string $metacode
     *
     * @return WeekDay
     */
    public function setMetacode($metacode)
    {
        $this->metacode = $metacode;

        return $this;
    }

    /**
     * Get metacode
     *
     * @return string
     */
    public function getMetacode()
    {
        return $this->metacode;
    }

    /**
     * Set dayName
     *
     * @param string $dayName
     *
     * @return WeekDay
     */
    public function setDayName($dayName)
    {
        $this->dayName = $dayName;

        return $this;
    }

    /**
     * Get dayName
     *
     * @return string
     */
    public function getDayName()
    {
        return $this->dayName;
    }

    public  function __toString()
    {
        return $this->dayName;
    }
}
