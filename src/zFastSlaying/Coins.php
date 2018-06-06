<?php

namespace zFastSlaying;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\Task;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as Color;
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\inventory\BaseInventory;
use pocketmine\inventory\PlayerInventory;
use pocketmine\Server;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\inventory\InventoryCloseEvent;
use pocketmine\event\inventory\InventoryPickupItemEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\inventory\ChestInventory;
use pocketmine\nbt\NBT;
use pocketmine\nbt\tag\ByteTag;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\IntTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\nbt\tag\ShortTag;
use pocketmine\nbt\tag\StringTag;
use pocketmine\tile\Chest;
use pocketmine\tile\Sign;
use pocketmine\tile\Tile;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\level\Level;
use pocketmine\item\Item;
use pocketmine\entity\Entity;
use pocketmine\entity\Effect;
use pocketmine\block\Block;
use pocketmine\level\Position;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\level\sound\BlazeShootSound;
use pocketmine\level\sound\ClickSound;
use pocketmine\level\sound\PopSound;
use pocketmine\level\particle\Particle;
use pocketmine\level\particle\PortalParticle;
use pocketmine\level\particle\AngryVillagerParticle;
use pocketmine\level\particle\LavaParticle;
use pocketmine\level\particle\HeartParticle;
use pocketmine\level\particle\RedstoneParticle;
use pocketmine\level\particle\SmokeParticle;
use pocketmine\level\particle\FlameParticle;
use pocketmine\level\particle\BubbleParticle;

class Coins extends PluginBase implements Listener {
	
	public $prefix = Color::WHITE . "[" . Color::GREEN . "Coins" . Color::WHITE . "] ";
	
	public function onEnable() {
		
		$this->getLogger()->info($this->prefix . Color::GREEN . "wurde aktiviert!");
        $this->getLogger()->info($this->prefix . Color::AQUA . "Made By" . Color::DARK_PURPLE . " zFastSlaying");
		$this->getPluginManager()->registerEvents($this, $this);
		
    }
    
    public function onLogin(PlayerLoginEvent $event) {
    	
    	$player = $event->getPlayer();
        $uuid = $player->getClientID();
        if (!is_file("/home/Lobby/eCoins/" . $player->getName() . ".yml")) {
        	
        	$playerfile = new Config("/home/Lobby/eCoins/" . $player->getName() . ".yml", Config::YAML);
            $playerfile->set("coins", 2500);
            $playerfile->save();
            
        }
        
    }
    
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
    	
    	if ($command->getName() === "Coins") {
        	
        	$playerfile = new Config("/home/Lobby/eCoins/" . $sender->getName() . ".yml", Config::YAML);                  
            $sender->sendMessage($this->prefix . "Du hast ".Color::GOLD . $playerfile->get("coins") . Color::WHITE . " Coins!");
        	       	
        } else if ($command->getName() === "AddCoins") {
        	
        	if ($sender->isOp()) {
        	
        	if (isset($args[0])) {

                    $playerfile = new Config("/home/Lobby/eCoins/" . $args[0] . ".yml", Config::YAML);
                    $playerfile->set("coins", $playerfile->get("coins") + 10000);
                    $playerfile->save();
                    $sender->sendMessage(Color::GREEN . "10000 Coins gegeben!");
                               
                }         
    			
    		} else {
    			
    			$sender->sendMessage(Color::RED . "Du hast keine Rechte auf diesen Befehl!");
    			
    		}
        	       	
        }
        
        return true;
        
    }
	
}
