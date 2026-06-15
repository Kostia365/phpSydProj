<?php

namespace Knilo\PhpSydProj\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Customer = 'customer';
}