<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function rented() {
        if ($this->tenant_id == null) {
            return false;
        } else {
            return true;
        }
    }
}
