<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Services\PaginationService;
use Tests\TestCase;

class PaginationServiceTest extends TestCase
{
    public function testGetPageSwitcherNumbers(): void
    {
        $paginationService = new PaginationService();

        $this->assertSame([1], $paginationService->getPageSwitcherNumbers(1, 1));

        $this->assertSame([1, 2], $paginationService->getPageSwitcherNumbers(1, 20));
        $this->assertSame([1, 2], $paginationService->getPageSwitcherNumbers(2, 20));

        $this->assertSame([1, 2, 3], $paginationService->getPageSwitcherNumbers(1, 30));
        $this->assertSame([1, 2, 3], $paginationService->getPageSwitcherNumbers(2, 30));
        $this->assertSame([1, 2, 3], $paginationService->getPageSwitcherNumbers(3, 30));

        $this->assertSame([1, 2, 3, 4], $paginationService->getPageSwitcherNumbers(1, 40));
        $this->assertSame([1, 2, 3, 4], $paginationService->getPageSwitcherNumbers(2, 40));
        $this->assertSame([1, 2, 3, 4], $paginationService->getPageSwitcherNumbers(3, 40));
        dd($paginationService->getPageSwitcherNumbers(4, 40));
        $this->assertSame([1, 2, 3, 4], $paginationService->getPageSwitcherNumbers(4, 40));

        $this->assertSame([1, 2, 3, 4, 5], $paginationService->getPageSwitcherNumbers(1, 50));
        $this->assertSame([1, 2, 3, 4, 5], $paginationService->getPageSwitcherNumbers(2, 50));
        $this->assertSame([1, 2, 3, 4, 5], $paginationService->getPageSwitcherNumbers(3, 50));
        $this->assertSame([1, 2, 3, 4, 5], $paginationService->getPageSwitcherNumbers(4, 50));
        dd($paginationService->getPageSwitcherNumbers(5, 50));
        $this->assertSame([1, 2, 3, 4, 5], $paginationService->getPageSwitcherNumbers(5, 50));

        $this->assertSame([1, '...', 4, 5, 6], $paginationService->getPageSwitcherNumbers(5, 60));
        $this->assertSame([1, '...', 4, 5, 6], $paginationService->getPageSwitcherNumbers(4, 60));
        $this->assertSame([1, 2, 3, 4, '...', 6], $paginationService->getPageSwitcherNumbers(3, 60));
        $this->assertSame([1, 2, 3, 4, '...', 6], $paginationService->getPageSwitcherNumbers(2, 60));
        $this->assertSame([1, 2, 3, 4, 5, 6], $paginationService->getPageSwitcherNumbers(1, 60));
    }
}
