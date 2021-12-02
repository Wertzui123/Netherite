<?php

namespace Wertzui123\Netherite;

use pocketmine\crafting\ShapedRecipe;
use pocketmine\crafting\ShapelessRecipe;
use pocketmine\inventory\ArmorInventory;
use pocketmine\item\Armor;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\Axe;
use pocketmine\item\Hoe;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemIds;
use pocketmine\item\Pickaxe;
use pocketmine\item\Shovel;
use pocketmine\item\Sword;
use pocketmine\item\ToolTier;
use pocketmine\item\VanillaItems;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{

    const ITEM_NETHERITE_SCRAP = 752;
    const ITEM_NETHERITE_INGOT = 742;
    const ITEM_NETHERITE_SWORD = 743;
    const ITEM_NETHERITE_SHOVEL = 744;
    const ITEM_NETHERITE_PICKAXE = 745;
    const ITEM_NETHERITE_AXE = 746;
    const ITEM_NETHERITE_HOE = 747;
    const NETHERITE_HELMET = 748;
    const NETHERITE_CHESTPLATE = 749;
    const NETHERITE_LEGGINGS = 750;
    const NETHERITE_BOOTS = 751;

    public function onEnable(): void
    {
        $class = new \ReflectionClass(ToolTier::class);
        $register = $class->getMethod('register');
        $register->setAccessible(true);
        $constructor = $class->getConstructor();
        $constructor->setAccessible(true);
        $instance = $class->newInstanceWithoutConstructor();
        $constructor->invoke($instance, 'netherite', 6, 2031, 9, 10);
        $register->invoke(null, $instance);

        ItemFactory::getInstance()->register(new Item(new ItemIdentifier(self::ITEM_NETHERITE_INGOT, 0), 'Netherite Ingot'));
        ItemFactory::getInstance()->register(new Item(new ItemIdentifier(self::ITEM_NETHERITE_SCRAP, 0), 'Netherite Scrap'));
        ItemFactory::getInstance()->register(new Sword(new ItemIdentifier(self::ITEM_NETHERITE_SWORD, 0), 'Netherite Sword', ToolTier::NETHERITE()));
        ItemFactory::getInstance()->register(new Shovel(new ItemIdentifier(self::ITEM_NETHERITE_SHOVEL, 0), 'Netherite Shovel', ToolTier::NETHERITE()));
        ItemFactory::getInstance()->register(new Pickaxe(new ItemIdentifier(self::ITEM_NETHERITE_PICKAXE, 0), 'Netherite Pickaxe', ToolTier::NETHERITE()));
        ItemFactory::getInstance()->register(new Axe(new ItemIdentifier(self::ITEM_NETHERITE_AXE, 0), 'Netherite Axe', ToolTier::NETHERITE()));
        ItemFactory::getInstance()->register(new Hoe(new ItemIdentifier(self::ITEM_NETHERITE_HOE, 0), 'Netherite Hoe', ToolTier::NETHERITE()));

        ItemFactory::getInstance()->register(new Armor(new ItemIdentifier(self::NETHERITE_HELMET, 0), 'Netherite Helmet', new ArmorTypeInfo(6, 407, ArmorInventory::SLOT_HEAD)));
        ItemFactory::getInstance()->register(new Armor(new ItemIdentifier(self::NETHERITE_CHESTPLATE, 0), 'Netherite Chestplate', new ArmorTypeInfo(3, 592, ArmorInventory::SLOT_CHEST)));
        ItemFactory::getInstance()->register(new Armor(new ItemIdentifier(self::NETHERITE_LEGGINGS, 0), 'Netherite Leggings', new ArmorTypeInfo(3, 481, ArmorInventory::SLOT_LEGS)));
        ItemFactory::getInstance()->register(new Armor(new ItemIdentifier(self::NETHERITE_BOOTS, 0), 'Netherite Boots', new ArmorTypeInfo(6, 555, ArmorInventory::SLOT_FEET)));

        switch ($this->getConfig()->get('crafting-recipes', false)) {
            case 'vanilla':
                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([VanillaItems::DIAMOND_SWORD(), ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT)], [ItemFactory::getInstance()->get(self::ITEM_NETHERITE_SWORD)]));
                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([VanillaItems::DIAMOND_SHOVEL(), ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT)], [ItemFactory::getInstance()->get(self::ITEM_NETHERITE_SHOVEL)]));
                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([VanillaItems::DIAMOND_PICKAXE(), ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT)], [ItemFactory::getInstance()->get(self::ITEM_NETHERITE_PICKAXE)]));
                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([VanillaItems::DIAMOND_AXE(), ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT)], [ItemFactory::getInstance()->get(self::ITEM_NETHERITE_AXE)]));

                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([VanillaItems::DIAMOND_HELMET(), ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT)], [ItemFactory::getInstance()->get(self::NETHERITE_HELMET)]));
                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([VanillaItems::DIAMOND_CHESTPLATE(), ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT)], [ItemFactory::getInstance()->get(self::NETHERITE_CHESTPLATE)]));
                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([VanillaItems::DIAMOND_LEGGINGS(), ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT)], [ItemFactory::getInstance()->get(self::NETHERITE_LEGGINGS)]));
                $this->getServer()->getCraftingManager()->registerShapelessRecipe(new ShapelessRecipe([VanillaItems::DIAMOND_BOOTS(), ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT)], [ItemFactory::getInstance()->get(self::NETHERITE_BOOTS)]));
                break;
            case 'custom':
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            ' A ',
                            ' A ',
                            ' B '
                        ],
                        ['A' => ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT), 'B' => ItemFactory::getInstance()->get(ItemIds::STICK)],
                        [ItemFactory::getInstance()->get(self::ITEM_NETHERITE_SWORD)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            ' A ',
                            ' B ',
                            ' B '
                        ],
                        ['A' => ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT), 'B' => VanillaItems::STICK()],
                        [ItemFactory::getInstance()->get(self::ITEM_NETHERITE_SHOVEL)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            'AAA',
                            ' B ',
                            ' B '
                        ],
                        ['A' => ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT), 'B' => VanillaItems::STICK()],
                        [ItemFactory::getInstance()->get(self::ITEM_NETHERITE_PICKAXE)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            ' AA',
                            ' BA',
                            ' B '
                        ],
                        ['A' => ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT), 'B' => VanillaItems::STICK()],
                        [ItemFactory::getInstance()->get(self::ITEM_NETHERITE_AXE)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            'AA ',
                            'AB ',
                            ' B '
                        ],
                        ['A' => ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT), 'B' => VanillaItems::STICK()],
                        [ItemFactory::getInstance()->get(self::ITEM_NETHERITE_AXE)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            'AA ',
                            ' B ',
                            ' B '
                        ],
                        ['A' => ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT), 'B' => VanillaItems::STICK()],
                        [ItemFactory::getInstance()->get(self::ITEM_NETHERITE_HOE)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            ' AA',
                            ' B ',
                            ' B '
                        ],
                        ['A' => ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT), 'B' => VanillaItems::STICK()],
                        [ItemFactory::getInstance()->get(self::ITEM_NETHERITE_HOE)])
                );

                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            'AAA',
                            'A A',
                            '   '
                        ],
                        ['A' => ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT)],
                        [ItemFactory::getInstance()->get(self::NETHERITE_HELMET)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            'A A',
                            'AAA',
                            'AAA'
                        ],
                        ['A' => ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT)],
                        [ItemFactory::getInstance()->get(self::NETHERITE_CHESTPLATE)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            'AAA',
                            'A A',
                            'A A'
                        ],
                        ['A' => ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT)],
                        [ItemFactory::getInstance()->get(self::NETHERITE_LEGGINGS)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            '   ',
                            'A A',
                            'A A'
                        ],
                        ['A' => ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT)],
                        [ItemFactory::getInstance()->get(self::NETHERITE_BOOTS)])
                );
                $this->getServer()->getCraftingManager()->registerShapedRecipe(new ShapedRecipe(
                        [
                            'A A',
                            'A A',
                            '   '
                        ],
                        ['A' => ItemFactory::getInstance()->get(self::ITEM_NETHERITE_INGOT)],
                        [ItemFactory::getInstance()->get(self::NETHERITE_BOOTS)])
                );
                break;
        }

        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }

}