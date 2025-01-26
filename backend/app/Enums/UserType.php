<?php

namespace App\Enums;

enum UserType: int
{
    case USER_TYPE_BACKEND = 1;
    case USER_TYPE_USERPROFILE = 2;
}
