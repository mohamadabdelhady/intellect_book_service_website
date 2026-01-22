<?php
namespace App\Enums;

enum AdminRole: string
{
    case ADMIN_SUPER = 'admin_super';
    case ADMIN_EDITOR = 'admin_editor';
}