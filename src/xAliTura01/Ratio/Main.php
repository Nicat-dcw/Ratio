<?php

namespace xAliTura01\Ratio;

use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\block\BlockBreakEvent;

use ReflectionClass;
use pocketmine\resourcepacks\ZippedResourcePack;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;

class Main extends PluginBase implements Listener
{
     private $LangConfig = [];
     private static $instance;

     public function onLoad() : void 
     {
    	@mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->saveResource('en_EN.yml');
        $this->saveResource('tr_TR.yml');
        $this->saveResource('config.yml');
        $this->LangConfig = ["en_EN" => new Config($this->getDataFolder() . "en_EN.yml", Config::YAML),
                             "tr_TR" => new Config($this->getDataFolder() . "tr_TR.yml", Config::YAML)
                            ];
	}

	public function onEnable() : void
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

	public function blockBreak(BlockBreakEvent $event)
	{
		$player = $event->getPlayer();
		$name = $player->getName();
		$world = $player->getLevel()->getFolderName();
		if ($world = $name) {
			if ($event->getBlock()->getId() == 4) {
				if ($player->hasPermission("ratio.vip")) {
					$this->ratioVip($event);
				}else{
					$this->ratioPlayer($event);
				}
			}
		}
	}

	public function playMusic(Player $player)
	{
		$packet = new PlaySoundPacket();
		$packet->soundName = "Ratio";
		$packet->x = $player->getX();
		$packet->y = $player->getY();
		$packet->z = $player->getZ();
		$packet->volume = 1;
		$packet->pitch = 1;
		$player->sendDataPacket($packet);
	}

	public function ratioVip($event)
	{
		$player = $event->getPlayer();
		$ratio1 = rand(1,30);
		$ratio2 = rand(1,30);
		$ratio3 = rand(1,35);
		$w = $event->getPlayer()->getLevel()->getFolderName();
		$world = $this->getServer()->getLevelByName($w);
		$x = $event->getBlock()->getX();
		$y = $event->getBlock()->getY();
		$z = $event->getBlock()->getZ();
		switch ($ratio1) {
			case 1:
				$world->setBlock(new Vector3($x,$y,$z), Block::get(16));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["vip-message"]);
			break;
			case 2:
				$world->dropItem(new Vector3($x,$y,$z), Item::get(266));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["vip-message"]);
			break;
			case 3:
				$world->setBlock(new Vector3($x,$y,$z), Block::get(14));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["vip-message"]);
			break;
			case 4:
				$world->dropItem(new Vector3($x,$y,$z), Item::get(370));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["vip-message"]);
			break;
		}
		switch ($ratio2) {
			case 1:
				$world->setBlock(new Vector3($x,$y,$z), Block::get(15));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["vip-message"]);
			break;
			case 2:
				$world->dropItem(new Vector3($x,$y,$z), Item::get(266));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["vip-message"]);
			break;
			case 3:
				$world->setBlock(new Vector3($x,$y,$z), Block::get(129));
				$this->playMusic($player); 
				$player->sendMessage($this->plugin->messages["vip-message"]);
			break;
			case 4:
				$world->dropItem(new Vector3($x,$y,$z), Item::get(265));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["vip-message"]);
			break;
		}
		switch($ratio3){
			case 1:
				$world->setBlock(new Vector3($x,$y,$z), Block::get(56));
				$this->playMusic($player); 
				$player->sendMessage($this->plugin->messages["vip-message"]);
			break;
			case 2:
				$world->dropItem(new Vector3($x,$y,$z), Item::get(264));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["vip-message"]);
			break;
		}
	}

	public function ratioPlayer($event)
	{
		$player = $event->getPlayer();
		$ratio1 = rand(1,90);
		$ratio2 = rand(1,90);
		$ratio3 = rand(1,90);
		$w = $event->getPlayer()->getLevel()->getFolderName();
		$world = $this->getServer()->getLevelByName($w);
		$x = $event->getBlock()->getX();
		$y = $event->getBlock()->getY();
		$z = $event->getBlock()->getZ();
		switch ($ratio1) {
			case 1:
				$world->setBlock(new Vector3($x,$y,$z), Block::get(370));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["player-message"]);
			break;
			case 2:
				$world->dropItem(new Vector3($x,$y,$z), Item::get(265));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["player-message"]);
			break;
			case 3:
				$world->setBlock(new Vector3($x,$y,$z), Block::get(266));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["player-message"]);
			break;
			case 4:
				$world->dropItem(new Vector3($x,$y,$z), Item::get(264));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["player-message"]);
			break;
		}
		switch ($ratio2) {
			case 1:
				$world->setBlock(new Vector3($x,$y,$z), Block::get(370));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["player-message"]);
			break;
			case 2:
				$world->dropItem(new Vector3($x,$y,$z), Item::get(265));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["player-message"]);
			break;
			case 3:
				$world->setBlock(new Vector3($x,$y,$z), Block::get(266));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["player-message"]);
			break;
			case 4:
				$world->dropItem(new Vector3($x,$y,$z), Item::get(266));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["player-message"]);
			break;
		}
		switch ($ratio3) {
			case 1:
				$world->setBlock(new Vector3($x,$y,$z), Block::get(4));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["player-message"]);
			break;
			case 2:
				$world->dropItem(new Vector3($x,$y,$z), Item::get(1));
				$this->playMusic($player);
				$player->sendMessage($this->plugin->messages["player-message"]);
			break;
		}
	}
}