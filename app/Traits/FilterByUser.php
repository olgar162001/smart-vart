<?php

namespace App\Traits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

trait FilterByUser{
    protected static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->user_id = auth()->id();
        });

        self::addGlobalScope('UserScope',function(EloquentBuilder $builder){
            $builder->where('user_id', Auth::user()->id);
        });
    }
}