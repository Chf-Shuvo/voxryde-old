<?php

namespace App\Enums;

enum DeliveryStatus: string
{
    case Placed = 'placed';
    case Complete = 'completed';
    case Pending = "pending";
    case Accepted = "accepted";
    case Pick = "pick_start";
    case Arrived = "arrived_pick_location";
    case Picked = "picked";
    case Drop = "drop_start";
    case Dropped = "dropped";
    case Delivered = "delivered";
    case Reject = "reject";
}
