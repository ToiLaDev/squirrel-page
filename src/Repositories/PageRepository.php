<?php

namespace Squirrel\Page\Repositories;

use App\Repositories\Repository;
use Squirrel\Page\Models\Page;

class PageRepository extends Repository implements PageRepositoryImpl
{
    public function __construct(Page $page) {
        $this->_model = $page;
    }
}