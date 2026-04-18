<?php

namespace App\Filament\Resources\PenjualanDetails;

use App\Filament\Resources\PenjualanDetails\Pages\CreatePenjualanDetail;
use App\Filament\Resources\PenjualanDetails\Pages\EditPenjualanDetail;
use App\Filament\Resources\PenjualanDetails\Pages\ListPenjualanDetails;
use App\Filament\Resources\PenjualanDetails\Schemas\PenjualanDetailForm;
use App\Filament\Resources\PenjualanDetails\Tables\PenjualanDetailsTable;
use App\Models\PenjualanDetail;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PenjualanDetailResource extends Resource
{
    protected static ?string $model = PenjualanDetail::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Transaksi';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    public static function form(Schema $schema): Schema
    {
        return PenjualanDetailForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenjualanDetailsTable::configure($table);
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
            'index' => ListPenjualanDetails::route('/'),
            'create' => CreatePenjualanDetail::route('/create'),
            'edit' => EditPenjualanDetail::route('/{record}/edit'),
        ];
    }
}
