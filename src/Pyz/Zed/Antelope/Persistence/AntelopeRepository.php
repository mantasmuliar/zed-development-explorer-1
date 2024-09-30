<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeRepository extends AbstractRepository implements AntelopeRepositoryInterface
{
    public function findAntelope(AntelopeCriteriaTransfer $antelopeCriteriaTransfer): ?AntelopeTransfer
    {
        $pyzAntelope = $this->getFactory()
            ->createAntelopeQuery()
            ->filterByName($antelopeCriteriaTransfer->getName())
            ->findOne();

        if (!$pyzAntelope) {
            return null;
        }

        return (new AntelopeTransfer())->fromArray($pyzAntelope->toArray(), true);
    }

    public function findAntelopeLocationById(int $idLocation): ?AntelopeLocationTransfer
    {
        $pyzAntelopeLocation = $this->getFactory()
            ->createAntelopeLocationQuery()
            ->findOneByIdLocation($idLocation);

        if (!$pyzAntelopeLocation) {
            return null;
        }

        return (new AntelopeLocationTransfer())
            ->fromArray($pyzAntelopeLocation->toArray(), true);
    }
}
