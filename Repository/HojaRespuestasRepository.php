<?php


namespace Itsur\AeiBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * GrupoEvalubleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class HojaRespuestasRepository extends EntityRepository
{

    public function findByPeriodoAndFicha($periodo, $ficha)
    {
       $query = $this->getEntityManager()
        ->createQuery('
            SELECT ho FROM ItsurAeiBundle:HojaRespuestas ho
            JOIN ho.aspirante as asp
            JOIN ho.periodo as pe
            WHERE
                     pe.id = :periodo
              AND asp.ficha = :ficha'
        )
        ->setParameter('periodo', $periodo)
        ->setParameter('ficha', $ficha);
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }

    }
}
?>