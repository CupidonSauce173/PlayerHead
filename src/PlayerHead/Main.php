<?php
namespace PlayerHead;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\item\Item;
use pocketmine\entity\Entity;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener{
	
	public $prefix = "";
    
    public function onEnable(){
		
		$this->getLogger()->info(TextFormat::GREEN . "[PlayerHead]" . TextFormat::AQUA . " PCFly has been enabled!");
		$this->getLogger()->info(TextFormat::GREEN . "[PlayerHead]" . TextFormat::AQUA . " made by CupidonSauce173");
		
		$prefix = new Config($this->getDataFolder() . "prefix.yml" , Config::YAML);
		if (empty($prefix->get("Prefix"))) {
			$prefix->set("Prefix" , "ยง7");
		}
		$prefix->save();
		$this->saveResource("config.yml");
		@mkdir($this->getDataFolder());
		$this->prefix = $prefix->get("Prefix");
		$this->getServer()->getPluginManager()->registerEvents($this , $this);
    }
	
    public function onDeath(PlayerDeathEvent $event){
		$prefix = new Config($this->getDataFolder() . "prefix.yml" , Config::YAML);
		$PlayerName = $event->getPlayer()->getName();
        $event->setDrops(array(Item::get(Item::SKULL, 0, 1)->setCustomName($this->prefix . $PlayerName)));
        }

    public function onDisable(){

    }
}
