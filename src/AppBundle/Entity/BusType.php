<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusType
 *
 * @ORM\Table(name="bus_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BusTypeRepository")
 */
class BusType
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
     * @ORM\Column(name="metacode", type="string", length=20)
     */
    private $metacode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=20)
     */
    private $name;


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
     * @return BusType
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
     * Set name
     *
     * @param string $name
     *
     * @return BusType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
