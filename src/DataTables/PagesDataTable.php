<?php

namespace Squirrel\Page\DataTables;

use Squirrel\Page\Models\Page;
use Illuminate\Database\Eloquent\Builder;
use Squirrel\Page\Repositories\PageRepository;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PagesDataTable extends DataTable
{
    protected $exportColumns = [
        ['data' => 'id', 'title' => 'ID'],
        ['data' => 'name', 'title' => 'Name']
    ];

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('_id', 'Admin::datatable.formats.id')
            ->addColumn('created_at', 'Admin::datatable.formats.created_at')
            ->addColumn('action', function (Page $model) {
                return view('Admin::datatable.action', [
                    'id' => $model->id,
                    'hide' => ['view'],
                    'preview' => route('cast', $model->cast->toArray())
                ]);
            })
            ->rawColumns(['_id', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Post $model
     * @return Builder
     */
    public function query(PageRepository $pageRepo)
    {
        return $pageRepo->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('pages-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' .
                        '<"col-lg-12 col-xl-3"l>' .
                        '<"col-lg-12 col-xl-9 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap me-1"<"me-1"f>B>>' .
                        '>t' .
                        '<"d-flex justify-content-between mx-2 row mb-1"' .
                        '<"col-sm-12 col-md-6"i>' .
                        '<"col-sm-12 col-md-6"p>' .
                        '>')
                    ->buttons(
                        Button::make([
                            'extend' => 'create',
                            'className' => 'btn-primary',
                            'text' => __('Add New')
                        ]),
                        Button::make([
                            'extend' => 'reload',
                            'className' => 'btn-secondary',
                            'text' => __('Reload')
                        ])
                    )
                    ->language([
                        'emptyTable' => __('No data available in table'),
                        'info' => __('Showing _START_ to _END_ of _TOTAL_ entries'),
                        'infoEmpty' => __('Showing 0 to 0 of 0 entries'),
                        'loadingRecords' => __('Loading...'),
                        'processing' => __('Processing...'),
                        'search' => __('Search:'),
                        'paginate' => [
                            'first' => __('First'),
                            'last' => __('Last'),
                            'next' => __('Next'),
                            'previous' => __('Previous'),
                        ],
                        'lengthMenu' => __('Show _MENU_ entries')
                    ])
            ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')
                ->data('_id')
                ->title(__('ID')),
            Column::make('name')
                ->title(__('Name')),
            Column::make('created_at')
                ->title(__('Created at')),
            Column::computed('action')
                ->title(__('Actions'))
                ->width(80)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Pages_' . date('YmdHis');
    }
}
