<?php

namespace App\Enums;

enum AtomServiceAuthStatusEnum: string{
    case OK = 'OK';
    case WRONG_AUTHORIZATION = 'WRONG AUTHORIZATION';

}
