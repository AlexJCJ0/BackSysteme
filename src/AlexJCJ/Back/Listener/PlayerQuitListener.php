<?php

namespace AlexJCJ\Back\Listener;

use AlexJCJ\Back\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\utils\Config;

class PlayerQuitListener implements Listener {

    /** @var Main $plugin */
    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function playerQuit(PlayerQuitEvent $ev){
        $player = $ev->getPlayer();
        $config = new Config($this->plugin->getDataFolder() . "Backs.yml", Config::YAML);

        if ($config->exists($player->getName())){
            $config->remove($player->getName());
            $config->save();
        }
    }
}