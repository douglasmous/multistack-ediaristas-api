<?php

namespace App\Enums;

enum TipoUsuario: int
{
  case CLIENTE = 1;
  case DIARISTA = 2;
  case ADMIN = 3;

}
