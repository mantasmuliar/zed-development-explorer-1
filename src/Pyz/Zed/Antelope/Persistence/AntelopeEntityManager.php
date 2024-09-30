<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Orm\Zed\Antelope\Persistence\PyzAntelopeLocation;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeEntityManager extends AbstractEntityManager implements AntelopeEntityManagerInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        $pyzAntelope = new PyzAntelope();
        $pyzAntelope->fromArray($antelopeTransfer->toArray());
        $pyzAntelope->save();

        return $antelopeTransfer->setIdAntelope($pyzAntelope->getIdAntelope());
    }

    public function updateAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        $pyzAntelope = $this->getFactory()
            ->createAntelopeQuery()
            ->findOneByIdAntelope($antelopeTransfer->getIdAntelope());

        $pyzAntelope
            ->setName($antelopeTransfer->getName())
            ->setFkLocation($antelopeTransfer->getFkLocation());
        $pyzAntelope->save();

        return $antelopeTransfer->fromArray($pyzAntelope->toArray(), true);
    }

    public function createAntelopeLocation(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer
    {
        $pyzAntelopeLocation = new PyzAntelopeLocation();
        $pyzAntelopeLocation->fromArray($antelopeLocationTransfer->toArray());
        $pyzAntelopeLocation->save();

        return $antelopeLocationTransfer->fromArray($pyzAntelopeLocation->toArray(), true);
    }
}
