<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class AdminResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getNavigationLabel(): string
    {
        return __('message.Admins');
    }

    public static function getNavigationGroup(): string
    {
        return __('message.User Types');
    }

    protected static ?string $slug = 'admins';
    protected static ?string $recordTitleAttribute = 'name';

    public static function getPluralModelLabel(): string
    {
        return __('message.Admins');
    }

    public static function getModelLabel(): string
    {
        return __('message.Admin');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_type', 'admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('message.Name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label(__('message.Email'))
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label(__('message.Phone'))
                    ->unique(ignoreRecord: true)
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->label(__('message.Image'))
                    ->directory('users')
                    ->default('images/default.png')
                    ->image(),
                Forms\Components\Select::make('user_type')
                    ->label(__('message.User Type'))
                    ->default('admin')
                    ->options([
                        'admin' => __('message.Admin'),
                        'user' => __('message.User'),
                    ])
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label(__('message.Status'))
                    ->required()
                    ->default('active')
                    ->options([
                        'active' => __('message.Active'),
                        'inactive' => __('message.Inactive'),
                    ]),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn(string $operation): bool => $operation === 'create')
                    ->dehydrated(fn($state) => filled($state))
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->maxLength(255)
                    ->label(__('message.Password'))
                    ->revealable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label(__('message.Image'))
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(asset('images/default.png')),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('message.Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('message.Email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('message.Phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_type')
                    ->label(__('message.User Type'))
                    ->badge()
                    ->color(fn($state) => $state == 'admin' ? 'primary' : 'info')
                    ->formatStateUsing(fn($state) => $state == 'admin' ? __('message.Admin') : __('message.User')),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('message.Status'))
                    ->badge()
                    ->color(fn($state) => $state == 'active' ? 'success' : 'danger')
                    ->formatStateUsing(fn($state) => $state == 'active' ? __('message.Active') : __('message.Inactive')),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('message.Created At'))
                    ->dateTime('d-m-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('message.Updated At'))
                    ->dateTime('d-m-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('message.Status'))
                    ->options([
                        'active' => __('message.Active'),
                        'inactive' => __('message.Inactive'),
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
