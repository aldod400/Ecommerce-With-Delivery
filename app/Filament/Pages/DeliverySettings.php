<?php

namespace App\Filament\Pages;

use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use App\Models\Setting;

class DeliverySettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static string $view = 'filament.pages.delivery-settings';
    protected static ?int $navigationSort = 5;

    public function getTitle(): string
    {
        return __('message.DeliverySettings');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('message.Settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('message.DeliverySettings');
    }
    public static function getPluralModelLabel(): string
    {
        return __('message.DeliverySettings');
    }

    public static function getModelLabel(): string
    {
        return __('message.DeliverySetting');
    }
    public array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'deliveryman' => Setting::where('key', 'deliveryman')->first()?->value,
            'delivery_fee_type' => Setting::where('key', 'delivery_fee_type')->first()?->value,
            'delivery_fee_fixed' => Setting::where('key', 'delivery_fee_fixed')->first()?->value,
            'delivery_fee_per_km' => Setting::where('key', 'delivery_fee_per_km')->first()?->value,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\Section::make(__('message.delivery_settings'))
                    ->schema([
                        Components\Toggle::make('deliveryman')
                            ->label(__('message.enable_delivery'))
                            ->live()
                            ->onColor('success')
                            ->offColor('danger'),

                        Components\Select::make('delivery_fee_type')
                            ->label(__('message.delivery_fee_type'))
                            ->options([
                                'fixed' => __('message.fixed_price'),
                                'per_km' => __('message.per_km'),
                                'area' => __('message.by_area'),
                            ])
                            ->required()
                            ->live()
                            ->visible(fn($get) => $get('deliveryman')),

                        Components\TextInput::make('delivery_fee_fixed')
                            ->label(__('message.fixed_delivery_fee'))
                            ->numeric()
                            ->required()
                            ->visible(fn($get) =>
                            $get('deliveryman') && $get('delivery_fee_type') === 'fixed'),

                        Components\TextInput::make('delivery_fee_per_km')
                            ->label(__('message.per_km_delivery_fee'))
                            ->numeric()
                            ->required()
                            ->visible(fn($get) =>
                            $get('deliveryman') && $get('delivery_fee_type') === 'per_km'),
                    ])
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        if (!$data['deliveryman']) {
            Setting::whereIn('key', [
                'deliveryman',
                'delivery_fee_type',
                'delivery_fee_fixed',
                'delivery_fee_per_km'
            ])->update(['value' => null]);

            $this->form->fill([
                'deliveryman' => false,
                'delivery_fee_type' => null,
                'delivery_fee_fixed' => null,
                'delivery_fee_per_km' => null,
            ]);
        } else {
            foreach ($this->form->getState() as $key => $value) {
                Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }
        }

        Notification::make()
            ->title(__('message.settings_saved_successfully'))
            ->success()
            ->send();
        redirect()->to(DeliverySettings::getUrl());
    }
}
