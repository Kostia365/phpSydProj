<?php

namespace Knilo\PhpSydProj\Enums;

enum UserStatus: string
{
    case ADMIN = 'Admin';
    case USER = 'User';
}