<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\iEvaluable;
use Itsur\AeiBundle\Entity\ManualPeriodo;
use Itsur\AeiBundle\Entity\AreaPeriodo;
use Itsur\AeiBundle\Entity\SeccionPeriodo;
use Itsur\AeiBundle\Entity\TemaPeriodo;
use Itsur\AeiBundle\Entity\GrupoPeriodo;
use Itsur\AeiBundle\Entity\PreguntaPeriodo;
use Itsur\AeiBundle\Entity\Aspirante;
use Itsur\AeiBundle\Entity\Manual;
use Itsur\AeiBundle\Entity\Area;
use Itsur\AeiBundle\Entity\Seccion;
use Itsur\AeiBundle\Entity\Tema;
use Itsur\AeiBundle\Entity\Grupo;
use Itsur\AeiBundle\Entity\Pregunta;
use Itsur\AeiBundle\Entity\PreguntaOpciones;
/**
 * Itsur\AeiBundle\Entity\ManualPeriodoFactory
 *
 */
class ManualPeriodoFactory
{

    
    /**
     * Create a HojaRespuetas with random order in his elements.
     *
     */
    public static function getManualPeriodo($claveManual, $doctrine){
         $fabrica = new ManualPeriodoFactory();
         $manual = $fabrica->crearManual($claveManual, $doctrine);
         return $manual;
    }//End getManualPeriodo($entityManager)

    private function crearManual($claveManual, $doctrine){
        //Construir el objeto Hoja de Respuestas
        $this->manualPeriodo = new ManualPeriodo();
        //Recupear el manual que contiene las preguntas
        $manual = $doctrine->getRepository('ItsurAeiBundle:Manual')
         ->findOneByClave($claveManual);
         
        //Se asgina el manual a la Hoja de respuestas
        $this->manualPeriodo->setManual($manual);

        $this->manualPeriodo->setFechaCreacion(new \DateTime());

        //Creamos las areas de la hoja
        $this->manualPeriodo->crearAreas();
        
        //Regresamos la hoja de respuestas creada
        return $this->manualPeriodo;

    }

}