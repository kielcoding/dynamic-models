<?php

namespace Valourite\DynamicModels\Concerns;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;

/**
 * This trait will be used to include base fields into the field or section options.
 */
trait CanIncludeBaseFields
{
    public static function getHelperText()
    {
        return TextInput::make('helper_text')
            ->label('Hilfstext')
            ->helperText('Dies ist der Hilfstext.')
            ->maxLength(255);
    }

    public static function getRequired(): Checkbox
    {
        return Checkbox::make('required')
            ->label('Pflichtfeld')
            ->helperText('Feld als Pflichtfeld definieren.');
    }

    public static function getCustomID(string $type): Hidden
    {
        $default = $type . uniqid('-');

        return Hidden::make('custom_id')
            ->key('custom_id')
            ->default($default);
    }
}
