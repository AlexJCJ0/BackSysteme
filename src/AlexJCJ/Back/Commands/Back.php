<?php

namespace AlexJCJ\Back\Commands;

use AlexJCJ\Back\Main;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\level\Position;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\utils\Config;

class Back extends PluginCommand {

    /** @var Main $plugin */
    private $plugin;

    public function __construct(Main $plugin){
        parent::__construct("back", $plugin);
        $this->setDescription("Se teleporter aux coordonnées de la mort précédente");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $player, string $commandLabel, array $args){
        $config = new Config($this->plugin->getDataFolder() . "Backs.yml", Config::YAML);

        if ($player instanceof Player){
            if ($config->exists($player->getName())){
                $pos = explode(" ", $config->get($player->getName()));
                $level = $this->plugin->getServer()->getLevelByName($pos[3]);
                $player->teleport(new Position($pos[0], $pos[1], $pos[2], $level));
                $player->sendMessage("§aVous vous êtes bien teleporté a votre dernier point de mort");
            } else {
                $player->sendMessage("§cVous n'êtes pas mort dans cette session");
            }
        } else {
            $this->plugin->getLogger()->info("Vous ne pouvez pas utliser cette Commande via la Console");
        }
    }
}