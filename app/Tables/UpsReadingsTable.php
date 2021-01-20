<?php

namespace App\Tables;

use App\Models\Ups;
use App\Models\UpsReading;
use Illuminate\Database\Eloquent\Builder;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;

class UpsReadingsTable extends AbstractTable
{
    protected Ups $ups;

    public function __construct(Ups $ups)
    {
        $this->ups = $ups;
    }

    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table())->model(UpsReading::class)
            ->routes([
                'index'   => ['name' => 'ups.history', 'params' => [ 'id' => $this->ups->id,]],
            ])
            ->query(function (Builder $query) {
                $query->where('device_id', $this->ups->device_id);
            })
            ->rowsNumber(50)
            ->destroyConfirmationHtmlAttributes(fn(UpsReading $upsReading) => [
                'data-confirm' => __('Are you sure you want to delete the line ' . $upsReading->database_attribute . ' ?'),
            ]);
    }

    /**
     * Configure the table columns.
     *
     * @param \Okipa\LaravelTable\Table $table
     *
     * @throws \ErrorException
     */
    protected function columns(Table $table): void
    {
        $table->column('')->classes(['text-center'])->html(function(UpsReading $upsReading) {
            return '<i class="material-icons text-' . $upsReading->getColor() . '">' . $upsReading->getIcon() . '</i>';
        });
        $table->column('created_at')->title('Date')->sortable(true, 'desc')->searchable();
        $table->column('device_id')->title('Device')->sortable()->searchable();
        $table->column('status')->title('Status')->sortable()->searchable();
        $table->column('voltage_in')->title('Voltage in')->appendsHtml(' V', true);
        $table->column('frequency_in')->title('Frequency in')->appendsHtml(' Hz', true);
        $table->column('voltage_out')->title('Voltage out')->appendsHtml(' V', true);
        $table->column('frequency_out')->title('Frequency out')->appendsHtml(' Hz', true);
    }

    /**
     * Configure the table result lines.
     *
     * @param \Okipa\LaravelTable\Table $table
     */
    protected function resultLines(Table $table): void
    {
        //
    }
}
