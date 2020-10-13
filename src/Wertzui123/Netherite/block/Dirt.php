<?php

namespace Wertzui123\Netherite\block;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\item\Hoe;
use pocketmine\item\Item;
use pocketmine\Player;

class Dirt extends \pocketmine\block\Dirt
{

    public function onActivate(Item $item, Player $player = null) : bool{
        if($item instanceof Hoe or $item instanceof \Wertzui123\Netherite\item\tool\Hoe){
            $item->applyDamage(1);
            if($this->meta === 1){
                $this->getLevel()->setBlock($this, BlockFactory::get(Block::DIRT), true);
            }else{
                $this->getLevel()->setBlock($this, BlockFactory::get(Block::FARMLAND), true);
            }

            return true;
        }

        return false;
    }

}