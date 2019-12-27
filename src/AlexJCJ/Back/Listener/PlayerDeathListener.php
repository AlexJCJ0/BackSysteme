<?php

namespace AlexJCJ\Back\Listener;

use AlexJCJ\Back\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\utils\Config;

class PlayerDeathListener implements Listener {

    /** @var Main $plugin */
    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function playerDeath(PlayerDeathEvent $ev){
        $player = $ev->getPlayer();
        $config = new Config($this->plugin->getDataFolder() . "Backs.yml", Config::YAML);

        $config->set($player->getName(), "{$player->getX()}_{$player->getY()}_{$player->getZ()}_{$player->getLevel()->getName()}");
        $config->save();
    }
}
