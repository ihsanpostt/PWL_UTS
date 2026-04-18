<?php

namespace App\Filament\Resources\Stoks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StoksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('stok_id')->sortable(),
                TextColumn::make('supplier.supplier_nama')
                    ->label('Supplier')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('barang.barang_nama')
                    ->label('Barang')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.nama')
                    ->label('Petugas')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('stok_tanggal')
                    ->label('Tanggal')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('stok_jumlah')
                    ->label('Jumlah')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
