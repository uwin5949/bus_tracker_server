<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RoadRoute
 *
 * @ORM\Table(name="route")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RouteRepository")
 */
class RoadRoute
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
     * @ORM\Column(name="routeNo", type="string", length=10)
     */
    private $routeNo;

    /**
     * @var string
     *
     * @ORM\Column(name="routeName", type="string", length=500)
     */
    private $routeName;

    /**
     * @var string
     *
     */
    private $showName;

    /**
     * @var string
     *
     * @ORM\Column(name="published", type="boolean" , nullable=false)
     */
    private $published;

    /**
     * One RoadRoute has Many RouteCoordinates.
     * @ORM\OneToMany(targetEntity="RouteCoordinate", mappedBy="route",cascade={"all"})
     */
    private $coordinates;





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
     * Set routeNo
     *
     * @param string $routeNo
     *
     * @return RoadRoute
     */
    public function setRouteNo($routeNo)
    {
        $this->routeNo = $routeNo;

        return $this;
    }

    /**
     * Get routeNo
     *
     * @return string
     */
    public function getRouteNo()
    {
        return $this->routeNo;
    }

    /**
     * Set routeName
     *
     * @param string $routeName
     *
     * @return RoadRoute
     */
    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;

        return $this;
    }

    /**
     * Get routeName
     *
     * @return string
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return RoadRoute
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
     * Constructor
     */
    public function __construct()
    {
        $this->coordinates = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add coordinate
     *
     * @param \AppBundle\Entity\RouteCoordinate $coordinate
     *
     * @return RoadRoute
     */
    public function addCoordinate(\AppBundle\Entity\RouteCoordinate $coordinate)
    {
        $this->coordinates[] = $coordinate;

        return $this;
    }

    /**
     * Remove coordinate
     *
     * @param \AppBundle\Entity\RouteCoordinate $coordinate
     */
    public function removeCoordinate(\AppBundle\Entity\RouteCoordinate $coordinate)
    {
        $this->coordinates->removeElement($coordinate);
    }

    /**
     * Get coordinates
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * Get showName
     *
     * @return string
     */
    public function getShowName()
    {
        return $this->routeNo.': '.$this->routeName;
    }

}
