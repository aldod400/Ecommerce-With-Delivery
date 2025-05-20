<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderDetails';

    protected static ?string $title = 'OrderDetails';
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('message.OrderDetails');
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(app()->getLocale() == 'ar' ? 'product.name_ar' : 'product.name_en')
                    ->label(__('message.Product'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label(__('message.Quantity'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(__('message.Price'))
                    ->searchable(),

            ]);
    }
}
