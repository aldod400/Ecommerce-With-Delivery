<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductAttributeValue;
use App\Models\Product;
use App\Models\ProductAttributeValue as ProductAttributeValueModel;
use Illuminate\Database\Eloquent\Model;

class ProductAttributesRelationManager extends RelationManager
{
    protected static string $relationship = 'productAttributes';
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('message.Product Attributes');
    }
    public static function getNavigationLabel(): string
    {
        return __('message.Product Attributes');
    }

    public static function getModelLabel(): string
    {
        return __('message.Product Attribute');
    }

    public static function getPluralModelLabel(): string
    {
        return __('message.Product Attributes');
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1) اختيار السمة
                Forms\Components\Select::make('attribute_id')
                    ->label(__('message.Attribute'))
                    ->options(
                        Attribute::query()
                            ->pluck(
                                app()->getLocale() === 'ar' ? 'name_ar' : 'name_en',
                                'id'
                            )
                    )
                    ->reactive()
                    // بعد ما يحمل الـ record في التعديل، نعبّي الـ state من العلاقة
                    ->afterStateHydrated(function (callable $set, $record) {
                        // $record هنا هو كائن ProductAttributeValue
                        if (! $record) {
                            return;
                        }
                        $set(
                            'attribute_id',
                            optional($record->attributeValue)->attribute_id
                        );
                    })
                    // لو غيّر المستخدم السمة، لازم نفلتر القيم من جديد
                    ->afterStateUpdated(fn(callable $set) => $set('attribute_value_id', null))
                    ->required()
                    ->searchable()
                    // علشان يعرض الاسم مش الـ ID
                    ->getOptionLabelUsing(fn($value) => Attribute::find($value)?->{app()->getLocale() === 'ar' ? 'name_ar' : 'name_en'}),

                // 2) اختيار قيمة السمة
                Forms\Components\Select::make('attribute_value_id')
                    ->label(__('message.Attribute Value'))
                    ->options(function (callable $get) {
                        $attributeId = $get('attribute_id');
                        if (! $attributeId) {
                            return [];
                        }

                        return AttributeValue::where('attribute_id', $attributeId)
                            ->pluck('value', 'id');
                    })
                    // بعد التحميل، يترك القيمة المحفوظة لو موجودة
                    ->afterStateHydrated(function (callable $set, $state, $record) {
                        // $state هنا هو attribute_value_id لو النموذج جديد أو فارغ
                        // أما في التعديل فـ $state يكون null في بعض الحالات، فنعبّيه من الـ record
                        $set(
                            'attribute_value_id',
                            $state ?? optional($record)->attribute_value_id
                        );
                    })
                    ->required()
                    ->searchable()
                    ->getOptionLabelUsing(fn($value) => AttributeValue::find($value)?->value)
                    ->unique(
                        ProductAttributeValueModel::class,
                        'attribute_value_id',
                        fn($record) => $record?->id
                    ),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('value')
            ->columns([
                Tables\Columns\TextColumn::make(app()->getLocale() == 'ar' ? 'attributeValue.attribute.name_ar' : 'attributeValue.attribute.name_en')
                    ->label(__('message.Attribute'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('attributeValue.value')
                    ->label(__('message.Attribute Value'))
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
