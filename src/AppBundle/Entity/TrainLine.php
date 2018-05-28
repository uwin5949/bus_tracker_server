<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrainLine
 *
 * @ORM\Table(name="train_line")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrainLineRepository")
 */
class TrainLine
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="metacode", type="string", length=50)
     */
    private $metacode;


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
     * Set name
     *
     * @param string $name
     *
     * @return TrainLine
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

    /**
     * Set metacode
     *
     * @param string $metacode
     *
     * @return TrainLine
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

    public function __toString()
    {
        return $this->name;
    }
}
