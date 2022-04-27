<?php

namespace App\Enums;

enum DriverStatus: string
{
    case Active = "approved";
    case Blocked = "blocked";
}
