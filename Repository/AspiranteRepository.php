<?php

namespace Itsur\AeiBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * AspiranteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AspiranteRepository extends EntityRepository
{

    public function findByPeriodoAndFicha($periodo, $ficha){
         $query = $this->getEntityManager()
        ->createQuery('
            SELECT a, p FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE a.ficha = :ficha AND p.id = :id'
        )->setParameter('ficha', $ficha)
        ->setParameter('id', $periodo);
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    
     public function findByPeriodoAndFichaWithHoja($periodo, $ficha){
         $query = $this->getEntityManager()
        ->createQuery('
            SELECT a, p, h FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            JOIN a.hoja h
            WHERE a.ficha = :ficha AND p.id = :id'
        )->setParameter('ficha', $ficha)
        ->setParameter('id', $periodo);
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    
    public function findByPeriodoAndNombre($periodo, $nombre){
         $query = $this->getEntityManager()
        ->createQuery("
            SELECT a, p FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE a.nombre LIKE :nombre AND p.id = :periodo"
        )->setParameter('periodo', $periodo)
        ->setParameter('nombre', "%".$nombre."%");
        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }

    }
    
     public function findAllByPeriodo($periodo){
         $query = $this->getEntityManager()
        ->createQuery("
            SELECT a, p FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            WHERE  p.id = :periodo
            ORDER BY a.ficha ASC"
        )->setParameter('periodo', $periodo);
        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }

    }
    
    public function findAllByPeriodoWithHoja($periodo){
         $query = $this->getEntityManager()
        ->createQuery("
            SELECT a, p, h FROM ItsurAeiBundle:Aspirante a
            JOIN a.periodo p
            JOIN a.hoja h
            WHERE  p.id = :periodo
            ORDER BY a.ficha ASC"
        )->setParameter('periodo', $periodo);
        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }

    }
}