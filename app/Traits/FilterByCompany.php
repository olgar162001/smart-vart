<?php

namespace App\Traits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

trait FilterByCompany{
    protected static function boot(){
        parent::boot();
        self::creating(function ($model){
            $model->company_id = Auth::user()->current_company_id;
        });

        self::addGlobalScope(function(Builder $builder){
            $builder->where('company_id', Auth::user()->current_company_id);
        });
    }
}