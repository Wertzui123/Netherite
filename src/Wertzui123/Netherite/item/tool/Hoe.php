<?php

namespace Wertzui123\Netherite\item\tool;

use pocketmine\block\Block;
use pocketmine\block\BlockToolType;
use pocketmine\entity\Entity;

class Hoe extends TieredTool
{

    public function onAttackEntity(Entity $victim) : bool{
        return $this->applyDamage(1);
    }

}