<?php

namespace Squirrel\Page\Controllers\Admin;


use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use Squirrel\Page\DataTables\PagesDataTable;
use Squirrel\Page\Requests\PageRequest;
use Squirrel\Page\Services\PageService;

class PageController extends Controller
{
    public $permissions = [
        'page.view' => ['index'],
        'page.create' => ['create', 'store'],
        'page.edit' => ['edit', 'update'],
        'page.delete' => ['destroy']
    ];

    public $breadcrumbs = [
        ['link' => 'javascript:void(0)', 'name' => 'Content Manager']
    ];

    public $mainRouteName = 'admin.pages.index';

    public $pageService;

    public function __construct(PageService $pageService)
    {
        parent::__construct();
        $this->pageService = $pageService;
    }

    public function index(PagesDataTable $dataTable)
    {
        $this->breadcrumb('Pages');

        return $dataTable->render('Page::admin.list');
    }

    public function create(Request $request)
    {
        $this->breadcrumb('Pages')->withButtonMain();

        return view('Page::admin.create');
    }

    public function edit(int $id, Request $request)
    {
        $this->breadcrumb('Pages')->withButtonMain();

        $page = $this->pageService->find($id);

        return view('Page::admin.edit', ['page' => $page]);
    }

    public function store(PageRequest $request) {
        $page = $this->pageService->createFromRequest($request);

        return $this->storeResponse($page);
    }

    public function update(int $id, PageRequest $request) {
        $page = $this->pageService->updateFromRequest($id, $request);

        return $this->updateResponse($page);
    }

    public function destroy(int $id, Request $request) {

        //$this->pageService->delete($id);

        return $this->deleteResponse();
    }

}
