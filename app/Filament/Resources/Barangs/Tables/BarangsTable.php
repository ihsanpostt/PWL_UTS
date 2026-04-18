<?php

namespace App\Filament\Resources\Barangs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BarangsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('barang_id')->sortable(),
                TextColumn::make('kategori.kategori_nama')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('barang_kode')
                    ->label('Kode')
                    ->searchable(),
                TextColumn::make('barang_nama')
                    ->label('Nama Barang')
                    ->searchable(),
                TextColumn::make('harga_beli')->label('Harga Beli'),
                TextColumn::make('harga_jual')->label('Harga Jual'),
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
