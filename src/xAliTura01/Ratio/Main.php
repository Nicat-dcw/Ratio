<?php

namespace xAliTura01\Ratio;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\math\Vector3;

class Main extends PluginBase implements Listener {
    	public function onEnable(){
    	        $this->getServer()->getPluginManager()->registerEvents($this,$this);
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
			break;
			case 2:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(266));			
			break;
			case 3:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(14));			
			break;
			case 4:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(370));				
			break;
		}
	    switch($ratio2){
			case 1:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(15));
			break;
			case 2:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(266));						
			break;
			case 3:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(129));			
			break;
			case 4:			
            $world->dropItem(new Vector3($x,$y,$z), Item::get(265));			
			break;
	    }
	    switch($ratio3){
			case 1:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(56));
			break;
			case 2:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(264));						
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
			break;
			case 2:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(265));			
			break;
			case 3:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(266));			
			break;
			case 4:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(264));				
			break;
		}
	    switch($ratio2){
			case 1:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(370));
			break;
			case 2:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(265));						
			break;
			case 3:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(266));			
			break;
			case 4:			
            $world->dropItem(new Vector3($x,$y,$z), Item::get(266));			
			break;
	    }
	    switch($ratio3){
			case 1:
			$world->setBlock(new Vector3($x,$y,$z), Block::get(4));
			break;
			case 2:
            $world->dropItem(new Vector3($x,$y,$z), Item::get(1));						
			break;
	    }	
	}
}