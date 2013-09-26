<?php
/******************************************************************
Projectname:   PHP Time Ago Class
Version:       1.0
Author:        Radovan Janjic <rade@it-radionica.com>
Last modified: 07 11 2012
Copyright (C): 2012 IT-radionica.com, All Rights Reserved

* GNU General Public License (Version 2, June 1991)
*
* This program is free software; you can redistribute
* it and/or modify it under the terms of the GNU
* General Public License as published by the Free
* Software Foundation; either version 2 of the License,
* or (at your option) any later version.
*
* This program is distributed in the hope that it will
* be useful, but WITHOUT ANY WARRANTY; without even the
* implied warranty of MERCHANTABILITY or FITNESS FOR A
* PARTICULAR PURPOSE. See the GNU General Public License
* for more details.

Description:

PHP Time Ago Class

This class can compute the difference between two time values.
It compares two timestamp values and returns an English string that 
expresses the difference between the time values in years, months, 
weeks, days, hours, minutes or seconds.

If the second timestamp value is omitted, the class returns the time 
difference relatively to the current time.

For example:

 - now
 - a secund ago
 - 10 secunds ago
 - a minute ago
 - 3 minutes ago
 - about an hour ago
 - 5 hours ago
 - yesterday
 - on Sunday
 - week ago
 - 2 weeks ago
 - a month ago
 - 7 months ago
 - a year ago
 - 4 years ago

Example:

******************************************************************

$a = new time_ago;

echo "I was born ", $a->ago('1988-04-26'), ".<br>";
echo $a->ago('2012-11-07 11:13:30', '2012-11-07 11:14:30');
******************************************************************/

class time_ago {
	
	/** Secunds in minute
	 * @var	Integer 
	 */
	var $m = 60;
	
	/** Secunds in hour
	 * @var	Integer 
	 */
	var $h = 3600;
	
	/** Secunds in day
	 * @var	Integer 
	 */
	var $d = 86400;
	
	/** Secunds in week
	 * @var	Integer 
	 */
	var $w = 604800;
	
	/** Secunds in mounth
	 * @var	Integer 
	 */
	var $mo = 2629800;
	
	/** Secunds in year
	 * @var	Integer 
	 */
	var $y = 31557600;
	
	/** Tamplates for language expressions stored in array
	 * @var Array 
	 */
	var $string = array(
		  "now" 		=> "now",
		  "secund" 		=> "a secund ago",
		  "secunds" 	=> "%d secunds ago",
		  "minute" 		=> "a minute ago",
		  "minutes" 	=> "%d minutes ago",
		  "hour" 		=> "about an hour ago",
		  "hours" 		=> "%d hours ago",
		  "yesterday" 	=> "yesterday",
		  "days" 		=> "%d days ago",
		  "on" 			=> "on %s",
		  "week" 		=> "week ago",
		  "weeks" 		=> "%d weeks ago",
		  "month" 		=> "a month ago",
		  "months" 		=> "%d months ago",
		  "year" 		=> "a year ago",
		  "years" 		=> "%d years ago"
	);
						
	/** String days of week stored in array (0 is Sunday, 6 is Saturday)
	 *  @var Array 
	 */
	var $weekDays = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	
	/** Function to calcuate elapsed time (Check link for valid formats)
	 * @param 	String 	$time			- Time
	 * @param 	String 	$calculateFrom 	- Start time difference calculation from 
	 * @return 	String 	- Language expression of time difference
	 * @link	http://www.php.net/manual/en/datetime.formats.php
	 */
	function ago($time, $calculateFrom = 'now') {
	
		// Calculate to
		$t = strtotime($time);
		// Calculate from
		$c = strtotime($calculateFrom);
		// Elapsed
		$e = $c - $t;
		// Elapsed that day
		$de = date("H", $c) * $this->h + date("i", $c) * $this->m + date("s", $c);
		
		if ($e < $this->m) {
			// Now / Secund / Secunds
			return ($e == 0) ? $this->string['now'] : ($e == 1 ? $this->string['secund'] : sprintf($this->string['secunds'], $e));			
		} elseif ($e < $this->h) { 
			// Minutes
			return (($m = intval($e / $this->m)) && $m == 1) ? $this->string['minute'] : sprintf($this->string['minutes'], $m);
		} elseif ($e < $this->d) { 
			// Today - Hours
			return (($h = intval($e / $this->h)) && $h == 1) ? $this->string['hour'] : sprintf($this->string['hours'], $h);
		} elseif ($e <= $this->d + $de) { 
			// Yesterday
			return $this->string['yesterday'];
		} elseif ($e < $this->d * 6 + $de) { 
			// Last week
			return sprintf($this->string['on'], $this->weekDays[date( "w", $t)]);
		} elseif ($e < $this->mo) {  // less then month
			// Weeks
			if ($e < $this->w * 2) {
				// Last seven days
				return $this->string['week'];
			} elseif ($e < $this->w * 3) {
				// 2 weeks
				return sprintf($this->string['weeks'], 2);
			} else {
				// 3 weeks
				return sprintf($this->string['weeks'], 3);
			}
		} elseif ($e < $this->y) { // less then year
			// Month / Months
			return ($e < $this->mo * 2) ? $this->string['month'] : sprintf($this->string['months'], intval($e / $this->mo));
		} else {
			// Year / Years
			return ($e >= $this->y && $e < $this->y * 2) ? $this->string['year'] : sprintf($this->string['years'], intval($e / $this->y));			
		}
	}
}
