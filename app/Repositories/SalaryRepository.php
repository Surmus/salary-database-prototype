<?php

namespace App\Repositories;


use App\Entities\Salary;
use App\Entities\Survey;
use Doctrine\ORM\EntityRepository;

class SalaryRepository extends EntityRepository implements SalaryRepositoryInterface
{
    /**
     * get Survey salaries average
     *
     * @param Survey $survey
     * @return float
     */
    public function getSurveySalariesAverageAmount(Survey $survey)
    {
        $qb = $this->createQueryBuilder(Salary::class);

        return $qb
            ->select($qb->expr()->avg(Salary::class . '.amount'))
            ->where($qb->expr()->eq(Salary::class . '.survey', ':survey'))
            ->setParameter('survey', $survey)
            ->getQuery()
            ->getSingleScalarResult();
    }
}