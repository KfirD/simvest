<?php

	class DataSource {
		##### DEFINITIONS #####
		private $stockSubsetCount = 3;		# how many stock items are scanned in calculating $newMomentum
		private $dimmer = 0.85;				# how powerful should the momentum, randomness from each tick be?
		private $momentumLimit = 0.5;		# prevents too much momentum
		private $upperPriceCap = 16;		# when people decide to buy or sell. Could also be determined by fuzz, not set.
		private $lowerPriceCap = 4;				# when these are reached, momentum will be violently shoved in opposite direction

		##### DATA STORAGE #####
		var $allData = array();
		var $momemta = array();
		# array of all data for a graph

		function chartData() {
			# returns URL for google charts based on data

			return str_replace("\t", "" , str_replace("\n","","
			http://chart.apis.google.com/chart
			?chxr=0,0,20
			&chxt=y
			&chs=500x300
			&cht=ls
			&chco=3D7930
			&chds=0,20
			&chd=t:" .  implode(",", $this->allData)  . "
			&chg=-1,-1,1,1
			&chls=2,4,0
			&chm=B,C5D4B5BB,0,0,0
			&chtt=simvest"
			));
		}
		
		function chartVolume() {
			# charts stock activity (momentum)
			
			return str_replace("\t", "" , str_replace("\n","","
			http://chart.apis.google.com/chart
			?chxr=0,0,0
			&chxs=0,676767,11.5,0,_,676767
			&chxt=y
			&chbh=a,0,2
			&chs=500x30
			&cht=bvg
			&chco=A2C180
			&chds=0,0.7
			&chd=t:" .  implode(",", $this->momenta)  . ""
			));
		}
		
		##### DATA CREATION #####
		var $momentum = 0;		# momentum = people are more willing to buy or sell if other people seem to be doing it
		
		function newPrice() {
			# creates new stock price (a tick), adds to $allData.
			
			##### MOMENTUM CREATION #####
			if(count($this->allData) >= $this->stockSubsetCount) { # enough stock to properly calculate momentum
				
				$stockSubset = array_slice($this->allData, -3, 3); 				
				$newMomentum = (array_sum($stockSubset))/$this->stockSubsetCount - $stockSubset[0];
				# averages the viciously axe-mutilated subset for the current momentum
				
				$this->momentum = ($this->momentum + $newMomentum)/2;
				# averages with past momentum, porque es momentum
				
				if(abs($this->momentum) >= $this->momentumLimit) {
					$this->momentum /= 2;
				}
				
				array_push($this->momenta, abs($this->momentum)); # add to list of momentum
			
			} else {
				$this->momenta = array();
				array_push($this->momenta, 0); # add to list of momentum
				if(count($this->allData) == 0) {
					array_push($this->allData, 10);
					return;
				} else {
					$randomValue = (lcg_value()*2-1); # lcg_value = float rand between 0 and 1, I make it between -1 and 1
					$price = end($this->allData) + $randomValue;
					array_push($this->allData, $price);
					return;
				}
			}
			
			##### PRICE MAKING #####
			
			//$price = current + random(weighted mom position) + mom;
			$randomValue = (lcg_value()*2-1); #lcg_value = float rand between 0 and 1, I make it between -1 and 1
			
			if(($randomValue > 0) == ($this->momentum > 0)) { # Awesome? Yes.
				$randomValue *= abs($this->momentum);
				# if they are the same, make momentum affect randomness. Abs because multiplication sucks.
			}
			
			$price = end($this->allData) + ($randomValue  + $this->momentum)/$this->dimmer; # factoring in momentum again for extra chaos.
			
			
			if($price >= $this->upperPriceCap) {				# aqui es el violent shoving.
				if($price - $this->upperPriceCap >= 1) {
					$this->momentum = abs($this->momentum) * -5; # really violent if too far above
				} else {
					$this->momentum = abs($this->momentum) * -1;
				}
			} else if($price <= $this->lowerPriceCap) {
				if($this->lowerPriceCap - $price >= 1) {
					$this->momentum = abs($this->momentum) * 5; # really violent if too far below
				} else {
					$this->momentum = abs($this->momentum) * 1;
				}
			}
			
			
			
			# adds new price to $allData array
			array_push($this->allData, $price);
		}
		

	}


	/* SAMPLE USAGE (LIKE WEBSITE):
	$a = new DataSource;
	//$a->allData = array(10, 10.5, 11, 9, 10, 10.5);
	
	for ($i=0; $i < 100; $i++) { 
		$a->newPrice();
	}
	echo "<img src='" . $a->chartData() . "' />";
	echo "<br /><img src='" . $a->chartVolume() . "' />";
	*/
	

?>
