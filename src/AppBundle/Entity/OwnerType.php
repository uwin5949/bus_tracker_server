<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OwnerType
 *
 * @ORM\Table(name="owner_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OwnerTypeRepository")
 */
class OwnerType
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
     * @return OwnerType
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


}
