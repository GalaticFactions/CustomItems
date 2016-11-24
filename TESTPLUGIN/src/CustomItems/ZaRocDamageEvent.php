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
use pocketmine\level\sound\ExplodeSound;
use pocketmine\item\Item;
use pocketmine\Player;

class ZaRocDamageEvent implements Listener{
	public function onEnable(){
		
    }
    
      public function __construct(Loader $plugin){
          $this->plugin = $plugin;
    }
  
    public function onDamage(EntityDamageEvent $e)
    {
        if ($e instanceof EntityDamageByEntityEvent) {
            $damager = $e->getDamager();
            $sword = $damager->getInventory()->getItemInHand();
            $damaged = $e->getEntity();
            $x = $damaged->getX();
            $y = $damaged->getY();
            $z = $damaged->getZ();
            $level = $damager->getLevel();
            if ($sword->getId() === 276 and $sword->getCustomName() === "§eZa Roc\n§rTorture 25 Percent\nExplosive 25 Percent") {
                switch (mt_rand(1, 3)) {
                    case 1:
                        $level->addParticle(new FlameParticle(new Vector3($x, $y + 1, $z)));
                        $level->addSound(new ExplodeSound(new Vector3($x, $y + 1, $z)));
                        $damager->sendMessage(c::RED . "Explosive Hit!");
                        $damaged->setHealth(15);
                    case 2:
                        return;
                    case 3:
                        $damaged->addEffect(Effect::getEffect(20)->setDuration(13 * 20)->setAmplifier(1));
                        $level->addSound(new GhastSound(new Vector3($x, $y + 1, $z)));
                        $damager->sendMessage(c::RED . "You have unleashed the forces of evil upon your enemy");
                }
            }
        }
    }
}
