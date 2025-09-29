<?php

namespace Valourite\DynamicModels\Concerns;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;

/**
 * This trait will be used to include section specific options into the section options.
 */
trait CanIncludeSectionOptions
{
    public static function getColumnSpan()
    {
        return Toggle::make('column_span_full')
            ->label('Abschnitt über volle Breite')
            ->helperText('Soll der Abschnitt über die volle Breite gehen?');
    }

    public static function getColumnCount()
    {
        return Select::make('column_count')
            ->label('Spalten-Anzahl des Abschnittes')
            ->helperText('Anzahl der Spalten des Abschnittes')
            ->options([
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
            ]);
    }

    public static function getCollapsible()
    {
        return Toggle::make('is_collapsible')
            ->label('Zusammenklappbar')
            ->helperText('Soll der Abschnitt zusammenklappbar sein?');
    }
}
