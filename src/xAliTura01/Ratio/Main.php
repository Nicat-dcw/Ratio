<?php

namespace xAliTura01\Ratio;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use ReflectionClass;
use pocketmine\resourcepacks\ZippedResourcePack;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;

class Main extends PluginBase implements Listener {
    	public function onEnable()
    	{
    	        $this->getServer()->getPluginManager()->registerEvents($this, $this);

		$this->saveResource("Ratio.mcpack", true);

		$manager = $this->getServer()->getResourcePackManager();
		$pack = new ZippedResourcePack($this->getDataFolder() . "Ratio.mcpack");

		$reflection = new ReflectionClass($manager);

		$property = $reflection->getProperty("resourcePacks");
		$property->setAccessible(true);

		$currentResourcePacks = $property->getValue($manager);
		$currentResourcePacks[] = $pack;
		$property->setValue($manager, $currentResourcePacks);

		$property = $reflection->getProperty("uuidList");
		$property->setAccessible(true);
		$currentUUIDPacks = $property->getValue($manager);
		$currentUUIDPacks[strtolower($pack->getPackId())] = $pack;
		$property->setValue($manager, $currentUUIDPacks);

		$property = $reflection->getProperty("serverForceResources");
		$property->setAccessible(true);
		$property->setValue($manager, true);
    	}
	public function blockBreak(BlockBreakEvent $k){
	$o = $k->getPlayer();
	$world = $o->getLevel()->getFolderName();
	$name = $o->getName();
	if($world = $name){
	if($k->getBlock()->getId() == 4){
		if($o->hasPermission("ratio.vip")){
			$this->ratioVip($k);		
		}else{
			$this->ratioPlayer($k);
		}
	}
	}
	}
	public function music($k){
	    $player = $event->getPlayer();
		$packet = new PlaySoundPacket();
		$packet->soundName = "Ratio";
		$packet->x = $player->getX();
		$packet->y = $player->getY();
		$packet->z = $player->getZ();
		$packet->volume = 1;
		$packet->pitch = 1;
		$player->sendDataPacket($packet);
	}
	public function ratioVip($k){
		$ratio1 = rand(1,30);
		$ratio2 = rand(1,30);
		$ratio3 = rand(1,35);
		$w = $k->getPlayer()->getLevel()->getFolderName();
		$world = $this->getServer()->getLevelByName($w);
		$x = $k->getBlock()->getX();
		$y = $k->getBlock()->getY();
		$z = $k->getBlock()->getZ();
       	switch($ratio1){
			case 1:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(16));
			music();
			break;
			case 2:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(266));	
            music();
			break;
			case 3:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(14));	
			music();
			break;
			case 4:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(370));	
            music();
			break;
		}
	    switch($ratio2){
			case 1:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(15));
			music();
			break;
			case 2:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(266));
            music();
			break;
			case 3:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(129));	
			music();
			break;
			case 4:			
            $world->dropItem(new Vector3($x,$y,$z), Item::get(265));
            music();
			break;
	    }
	    switch($ratio3){
			case 1:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(56));
			music();
			break;
			case 2:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(264));
            music();
			break;
	    }
	}
	public function ratioPlayer($k){
		$ratio1 = rand(1,90);
		$ratio2 = rand(1,90);
		$ratio3 = rand(1,90);
		$w = $k->getPlayer()->getLevel()->getFolderName();
		$world = $this->getServer()->getLevelByName($w);
		$x = $k->getBlock()->getX();
		$y = $k->getBlock()->getY();
		$z = $k->getBlock()->getZ();
       	switch($ratio1){
			case 1:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(370));
			music();
			break;
			case 2:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(265));	
            music();
			break;
			case 3:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(266));	
			music();
			break;
			case 4:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(264));	
            music();
			break;
		}
	    switch($ratio2){
			case 1:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(370));
			music();
			break;
			case 2:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(265));
            music();
			break;
			case 3:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(266));		
			music();
			break;
			case 4:			
            $world->dropItem(new Vector3($x,$y,$z), Item::get(266));			
            music();
			break;
	    }
	    switch($ratio3){
			case 1:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(4));
			music();
			break;
			case 2:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(1));		
            music();
			break;
	    }	
	}
}