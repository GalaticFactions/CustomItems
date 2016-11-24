<?php

namespace CustomItems;

use pocketmine\event\Listener;
use pocketmine\event\entity\{EntityArmorChangeEvent, EntityDamageByEntityEvent, EntityDamageEvent};
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\utils\TextFormat as c;
use pocketmine\level\sound\GhastSound;
use pocketmine\level\Level;
use pocketmine\level\sound;
use pocketmine\math\Vector3;
use pocketmine\level\Position;
use pocketmine\Server;
use pocketmine\entity\Effect;
use pocketmine\level\particle\FlameParticle;
use pocketmine\level\sound\BlazeShootSound;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\Config;

class WizardsStaff implements Listener{
	public function onEnable(){
		
    }
    
      public function __construct(Loader $plugin){
          $this->plugin = $plugin;
    }
  
    public function onDamage(EntityDamageEvent $e) {
    	if ($e instanceof EntityDamageByEntityEvent) {
    		$damager = $e->getDamager();
    		$staff = $damager->getInventory()->getItemInHand();
    		$damaged = $e->getEntity();
    	    $x = $damaged->getX();
		    $y = $damaged->getY();
		    $z = $damaged->getZ();
            $level = $damager->getLevel();
            $seconds = 5;
    		if($staff->getId() === 280 and $staff->getCustomName() === "§4Wizard's Staff\n§rIgnites Enemies\nOn Fire"){{
                $level->addParticle(new FlameParticle(new Vector3($x, $y + 1, $z)));
                $level->addSound(new BlazeShootSound(new Vector3($x, $y + 1, $z)));
                $damager->sendMessage(c::RED . "Your enemy shall burn!");
                $damaged->setOnFire(5);
        	}
        }
    }
}
}
