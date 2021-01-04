<?php

namespace Wertzui123\Netherite;

use pocketmine\block\BlockFactory;
use pocketmine\inventory\ShapedRecipe;
use pocketmine\inventory\ShapelessRecipe;
use Wertzui123\Netherite\block\Dirt;
use Wertzui123\Netherite\block\Grass;
use Wertzui123\Netherite\item\armor\NetheriteBoots;
use Wertzui123\Netherite\item\armor\NetheriteChestplate;
use Wertzui123\Netherite\item\armor\NetheriteHelmet;
use Wertzui123\Netherite\item\armor\NetheriteLeggings;
use Wertzui123\Netherite\item\tool\Axe;
use Wertzui123\Netherite\item\tool\Hoe;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use Wertzui123\Netherite\item\tool\Shovel;
use pocketmine\plugin\PluginBase;
use Wertzui123\Netherite\item\tool\Pickaxe;
use Wertzui123\Netherite\item\tool\Sword;
use Wertzui123\Netherite\item\tool\TieredTool;

class Main extends PluginBase
{

    const ITEM_NETHERITE_SCRAP = 752;
    const ITEM_NETHERITE_INGOT = 742;
    const ITEM_NETHERITE_SWORD = 743;
    const ITEM_NETHERITE_SHOVEL = 744;
    const ITEM_NETHERITE_PICKAXE = 745;
    const ITEM_NETHERITE_AXE = 746;
    const ITEM_NETHERITE_HOE = 747;

