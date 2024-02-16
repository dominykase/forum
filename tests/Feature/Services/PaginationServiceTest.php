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
        $this->assertSame([1, 2, 3, 4], $paginationService->getPageSwitcherNumbers(4, 40));

        $this->assertSame([1, 2, 3, 4, 5], $paginationService->getPageSwitcherNumbers(1, 50));
        $this->assertSame([1, 2, 3, 4, 5], $paginationService->getPageSwitcherNumbers(2, 50));
        $this->assertSame([1, 2, 3, 4, 5], $paginationService->getPageSwitcherNumbers(3, 50));
        $this->assertSame([1, 2, 3, 4, 5], $paginationService->getPageSwitcherNumbers(4, 50));
        $this->assertSame([1, 2, 3, 4, 5], $paginationService->getPageSwitcherNumbers(5, 50));

        $this->assertSame([1, '...', 3, 4, 5, 6, 7], $paginationService->getPageSwitcherNumbers(7, 70));
        $this->assertSame([1, '...', 3, 4, 5, 6, 7], $paginationService->getPageSwitcherNumbers(6, 70));
        $this->assertSame([1, '...', 3, 4, 5, 6, 7], $paginationService->getPageSwitcherNumbers(5, 70));
        $this->assertSame([1, '...', 3, 4, 5, 6, 7], $paginationService->getPageSwitcherNumbers(4, 70));
        $this->assertSame([1, 2, 3, 4, 5, '...' , 7], $paginationService->getPageSwitcherNumbers(3, 70));
        $this->assertSame([1, 2, 3, 4, 5, '...', 7], $paginationService->getPageSwitcherNumbers(2, 70));
        $this->assertSame([1, 2, 3, 4, 5, '...', 7], $paginationService->getPageSwitcherNumbers(1, 70));

        $this->assertSame([1, '...', 6, 7, 8, 9, 10], $paginationService->getPageSwitcherNumbers(10, 100));
        $this->assertSame([1, '...', 6, 7, 8, 9, 10], $paginationService->getPageSwitcherNumbers(9, 100));
        $this->assertSame([1, '...', 6, 7, 8, 9, 10], $paginationService->getPageSwitcherNumbers(8, 100));
        $this->assertSame([1, '...', 6, 7, 8, 9, 10], $paginationService->getPageSwitcherNumbers(7, 100));
        $this->assertSame([1, '...', 5, 6, 7, '...', 10], $paginationService->getPageSwitcherNumbers(6, 100));
        $this->assertSame([1, '...', 4, 5, 6, '...', 10], $paginationService->getPageSwitcherNumbers(5, 100));
        $this->assertSame([1, '...', 3, 4, 5, '...', 10], $paginationService->getPageSwitcherNumbers(4, 100));
        $this->assertSame([1, 2, 3, 4, 5, '...', 10], $paginationService->getPageSwitcherNumbers(3, 100));
        $this->assertSame([1, 2, 3, 4, 5, '...', 10], $paginationService->getPageSwitcherNumbers(2, 100));
        $this->assertSame([1, 2, 3, 4, 5, '...', 10], $paginationService->getPageSwitcherNumbers(1, 100));
    }
}
