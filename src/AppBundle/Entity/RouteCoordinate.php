<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RouteCoordinate
 *
 * @ORM\Table(name="route_coordinate")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RouteCoordinateRepository")
 */
class RouteCoordinate
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
     * @ORM\Column(name="lat", type="string", length=20)
     */
    private $lat;

    /**
     * @var string
     *
     * @ORM\Column(name="longi", type="string", length=20)
     */
    private $long;

    /**
     * One RouteCoordinate has a RoadRoute
     *
     * @ORM\ManyToOne(targetEntity="RoadRoute")
     * @ORM\JoinColumn(name="roadroute", referencedColumnName="id")
     */
    private $route;


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
     * Set lat
     *
     * @param string $lat
     *
     * @return RouteCoordinate
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set long
     *
     * @param string $long
     *
     * @return RouteCoordinate
     */
    public function setLong($long)
    {
        $this->long = $long;

        return $this;
    }

    /**
     * Get long
     *
     * @return string
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * Set route
     *
     * @param \AppBundle\Entity\RoadRoute $route
     *
     * @return RouteCoordinate
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
}
