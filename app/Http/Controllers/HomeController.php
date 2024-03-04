<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Modules\Topics\UseCases\GetTopicsUseCase;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private GetTopicsUseCase $getTopicsUseCase,
    ) {
    }

    public function index(): View
    {
        return view('home', [
            'topics' => $this->getTopicsUseCase->handle(),
        ]);
    }
}

