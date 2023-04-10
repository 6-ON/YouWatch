<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class Filter implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): Builder
    {
        return $builder->when(request()->has('q'), function ($query) {
            $query->where('title', 'like', '%' . request()->q . '%')
            ->orWhere('description', 'like', '%' . request()->q . '%');
        });
    }
}
