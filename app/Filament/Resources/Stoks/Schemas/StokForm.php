<?php

namespace App\Filament\Resources\Stoks\Schemas;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StokForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('supplier_id')
                    ->label('Supplier')
                    ->options(Supplier::all()->pluck('supplier_nama', 'supplier_id'))
                    ->searchable()
                    ->required(),
                Select::make('barang_id')
                    ->label('Barang')
                    ->options(Barang::all()->pluck('barang_nama', 'barang_id'))
                    ->searchable()
                    ->required(),
                Select::make('user_id')
                    ->label('User / Petugas')
                    ->options(User::all()->pluck('nama', 'user_id'))
                    ->searchable()
                    ->required(),
                DateTimePicker::make('stok_tanggal')
                    ->label('Tanggal Stok')
                    ->default(now())
                    ->required(),
                TextInput::make('stok_jumlah')
                    ->label('Jumlah Stok')
                    ->numeric()
                    ->required(),
            ]);
    }
}
