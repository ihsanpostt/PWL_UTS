<?php

namespace App\Filament\Resources\Penjualans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class PenjualansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('penjualan_tanggal')
                    ->label('Tanggal Penjualan')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('user.nama')
                    ->label('Kasir / User')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('pembeli')
                    ->label('Pembeli')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('penjualan_kode')
                    ->label('Kode Penjualan')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->state(function (\App\Models\Penjualan $record): float {
                        return (float) $record->details->sum(function ($detail) {
                            return $detail->harga * $detail->jumlah;
                        });
                    })
                    ->money('IDR')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
