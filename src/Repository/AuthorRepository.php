<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    public function createAuthor(EntityManagerInterface $entityManager, string $nom, string $picture, string $email, int $nb_books): Author
    {
        $author = new Author();
        $author->setNom($nom);
        $author->setPicture($picture);
        $author->setEmail($email);
        $author->setNbBooks($nb_books);
        
        // Persist the new Author object to the database
        $entityManager->persist($author);
        $entityManager->flush();
        
        return $author;
    }

    public function findAllAuthors(): array
    {
        return $this->findAll(); // This will return an array of all Author objects
    }

    public function findDetail(int $id):?Author
    {
        return $this->find($id);
    }
//    /**
//     * @return Author[] Returns an array of Author objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Author
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
