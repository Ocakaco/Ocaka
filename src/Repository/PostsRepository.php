<?php

namespace App\Repository;

use App\Entity\Posts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Posts>
 */
class PostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Posts::class);
    }

    //    /**
    //     * @return Posts[] Returns an array of Posts objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Posts
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

	public function getAll(): array
	{
		// qb stands for query builder
		$qb = $this->createQueryBuilder('p')
			->orderBy('p.created_at', 'DESC');

		$query = $qb->getQuery();

		return $query->execute();
	}

	public function getAllPaginated(int $curPage = 1, int $limit = 10): Paginator
	{
		// qb stands for query builder
		$qb = $this->createQueryBuilder('p')
			->orderBy('p.created_at', 'DESC');

		$query = $qb->getQuery()
			  ->setFirstResult(($curPage - 1) * $limit)
		  	  ->setMaxResults($limit);

		return new Paginator($query, true);
	}

	public function getTotalPost(): int
	{
		$qb = $this->createQueryBuilder('p')
			 ->select('count(p.id)');

		$query = $qb->getQuery()->getSingleScalarResult();

		return $query;
	}
}
