<?php
/**
 * Created by PhpStorm.
 * User: nicolosinger
 * Date: 24.08.14
 * Time: 18:25
 */

namespace TX3\DoctrineUtilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Translation
 * @package Tuxes3\Bundle\DoctrineUtilBundle
 *
 * @ORM\Entity(repositoryClass="TX3\DoctrineUtilBundleEntity\TranslationRepo")
 */
class Translation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $field;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $class;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=5)
     */
    private $locale;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $objid;

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param int $objid
     */
    public function setObjid($objid)
    {
        $this->objid = $objid;
    }

    /**
     * @return int
     */
    public function getObjid()
    {
        return $this->objid;
    }

} 