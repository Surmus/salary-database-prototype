<?php

namespace App\Entities;


use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity @ORM\Table(name="survey")
 */
class Survey
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @var string
     **/
    protected $name;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @var string
     **/
    protected $nameEn;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @var string
     **/
    protected $nameRu;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTimeInterface
     */
    protected $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTimeInterface
     */
    protected $createdAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Survey
     */
    public function setName(string $name): Survey
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getNameEn(): string
    {
        return $this->nameEn;
    }

    /**
     * @param string $nameEn
     * @return Survey
     */
    public function setNameEn(string $nameEn): Survey
    {
        $this->nameEn = $nameEn;
        return $this;
    }

    /**
     * @return string
     */
    public function getNameRu(): string
    {
        return $this->nameRu;
    }

    /**
     * @param string $nameRu
     * @return Survey
     */
    public function setNameRu(string $nameRu): Survey
    {
        $this->nameRu = $nameRu;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface $updatedAt
     * @return Survey
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): Survey
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return Survey
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): Survey
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}