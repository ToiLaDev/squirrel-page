<?php

namespace Squirrel\Page\Controllers;

use App\Http\Controllers\Controller;
use Squirrel\Page\Models\Page;

class PageController extends Controller
{
    public function displayView(Page $page) {
        dd($page->toArray());
    }
}
