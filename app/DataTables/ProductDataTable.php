<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
             ->addColumn('#', function () {
                static $count = 0;
                $count++;
                return $count;
             })
            ->addColumn('action', 'admin.products.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        $query = $model->newQuery();
    
        if ($this->request->has('created_at')) {
            $created_at = $this->request->get('created_at');
            if ($created_at) {
               
                $date = Carbon::parse($created_at)->toDateString();
                $query->whereDate('created_at', '=', $date);
            }
        }
        $query->with('category','subcategory','auctiontype','project');
        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('#'),
            Column::make('lot_no')->title('Lot No'),
            Column::make('title')->title('Title'),
            // Column::computed('category_name')
            //         ->data('category.name') 
            //        ->title('Category'),
            Column::computed('auctiontype')
                   ->data('auctiontype.name') 
                   ->title('Auctiontype'),
            Column::computed('project')
                   ->data('project.name') 
                   ->title('Project'),
            Column::make('auction_end_date')->title('Auction End Date'),
            Column::make('reserved_price')->title('Reserved Price'),
            Column::make('description')->title('Description'),
            Column::make('status')->title('Status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
