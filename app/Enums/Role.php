<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'Admin';
    case Terapis = 'Terapis';
    case Anak = 'Anak';
}
