Easy lightweight PMMP api for chests

Import: `use chestapi\ChestAPI;`

Methods:
* `ChestAPI::open(Position $chest, bool $playSound = true)`
* `ChestAPI::close(Position $chest, bool $playSound = true)`

Example: 
```
use pocketmine\level\Position;
use chestapi\ChestAPI;
...
$chest = new Position(100, 100, 100, $player->getLevel());
ChestAPI::open($chest);
```

Download: [Releases](https://github.com/Evelire-Studio/ChestAPI/releases)