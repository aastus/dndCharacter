<?php

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Tables\Columns\Column;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        //
        Gate::policy(\Spatie\Permission\Models\Role::class, \App\Policies\RolePolicy::class);
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
            ->locales(['en','uk']);
        });
        $this->autoTranslateLabels();
    }
    private function autoTranslateLabels()
    {
        $this->translateLabels([
            Field::class,
            Placeholder::class,
            Select::class,
            Filter::class,
            Column::class,
            Section::class,
            Fieldset::class,
        ]);
        $this->translateNavigationLabels();
    }
    private function translateLabels(array $components = [])
    {
        foreach ($components as $component) {
            $component::configureUsing(function ($c): void {
                $c->translateLabel();
            });
        }
    }
    private function translateNavigationLabels()
    {
        NavigationGroup::configureUsing(function (NavigationGroup $group) {
            $labelKey = 'navigation.' . str_replace(' ', '_', $group->getLabel());
            $translatedLabel = __($labelKey);
            $group->label($translatedLabel !== $labelKey ? $translatedLabel : $group->getLabel());
        });
        NavigationItem::configureUsing(function (NavigationItem $item) {
            $labelKey = 'navigation.' . str_replace(' ', '_', $item->getLabel());
            $translatedLabel = __($labelKey);
            $item->label($translatedLabel !== $labelKey ? $translatedLabel : $item->getLabel());
        });
    }
}
