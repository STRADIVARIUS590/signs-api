<?php
  
namespace App\Enums;
 
enum StreakQuestionStatusEnum:string{
    case Pending = 'PENDING'; // no mostradas
    case Current = 'CURRENT'; // pregunta actual (espera respuesta)
    case NoReturn = 'NO_RETURN'; // respondida correctamente (no regresar a ella)
}