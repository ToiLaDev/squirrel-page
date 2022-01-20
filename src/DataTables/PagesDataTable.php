<?php

namespace Squirrel\Page\DataTables;

use App\DataTables\BaseDataTable;
use Squirrel\Page\Repositories\PageRepository;

class PagesDataTable extends BaseDataTable
{
    protected $exportColumns = [
        ['data' => 'id', 'title' => 'id'],
        ['data' => 'name', 'title' => 'name'],
        ['data' => 'title', 'title' => 'title'],
        ['data' => 'slug', 'title' => 'slug'],
        ['data' => 'excerpt', 'title' => 'excerpt'],
        ['data' => 'owner_id', 'title' => 'owner_id'],
        ['data' => 'created_at', 'title' => 'created_at']
    ];

    protected $columns = [
        'id' => [
            'data' => '_id',
            'title' => 'ID',
            'raw' => [
                'type' => 'id'
            ]
        ],
        'name' => [],
        'created_at' => [
            'raw' => []
        ],
        'action' => [
            'raw' => [
                'type' => 'acast'
            ],
            'width' => 80,
            'addClass' => 'text-center'
        ]
    ];

    protected $showButtons = ['create', 'excel', 'reload'];

    public function query(PageRepository $repository)
    {
        return $repository->newQuery();
    }
}
