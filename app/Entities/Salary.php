<?php

namespace App\Entities;


use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity @ORM\Table(name="salary")
 */
class Salary
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
     * @ORM\Column(type="float")
     *
     * @var float
     */
    protected $amount;

    /**
     * @ORM\ManyToOne(targetEntity="Survey")
     * @ORM\JoinColumn(name="survey_id", referencedColumnName="id", onDelete="CASCADE")
     *
     * @var Survey
     */
    protected $survey;

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
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Salary
     */
    public function setAmount(float $amount): Salary
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return Survey
     */
    public function getSurvey(): Survey
    {
        return $this->survey;
    }

    /**
     * @param Survey $survey
     * @return Salary
     */
    public function setSurvey(Survey $survey): Salary
    {
        $this->survey = $survey;
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
     * @return Salary
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): Salary
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
     * @return Salary
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): Salary
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}