<?php

namespace FiraAja\Broadcaster;

use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;

class Main extends PluginBase
{
    private bool $displayOn = true;

    protected function onEnable(): void
    {
        $this->saveDefaultConfig();
        $this->displayOn = $this->getConfig()->get("display_on_the_console");
        $this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function (): void {
            $this->broadcast($this->displayOn ?: false);
        }), 20 * $this->getConfig()->get("message_interval"));
    }

    protected function broadcast(bool $displayOn = true): void {
        $messages = $this->getConfig()->getAll()["messages"];
        $message = $messages[array_rand($messages)];
        $message = str_replace(array(
            "&",
            "{line}",
            "{max_players}",
            "{online_players}"
        ), array(
            "§",
            "\n",
            $this->getServer()->getMaxPlayers(),
            count($this->getServer()->getOnlinePlayers())
        ), $message);
        $prefix = str_replace("&", "§", $this->getConfig()->get("prefix"));
        $message = $prefix . $message;

        if ($displayOn) {
            $this->getServer()->broadcastMessage($message);
        } else {
            foreach ($this->getServer()->getOnlinePlayers() as $player) {
                $player->sendMessage($message);
            }
        }
        $this->broadcastSound($this->getConfig()->get("broadcast_sound"));
    }

    protected function broadcastSound(string $soundName): void {
//        if ($this->getConfig()->get("broadcast_sound") !== "") {
            foreach ($this->getServer()->getOnlinePlayers() as $player) {
                $player->getNetworkSession()->sendDataPacket(PlaySoundPacket::create(
                    $soundName,
                    $player->getPosition()->getX(),
                    $player->getPosition()->getY(),
                    $player->getPosition()->getZ(),
                    100,
                    1
                ));
            }
//        }
    }
}