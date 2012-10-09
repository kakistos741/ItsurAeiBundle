<?php

namespace Itsur\AeiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Itsur\AeiBundle\Entity\iEvaluable;
use Itsur\AeiBundle\Entity\HojaRespuestas;
use Itsur\AeiBundle\Entity\AreaEvaluable;
use Itsur\AeiBundle\Entity\SeccionEvaluable;
use Itsur\AeiBundle\Entity\TemaEvaluable;
use Itsur\AeiBundle\Entity\GrupoEvaluable;
use Itsur\AeiBundle\Entity\PreguntaEvaluable;
use Itsur\AeiBundle\Entity\Aspirante;
use Itsur\AeiBundle\Entity\Manual;
use Itsur\AeiBundle\Entity\Area;
use Itsur\AeiBundle\Entity\Seccion;
use Itsur\AeiBundle\Entity\Tema;
use Itsur\AeiBundle\Entity\Grupo;
use Itsur\AeiBundle\Entity\Pregunta;
use Itsur\AeiBundle\Entity\PreguntaOpciones;
/**
 * Itsur\AeiBundle\Entity\HojaRespuestasFactory
 *
 */
class HojaRespuestasFactory
{

    private $hoja;
    
    /**
     * Create a HojaRespuetas with random order in his elements.
     *
     */
    public static function getHojaRespuestas($claveManual, $doctrine){
         $fabrica = new HojaRespuestasFactory();
         $hoja = $fabrica->crearHoja($claveManual, $doctrine);
         return $hoja;
    }//End getHojaRespuestas($entityManager)

    private function crearHoja($claveManual, $doctrine){
            //Construir el objeto Hoja de Respuestas
        $this->hoja = new HojaRespuestas();
        //Recupear el manual que contiene las preguntas
        $manual = $doctrine->getRepository('ItsurAeiBundle:Manual')
         ->findOneByClave($claveManual);
         
        //Se asgina el manual a la Hoja de respuestas
        $this->hoja->setManual($manual);

        //Creamos las areas de la hoja
        $this->hoja->crearAreas();
        //Regresamos la hoja de respuestas creada
        return $this->hoja;

    }

}