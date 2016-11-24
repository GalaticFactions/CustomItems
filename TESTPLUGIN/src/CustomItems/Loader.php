<?php

namespace CustomItems;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use CustomItems\Commands;
use pocketmine\event\entity\EntitySpawnEvent;
use pocketmine\command\CommandExecutor;
use pocketmine\utils\Config;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
class Loader extends PluginBase implements Listener,CommandExecutor{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getPluginManager()->registerEvents(new ZaRocDamageEvent($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new Commands($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new WizardsStaff($this), $this);
        $this->getCommand("test")->setExecutor(new Commands($this));
        $this->getCommand("buy_zaroc")->setExecutor(new Commands($this));
        $this->getCommand("buy_wizards_staff")->setExecutor(new Commands($this));
        $this->getLogger()->info(TextFormat::GREEN."CustomItemsRewrite Enabled!");
        ##if (!is_dir($this->getDataFolder())) mkdir($this->getDataFolder());
        ##$defaults = [ TO 
           ## "" => 5, COME 
        ##]; VERY SOON!
        ##$this->cf = (new Config($this->getDataFolder()."config.yml",
                                 ##Config::YAML,$defaults))->getAll();
    }
  
    public function onDisable(){
        $this->getLogger()->info(TextFormat::RED."CustomItemsRewrite Disabled!");
    }
}