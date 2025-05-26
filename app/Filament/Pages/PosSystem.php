<?php

namespace App\Filament\Pages;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Enums\OrderStatus;
use Filament\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PosSystem extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    protected static ?string $navigationLabel = 'POS';
    protected static ?string $title = 'Point of Sale System';
    public function getTitle(): string
    {
        return __('message.POS System');
    }

    public static function getNavigationLabel(): string
    {
        return __('message.POS System');
    }
    public static function getPluralModelLabel(): string
    {
        return __('message.POS System');
    }

    public static function getModelLabel(): string
    {
        return __('message.POS System');
    }

    protected static ?int $navigationSort = 7;
    protected static string $view = 'filament.pages.pos-system';

    public ?array $data = [];
    public $cart = [];
    public $subtotal = 0;
    public $total = 0;
    public $searchQuery = '';
    public $products = [];
    public $selectedUser = null;
    public $newUser = [
        'name' => '',
        'phone' => ''
    ];
    public $address = '';
    public $users = [];
    public $discount = 0;

    public function mount(): void
    {
        $this->form->fill();
        $this->loadProducts();
        $this->users = User::where('user_type', 'user')->get();
    }

    public function loadProducts(): void
    {
        $query = Product::query();
        if (!empty($this->searchQuery)) {
            $query->where(function ($q) {
                $q->where('name_ar', 'like', "%{$this->searchQuery}%")
                    ->orWhere('name_en', 'like', "%{$this->searchQuery}%");
            });
        }

        $this->products = $query->get();
    }

    public function updatedSearchQuery(): void
    {
        $this->loadProducts();
    }

    public function addToCart($productId): void
    {
        $product = Product::find($productId);
        if (!$product) {
            Notification::make()
                ->title(__('message.Product not found'))
                ->danger()
                ->send();
            return;
        }

        if ($product->quantity <= 0) {
            Notification::make()
                ->title(__('message.Product out of stock'))
                ->danger()
                ->send();
            return;
        }

        // Check if product already in cart
        foreach ($this->cart as $index => $item) {
            if ($item['id'] == $productId) {
                // Update quantity
                $this->cart[$index]['quantity'] += 1;
                $this->cart[$index]['total'] = $this->cart[$index]['price'] * $this->cart[$index]['quantity'];
                $this->calculateTotal();
                Notification::make()
                    ->title(__('message.Product updated'))
                    ->success()
                    ->send();
                return;
            }
        }

        // Add new product to cart
        $this->cart[] = [
            'id' => $product->id,
            'name' => app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en,
            'price' => $product->discount_price ?? $product->price,
            'quantity' => 1,
            'total' => $product->discount_price ?? $product->price,
        ];

        $this->calculateTotal();

        Notification::make()
            ->title(__('message.Product added to cart'))
            ->success()
            ->send();
    }

    public function removeFromCart($index): void
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart);
        $this->calculateTotal();

        Notification::make()
            ->title(__('message.Product removed from cart'))
            ->success()
            ->send();
    }

    public function updateQuantity($index, $quantity): void
    {
        if ($quantity <= 0) {
            $this->removeFromCart($index);
            return;
        }

        $this->cart[$index]['quantity'] = $quantity;
        $this->cart[$index]['total'] = $this->cart[$index]['price'] * $quantity;
        $this->calculateTotal();
    }

    public function calculateTotal(): void
    {
        $this->subtotal = 0;

        foreach ($this->cart as $item) {
            $this->subtotal += $item['price'] * $item['quantity'];
        }

        $discount = (float)($this->discount ?? 0);
        $this->total = max(0, $this->subtotal - $discount);
    }

    public function updatedDiscount(): void
    {
        $this->calculateTotal();
    }

    public function clearCart(): void
    {
        $this->cart = [];
        $this->subtotal = 0;
        $this->total = 0;

        Notification::make()
            ->title(__('message.Cart cleared'))
            ->success()
            ->send();
    }

    public function createOrder(): void
    {
        if (empty($this->cart)) {
            Notification::make()
                ->title(__('message.Cart is empty'))
                ->danger()
                ->send();
            return;
        }
        if (!$this->selectedUser) {
            Notification::make()
                ->title(__('message.User not selected'))
                ->danger()
                ->send();
            return;
        }

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => $this->selectedUser,
                'status' => OrderStatus::CONFIRMED->value,
                'payment_method' => 'cash',
                'payment_status' => 'paid',
                'subtotal' => $this->subtotal,
                'total' => $this->total,
                'order_type' => 'pos',
                'created_by' => Auth::id(),
                'address' => $this->address,
                'discount' => $this->discount,
            ]);

            // Create order details
            foreach ($this->cart as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // Update product quantity
                $product = Product::find($item['id']);
                $product->quantity -= $item['quantity'];
                $product->save();
            }

            DB::commit();

            $this->clearCart();

            Notification::make()
                ->title(__('message.Order created successfully'))
                ->success()
                ->send();
        } catch (\Exception $e) {
            DB::rollBack();

            Notification::make()
                ->title(__('message.Error creating order'))
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Form fields for customer info if needed
            ]);
    }

    public function createUser(): void
    {
        $this->validate([
            'newUser.name' => 'required|string|max:255',
            'newUser.phone' => 'required|string|unique:users,phone'
        ]);

        $user = User::create([
            'name' => $this->newUser['name'],
            'phone' => $this->newUser['phone'],
            'password' => Hash::make('password'),
        ]);

        $this->selectedUser = $user->id;
        $this->newUser = ['name' => '', 'phone' => ''];
        $this->users = User::where('user_type', 'user')->get();

        $this->dispatch('close-modal', ['id' => 'create-user-modal']);

        Notification::make()
            ->title(__('message.User created successfully'))
            ->success()
            ->send();

        $this->dispatch('close-modal', ['id' => 'create-user-modal']);
    }
}