    public function onEnable()
    {
        BlockFactory::registerBlock(new Grass(), true);
        BlockFactory::registerBlock(new Dirt(), true);
        ItemFactory::registerItem(new Item(self::ITEM_NETHERITE_INGOT, 0, "Netherite Ingot"), true);
        ItemFactory::registerItem(new Item(self::ITEM_NETHERITE_SCRAP, 0, "Netherite Scrap"), true);
        ItemFactory::registerItem(new Sword(self::ITEM_NETHERITE_SWORD, 0, "Netherite Sword", TieredTool::TIER_NETHERITE), true);
        ItemFactory::registerItem(new Shovel(self::ITEM_NETHERITE_SHOVEL, 0, "Netherite Shovel", TieredTool::TIER_NETHERITE), true);
        ItemFactory::registerItem(new Pickaxe(self::ITEM_NETHERITE_PICKAXE, 0, "Netherite Pickaxe", TieredTool::TIER_NETHERITE), true);
        ItemFactory::registerItem(new Axe(self::ITEM_NETHERITE_AXE, 0, "Netherite Axe", TieredTool::TIER_NETHERITE), true);
        ItemFactory::registerItem(new Hoe(self::ITEM_NETHERITE_HOE, 0, "Netherite Hoe", TieredTool::TIER_NETHERITE), true);
        ItemFactory::registerItem(new NetheriteHelmet(), true);
        ItemFactory::registerItem(new NetheriteChestplate(), true);
        ItemFactory::registerItem(new NetheriteLeggings(), true);
        ItemFactory::registerItem(new NetheriteBoots(), true);
        Item::initCreativeItems();

        switch ($this->getConfig()->get('crafting-recipes', false)) {
            case 'vanilla':
                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([Item::get(Item::DIAMOND_SWORD), Item::get(self::ITEM_NETHERITE_INGOT)], [Item::get(self::ITEM_NETHERITE_SWORD)]));
                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([Item::get(Item::DIAMOND_SHOVEL), Item::get(self::ITEM_NETHERITE_INGOT)], [Item::get(self::ITEM_NETHERITE_SHOVEL)]));
                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([Item::get(Item::DIAMOND_PICKAXE), Item::get(self::ITEM_NETHERITE_INGOT)], [Item::get(self::ITEM_NETHERITE_PICKAXE)]));
                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([Item::get(Item::DIAMOND_AXE), Item::get(self::ITEM_NETHERITE_INGOT)], [Item::get(self::ITEM_NETHERITE_AXE)]));

                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([Item::get(Item::DIAMOND_HELMET), Item::get(self::ITEM_NETHERITE_INGOT)], [Item::get(NetheriteHelmet::NETHERITE_HELMET)]));
                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([Item::get(Item::DIAMOND_CHESTPLATE), Item::get(self::ITEM_NETHERITE_INGOT)], [Item::get(NetheriteChestplate::NETHERITE_CHESTPLATE)]));
                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([Item::get(Item::DIAMOND_LEGGINGS), Item::get(self::ITEM_NETHERITE_INGOT)], [Item::get(NetheriteLeggings::NETHERITE_LEGGINGS)]));
                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([Item::get(Item::DIAMOND_BOOTS), Item::get(self::ITEM_NETHERITE_INGOT)], [Item::get(NetheriteBoots::NETHERITE_BOOTS)]));
                break;
            case 'custom':
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            ' A ',
                            ' A ',
                            ' B '
                        ],
                        ['A' => Item::get(self::ITEM_NETHERITE_INGOT), 'B' => Item::get(Item::STICK)],
                        [Item::get(self::ITEM_NETHERITE_SWORD)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            ' A ',
                            ' B ',
                            ' B '
                        ],
                        ['A' => Item::get(self::ITEM_NETHERITE_INGOT), 'B' => Item::get(Item::STICK)],
                        [Item::get(self::ITEM_NETHERITE_SHOVEL)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            'AAA',
                            ' B ',
                            ' B '
                        ],
                        ['A' => Item::get(self::ITEM_NETHERITE_INGOT), 'B' => Item::get(Item::STICK)],
                        [Item::get(self::ITEM_NETHERITE_PICKAXE)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            ' AA',
                            ' BA',
                            ' B '
                        ],
                        ['A' => Item::get(self::ITEM_NETHERITE_INGOT), 'B' => Item::get(Item::STICK)],
                        [Item::get(self::ITEM_NETHERITE_AXE)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            'AA ',
                            'AB ',
                            ' B '
                        ],
                        ['A' => Item::get(self::ITEM_NETHERITE_INGOT), 'B' => Item::get(Item::STICK)],
                        [Item::get(self::ITEM_NETHERITE_AXE)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            'AA ',
                            ' B ',
                            ' B '
                        ],
                        ['A' => Item::get(self::ITEM_NETHERITE_INGOT), 'B' => Item::get(Item::STICK)],
                        [Item::get(self::ITEM_NETHERITE_HOE)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            ' AA',
                            ' B ',
                            ' B '
                        ],
                        ['A' => Item::get(self::ITEM_NETHERITE_INGOT), 'B' => Item::get(Item::STICK)],
                        [Item::get(self::ITEM_NETHERITE_HOE)])
                );

                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            'AAA',
                            'A A',
                            '   '
                        ],
                        ['A' => Item::get(self::ITEM_NETHERITE_INGOT)],
                        [Item::get(NetheriteHelmet::NETHERITE_HELMET)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            'A A',
                            'AAA',
                            'AAA'
                        ],
                        ['A' => Item::get(self::ITEM_NETHERITE_INGOT)],
                        [Item::get(NetheriteChestplate::NETHERITE_CHESTPLATE)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            'AAA',
                            'A A',
                            'A A'
                        ],
                        ['A' => Item::get(self::ITEM_NETHERITE_INGOT)],
                        [Item::get(NetheriteLeggings::NETHERITE_LEGGINGS)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            '   ',
                            'A A',
                            'A A'
                        ],
                        ['A' => Item::get(self::ITEM_NETHERITE_INGOT)],
                        [Item::get(NetheriteBoots::NETHERITE_BOOTS)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            'A A',
                            'A A',
                            '   '
                        ],
                        ['A' => Item::get(self::ITEM_NETHERITE_INGOT)],
                        [Item::get(NetheriteBoots::NETHERITE_BOOTS)])
                );
                break;
        }

        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }

}
