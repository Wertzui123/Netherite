<?php

namespace Wertzui123\Netherite;

use pocketmine\entity\object\ItemEntity;
use pocketmine\event\entity\EntityDamageByBlockEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;

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
                case Main::NETHERITE_HELMET:
                case Main::NETHERITE_CHESTPLATE:
                case Main::NETHERITE_LEGGINGS:
                case Main::NETHERITE_BOOTS:
                    $event->cancel();
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
        if ($event->getEntity()->getArmorInventory()->getHelmet()->getId() === Main::NETHERITE_HELMET) {
            $modifier += 1;
        }
        if ($event->getEntity()->getArmorInventory()->getChestplate()->getId() === Main::NETHERITE_CHESTPLATE) {
            $modifier += 1;
        }
        if ($event->getEntity()->getArmorInventory()->getLeggings()->getId() === Main::NETHERITE_LEGGINGS) {
            $modifier += 1;
        }
        if ($event->getEntity()->getArmorInventory()->getBoots()->getId() === Main::NETHERITE_BOOTS) {
            $modifier += 1;
        }
        if ($modifier > 0) {
            $event->setKnockback($event->getKnockback() - $event->getKnockBack() * ($modifier / 10));
        }
    }

}