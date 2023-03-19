<?php

namespace App\Services\Filters;

use App\Models\Moderating;
use App\Models\User;

class ModeratingFilter extends QueryFilter
{
    public function ms($value)
    {
        $this->builder->where('status', Moderating::getArrayStatuses()[$value]);
    }

    public function us($value)
    {
        $this->builder->whereHas('user', function ($query) use ($value) {
            $query->where('status', User::getArrayStatuses()[$value]);
        });
    }

    public function ur($value)
    {
        $this->builder->whereHas('user', function ($query) use ($value) {
            $query->where('role_id', $value);
        });
    }
}
