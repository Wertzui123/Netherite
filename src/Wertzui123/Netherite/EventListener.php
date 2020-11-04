<?php

namespace Wertzui123\Netherite;

use pocketmine\entity\object\ItemEntity;
use pocketmine\event\entity\EntityDamageByBlockEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\Player;
use Wertzui123\Netherite\item\armor\NetheriteBoots;
use Wertzui123\Netherite\item\armor\NetheriteChestplate;
use Wertzui123\Netherite\item\armor\NetheriteHelmet;
use Wertzui123\Netherite\item\armor\NetheriteLeggings;

class EventListener implements Listener
{

    public function onItemBurn(EntityDamageByBlockEvent $event)
    {
        if (!$event->isCancelled() && $event->getEntity() instanceof ItemEntity && ($event->getCause() === EntityDamageByBlockEvent::CAUSE_FIRE || $event->getCause() === EntityDamageByBlockEvent::CAUSE_LAVA)) {
            /** @var ItemEntity $item */
            $item = $event->getEntity();
            switch ($item->getItem()->getId()) {
                case Main::ITEM_NETHERITE_INGOT:
                case Main::ITEM_NETHERITE_SWORD:
                case Main::ITEM_NETHERITE_SHOVEL:
                case Main::ITEM_NETHERITE_PICKAXE:
                case Main::ITEM_NETHERITE_AXE:
                case Main::ITEM_NETHERITE_HOE:
                case NetheriteHelmet::NETHERITE_HELMET:
                case NetheriteChestplate::NETHERITE_CHESTPLATE:
                case NetheriteLeggings::NETHERITE_LEGGINGS:
                case NetheriteBoots::NETHERITE_BOOTS:
                    $event->setCancelled();
            }
        }
    }

    /**
     * @priority HIGH
     * @param EntityDamageByEntityEvent $event
     */
    public function onKnockback(EntityDamageByEntityEvent $event)
    {
        if (!$event->getEntity() instanceof Player) return;
        $modifier = 0;
        if ($event->getEntity()->getArmorInventory()->getHelmet() instanceof NetheriteHelmet) {
            $modifier += 1;
        }
        if ($event->getEntity()->getArmorInventory()->getChestplate() instanceof NetheriteChestplate) {
            $modifier += 1;
        }
        if ($event->getEntity()->getArmorInventory()->getLeggings() instanceof NetheriteLeggings) {
            $modifier += 1;
        }
        if ($event->getEntity()->getArmorInventory()->getBoots() instanceof NetheriteBoots) {
            $modifier += 1;
        }
        if ($modifier > 0) {
            $event->setKnockback($event->getKnockback() - $event->getKnockBack() * ($modifier / 10));
        }
    }

}