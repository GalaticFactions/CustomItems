<?php

namespace CustomItems;

use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\command\CommandExecutor;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use CustomItems\Loader;
use pocketmine\utils\TextFormat as TF;
use pocketmine\level\Sound;
use pocketmine\math\Vector3;
use pocketmine\level\sound\ExplodeSound;
use pocketmine\level\sound\BlazeShootSound;
use pocketmine\item\Item;
use pocketmine\level\Position;
use pocketmine\Server;
class Commands extends PluginBase implements Listener{
    
      public function __construct(Loader $plugin){
          $this->plugin = $plugin;
    }
    public function onCommand(CommandSender $sender,Command $cmd,$label,array $args){ 
    	if($cmd->getName() == "test"){
    		$sender->sendMessage("§7---[§6GalaticItems§7]---\n§r§2Orb Of Magic - Grants Random Spells In Battle - Not Buyable\n§r§2Za Roc - Has A 25% Chance To Posion Or Take Hearts From Your Enemy! - /buy_ZaRoc\n§4r§2Wizards Staff - Ignites Enemies On Fire - Not Buyable");
    	}

    	if($cmd->getName() == "buy_zaroc"){
    		$geteconomy = $this->plugin->getServer()->getPluginManager()->getPlugin("EconomyAPI");
    		$dsword = Item::get(Item::DIAMOND_SWORD, 0, 1);
    		$zaroc = $dsword->setCustomName("§eZa Roc\n§rTorture 25 Percent\nExplosive 25 Percent");
    		$x = $sender->getX();
		    $y = $sender->getY();
		    $z = $sender->getZ();
		    $level = $sender->getLevel();
    		if($geteconomy->myMoney($sender) < 2500){
    			$sender->sendMessage(TF::RED . "You do not have $2500");
    			$level->addSound(new ExplodeSound(new Vector3($x, $y + 1, $z)));
    		}else{
    			$geteconomy->reduceMoney($sender->getName(), 2500);
                $sender->getInventory()->addItem($dsword);
                $sender->sendMessage(TF::GREEN . "Za Roc Has Been Bought!");
                $dsword->setCustomName($zaroc);
                $level->addSound(new AnvilUseSound(new Vector3($x, $y + 1, $z)));
    		}

    	}
    	if($cmd->getName() == "buy_wizards_staff"){
    		$geteconomy = $this->plugin->getServer()->getPluginManager()->getPlugin("EconomyAPI");
    		$staff = Item::get(Item::STICK, 0, 1);
    		$staffname = $staff->setCustomName("§4Wizard's Staff\n§rIgnites Enemies\nOn Fire");
    		$x = $sender->getX();
		    $y = $sender->getY();
		    $z = $sender->getZ();
		    $level = $sender->getLevel();
    		if($geteconomy->myMoney($sender) < 0){
    			$sender->sendMessage(TF::RED . "You do not have $2500");
    			$level->addSound(new ExplodeSound(new Vector3($x, $y + 1, $z)));
    		}else{
    			$geteconomy->reduceMoney($sender->getName(), 0);
                $sender->getInventory()->addItem($staff);
                $sender->sendMessage(TF::GREEN . "Wizards Staff Has Been Bought Has Been Bought!");
                $staff->setCustomName($staffname);
                $level->addSound(new BlazeShootSound(new Vector3($x, $y + 1, $z)));
    		}
    	}
    }
}