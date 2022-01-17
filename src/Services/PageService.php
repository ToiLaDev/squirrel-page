<?php

namespace Squirrel\Page\Services;

use App\Services\RepositoryService;
use Squirrel\Page\Repositories\PageRepository;
use Illuminate\Support\Facades\Auth;

class PageService extends RepositoryService implements PageServiceImpl
{

    public function __construct(PageRepository $pageRepo) {
        $this->firstRepo = $pageRepo;
    }

    public function createFromRequest($request)
    {
        $attributes = $request->only(['name', 'title', 'excerpt', 'body']);
        $slug = $request->get('slug');

        $attributes['owner_id'] = Auth::id();
        $page = $this->firstRepo->create($attributes);

        $page->setCast($slug);

        return $page;
    }

    public function updateFromRequest(int $id, $request)
    {
        $attributes = $request->only(['name', 'title', 'excerpt', 'body']);
        $slug = $request->get('slug');

        $page = $this->firstRepo->update($id, $attributes);

        $page->setCast($slug);

        return $page;
    }
}