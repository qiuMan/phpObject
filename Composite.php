<?php


abstract class Unit {
    abstract public function strength();
}

class Archer extends Unit {
    public function strength()
    {
        return 4;    
    }
}

class Cavalry extends Unit {
    public function strength()
    {
        return 5;
    }
}

class Infantry extends Unit {
    public function strength()
    {
        return 1;
    }
}

abstract class CompositeUnit extends Unit {
    protected $units = [];       

    public function addUnit(Unit $unit) 
    {
        $this->units[] = $unit;
    }
    
    public function removeUnit(Unit $unit) 
    {
        $this->units = array_filter($this->units, function($thisUnit) use ($unit) {
             return $thisUnit !== $unit;
        });
    }
  
}

//可以合并军队
class Army extends CompositeUnit {
    private $armys = []; 

    public function addArmy(Army $army) 
    {
        $this->armys[] = $army;
    }

    public function removeArmy(Army $army) 
    {
        $this->units = array_filter($this->armys, function($this_army) use ($army) {
             return $this_army !== $army;
        });
    }

    public function strength() 
    {
        $combatPower = 0;
        foreach ($this->units as $unit) {
            $combatPower += $unit->strength();
        }
        //合并军队里的力量
        foreach ($this->armys as $army) {
            $combatPower += $army->strength();
        }
        return $combatPower;
    }
}

//某些军队不能优骑兵
class TroopCarrier extends CompositeUnit {
    public function addUnit(Unit $unit) 
    {
        if ($unit instanceof Cavalry) {
            throw new \Exception("Can't get a horse on the vehicle");
        }
        parent::addUnit($unit);
    }

    public function strength() 
    {
        $combatPower = 40;
        foreach ($this->units as $unit) {
            $combatPower += $unit->strength();
        }
        return $combatPower;
    }
}


$main_army = new Army();
$archer = new Archer();
$cavalry = new Cavalry();
$main_army->addUnit($archer);
$main_army->addUnit($cavalry);
echo $main_army->strength() . "\n";

$sub_army = new Army();
$infantry = new Infantry();
$sub_army->addUnit($infantry);
$sub_army->addUnit($archer);

$main_army->addArmy($sub_army);
echo $main_army->strength() . "\n";

$troop_carrier = new TroopCarrier();
$troop_carrier->addUnit($archer);
// $troop_carrier->addUnit($cavalry);
echo $troop_carrier->strength() . "\n";


?>