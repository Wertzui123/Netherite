<?php

namespace Wertzui123\Netherite\block;

use pocketmine\block\Block;
use pocketmine\block\BlockFactory;
use pocketmine\item\Hoe;
use pocketmine\item\Item;
use pocketmine\item\Shovel;
use pocketmine\level\generator\object\TallGrass as TallGrassObject;
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\utils\Random;

class Grass extends \pocketmine\block\Grass
{

    public function onActivate(Item $item, Player $player = null) : bool{
        if($item->getId() === Item::DYE and $item->getDamage() === 0x0F){
            $item->count--;
            TallGrassObject::growGrass($this->getLevel(), $this, new Random(mt_rand()), 8, 2);

            return true;
        }elseif($item instanceof Hoe or $item instanceof \Wertzui123\Netherite\item\tool\Hoe){
            $item->applyDamage(1);
            $this->getLevel()->setBlock($this, BlockFactory::get(Block::FARMLAND));

            return true;
        }elseif(($item instanceof Shovel or $item instanceof \Wertzui123\Netherite\item\tool\Shovel) and $this->getSide(Vector3::SIDE_UP)->getId() === Block::AIR){
            $item->applyDamage(1);
            $this->getLevel()->setBlock($this, BlockFactory::get(Block::GRASS_PATH));

            return true;
        }

        return false;
    }

}