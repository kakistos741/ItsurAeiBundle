<?php

namespace Itsur\AeiBundle\Entity;

/**
 * Itsur\AeiBundle\Entity\Utilerias
 *
 */
class Utilerias
{
    
    public static function periodoActual($doctrine){
      $repository = $doctrine->getRepository('ItsurAeiBundle:Parametro');
      $parametro =  $repository->findOneByNombre('periodo.actual');
      $periodoId =  $parametro->getValor();
      $periodo = $doctrine->getRepository('ItsurAeiBundle:Periodo')->findOneById($periodoId);
      return $periodo;
    }


    public static function manualActual($doctrine){
      $repository = $doctrine->getRepository('ItsurAeiBundle:Parametro');
      $parametro =  $repository->findOneByNombre('manual.actual');
      $claveManual =  $parametro->getValor();
      $manual = $doctrine->getRepository('ItsurAeiBundle:Manual')->findOneByClave($claveManual);
      return $manual;
    }


    public static function ordenAleatorio($cantidad){
           $posiciones = array();
           $nuevo = 0;
           for($numero = 1; $numero<=$cantidad; $numero++){
               do{
                  $nuevo = rand(1,$cantidad);
               }while(Utilerias::existeEn($nuevo,$posiciones)== 1);
               $posiciones[] =  $nuevo;
           }
           return $posiciones;
    }

    public static function existeEn($numero, $arreglo ){
        foreach($arreglo as $a => $value){
            if($numero == $value){
                 return true;
            }
        }
        return false;
    }
    
    public static function grupoSiguiente($doctrine, $periodo, $ficha, $area, $seccion, $tema, $grupo){
        $resultado = array();
        $cambioTema = false;
        $cambioSeccion = false;
        $cambioArea = false;

        $grupoSiguiente=$grupo;

        //$repository = $doctrine->getRepository('ItsurAeiBundle:TemaEvaluable');
        $repository = $doctrine->getRepository('ItsurAeiBundle:TemaEvaluable');
        //$tema =  $repository->findByPeriodoAndFichaAndAreaAndSeccionAndTemaAndOrder($periodo,
         //                     $ficha, $area, $seccion, $tema);
         $temaE =  $repository->findByPeriodoAndFichaAndAreaAndSeccionAndOrder($periodo,
                              $ficha, $area, $seccion, $tema);

        $resultado['final'] = false;
        $resultado['cambiotema'] = false;
        $resultado['cambioseccion'] = false;
        $resultado['cambioarea'] = false;
        
        if($temaE->getGrupos()->count() > $grupo){
            $resultado['grupo'] = $grupo +1;
        }
        else
        {
            $resultado['grupo'] = 1;
            $resultado['cambiotema'] = true;
            $cambioTema = true;
        }

        if($cambioTema){
            $seccionE = $temaE->getSeccion();
            if($seccionE->getTemas()->count() > $tema){
                $resultado['tema'] = $tema + 1;
            }else{
                   $resultado['tema'] = 1;
                   $resultado['cambioseccion'] = true;
                   $cambioSeccion = true;
            }
            
        } else{
            $resultado['tema'] = $tema;
        }
        
        if($cambioSeccion){
            $areaE = $seccionE->getArea();
            if($areaE->getSecciones()->count() > $seccion){
                $resultado['seccion'] = $seccion + 1;
            }else{
                   $resultado['seccion'] = 1;
                   $resultado['cambioarea'] = true;
                   $cambioArea = true;
            }

        } else{
            $resultado['seccion'] = $seccion;
        }
        
        if($cambioArea){
            $hoja = $areaE->getHoja();
            if($hoja->getAreas()->count() > $area){
                $resultado['area'] = $area + 1;
                
            }else{
                   $resultado['area'] = 1;
                   $final = true;
                   $resultado['final'] = true;
            }

        } else{
            $resultado['area'] = $area;
        }
        return $resultado;
    }
}