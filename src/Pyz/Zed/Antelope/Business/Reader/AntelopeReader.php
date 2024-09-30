<?php

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Business\Reader;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;

class AntelopeReader implements AntelopeReaderInterface
{
    private AntelopeRepositoryInterface $repository;

    public function __construct(AntelopeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function findAntelope(AntelopeCriteriaTransfer $antelopeCriteriaTransfer): ?AntelopeResponseTransfer
    {
        $antelopeResponseTransfer = $this->createResponseTransfer();
        $antelopeTransfer = $this->repository->findAntelope($antelopeCriteriaTransfer);
        if (!$antelopeTransfer) {
            return $antelopeResponseTransfer->setIsSuccessFul(false);
        }

        return $antelopeResponseTransfer
            ->setIsSuccessFul(true)
            ->setAntelope($antelopeTransfer);
    }

    private function createResponseTransfer(): AntelopeResponseTransfer
    {
        return new AntelopeResponseTransfer();
    }
}
