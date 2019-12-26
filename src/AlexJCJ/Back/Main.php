<?php

namespace AlexJCJ\Back;

use AlexJCJ\Back\Commands\Back;
use AlexJCJ\Back\Listener\PlayerDeathListener;
use AlexJCJ\Back\Listener\PlayerQuitListener;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;

class Main extends PluginBase implements Listener {

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info(TF::BLUE . "BackSysteme by AlexJCJ");
        $this->getServer()->getPluginManager()->registerEvents(new PlayerDeathListener($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerQuitListener($this), $this);
        $this->getServer()->getCommandMap()->register("back", new Back($this));
    }
}