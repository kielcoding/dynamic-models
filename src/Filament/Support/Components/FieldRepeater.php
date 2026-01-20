<?php

namespace Valourite\DynamicModels\Filament\Support\Components;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
use Valourite\DynamicModels\Filament\Enums\FieldType;
use Valourite\DynamicModels\Filament\Support\Helpers\FieldHelper;

final class FieldRepeater extends Repeater
{
    public static function make(?string $name = null): static
    {
        return parent::make($name)
            ->hiddenLabel()
            ->addActionLabel('Feld hinzufügen')
            ->grid(2)
            ->minItems(1)
            ->addable(true)
            ->deletable(fn ($context) => $context === 'create')
            ->reorderable(true)
            ->columnSpanFull()
            ->schema(static::buildSchema())
            ->extraItemActions([
                FieldHelper::getBaseOptionsModal(),
                FieldHelper::getSoftDeleteAction(),
                FieldHelper::getRestoreAction(),
            ]);
    }

    protected static function buildSchema(): array
    {
        return [
            TextInput::make('label')
                ->label(__('Label'))
                ->helperText('Titel des Feldes')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(
                    fn (Set $set, ?string $state) => $set('name', Str::slug(trim($state)))
                )
                ->disabled(fn ($get) => $get('deleted') === true),

            Hidden::make('name')
                ->disabled(fn ($get) => $get('deleted') === true),

            Select::make('type')
                ->label(__('Type'))
                ->options(
                    collect(FieldType::cases())->mapWithKeys(
                        fn ($type) => [$type->value => Str::title($type->name)]
                    )
                )
                ->default(FieldType::TEXT)
                ->required()
                ->live()
                ->disabled(fn ($get) => $get('deleted') === true),

            FieldHelper::getCustomID('field'),
        ];
    }
}
