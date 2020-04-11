<?php

declare(strict_types=1);

/**
 *
 *     ______           ___              _____ __            ___
 *    / ____/   _____  / (_)_______     / ___// /___  ______/ (_)___
 *   / __/ | | / / _ \/ / / ___/ _ \    \__ \/ __/ / / / __  / / __ \
 *  / /___ | |/ /  __/ / / /  /  __/   ___/ / /_/ /_/ / /_/ / / /_/ /
 * /_____/ |___/\___/_/_/_/   \___/   /____/\__/\__,_/\__,_/_/\____/
 *
 * Made by Evelire Studio
 * VK: https://vk.com/evelirestudio
 * GitHub: https://github.com/Evelire-Studio
 */

namespace chestapi;

use pocketmine\level\Position;
use pocketmine\network\mcpe\protocol\BlockEventPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\plugin\PluginBase;

class ChestAPI extends PluginBase{
    public static function open(Position $chest, bool $playSound = true){
        self::sendBlockEvent($chest, true, $playSound);
    }

    public static function close(Position $chest, bool $playSound = true){
        self::sendBlockEvent($chest, false, $playSound);
    }

    protected static function sendBlockEvent(Position $chest, bool $isOpen, bool $playSound){
        $pk = new BlockEventPacket();
        $pk->x = (int) $chest->getX();
        $pk->y = (int) $chest->getY();
        $pk->z = (int) $chest->getZ();
        $pk->eventType = 1;
        $pk->eventData = $isOpen ? 1 : 0;
        $chest->getLevel()->broadcastPacketToViewers($chest, $pk);

        if($playSound){
            $sound = $isOpen ? LevelSoundEventPacket::SOUND_CHEST_OPEN : LevelSoundEventPacket::SOUND_CHEST_CLOSED;
            $chest->getLevel()->broadcastLevelSoundEvent($chest->add(0.5, 0.5, 0.5), $sound);
        }
    }
}