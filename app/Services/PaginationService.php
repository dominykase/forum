<?php

declare(strict_types=1);

namespace App\Services;

class PaginationService
{
    private const DEFAULT_PAGE = 1;
    private const ELLIPSIS = '...';
    private const MIDDLE_COUNT = 3;

    /**
     * @return array<int, mixed>
     */
    public function getPageSwitcherNumbers(int $currentPage, int $totalPages): array
    {
        $pageSwitcherNumbers = [];

        if ($totalPages <= self::MIDDLE_COUNT) {
            for ($i = 1; $i <= $totalPages; $i++) {
                $pageSwitcherNumbers[] = $i;
            }
        } else {
            if ($currentPage <= self::MIDDLE_COUNT) {
                for ($i = 1; $i <= self::MIDDLE_COUNT; $i++) {
                    $pageSwitcherNumbers[] = $i;
                }

                $pageSwitcherNumbers[] = self::ELLIPSIS;
                $pageSwitcherNumbers[] = $totalPages;
            } elseif ($currentPage >= $totalPages - (self::MIDDLE_COUNT - 1)) {
                $pageSwitcherNumbers[] = self::DEFAULT_PAGE;
                $pageSwitcherNumbers[] = self::ELLIPSIS;

                for ($i = $totalPages - (self::MIDDLE_COUNT - 1); $i <= $totalPages; $i++) {
                    $pageSwitcherNumbers[] = $i;
                }
            } else {
                $pageSwitcherNumbers[] = self::DEFAULT_PAGE;
                $pageSwitcherNumbers[] = self::ELLIPSIS;

                for ($i = $currentPage - 1; $i <= $currentPage + 1; $i++) {
                    $pageSwitcherNumbers[] = $i;
                }

                $pageSwitcherNumbers[] = self::ELLIPSIS;
                $pageSwitcherNumbers[] = $totalPages;
            }
        }

        return $pageSwitcherNumbers;
    }
}
