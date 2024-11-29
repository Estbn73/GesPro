<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Http\Livewire\ProyectoRiesgosComponent;
use App\Http\Livewire\ProyectoPresupuestosComponent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot() :void
    {
        Livewire::component('proyecto-riesgos-component', \App\Http\Livewire\ProyectoRiesgosComponent::class);
        Livewire::component('proyecto-presupuesto-component', \App\Http\Livewire\ProyectoPresupuestosComponent::class);

    }
}   
