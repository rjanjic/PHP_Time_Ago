<?php

include "TimeAgo.class.php";

// Now
echo TimeAgo::ago('2012-11-07 11:14:30', '2012-11-07 11:14:30'), '<br>';

// Second
echo TimeAgo::ago('2012-11-07 11:14:29', '2012-11-07 11:14:30'), '<br>';

// Seconds
echo TimeAgo::ago('2012-11-07 11:14:20', '2012-11-07 11:14:30'), '<br>';

// Minute
echo TimeAgo::ago('2012-11-07 11:13:30', '2012-11-07 11:14:30'), '<br>';

// Minutes
echo TimeAgo::ago('2012-11-07 11:11:30', '2012-11-07 11:14:30'), '<br>';

// Hour 
echo TimeAgo::ago('2012-11-07 10:11:30', '2012-11-07 11:14:30'), '<br>';

// Hours
echo TimeAgo::ago('2012-11-07 6:11:30', '2012-11-07 11:14:30'), '<br>';

// Yesterday
echo TimeAgo::ago('2012-11-06 6:11:30', '2012-11-07 11:14:30'), '<br>';

// On week day
echo TimeAgo::ago('2012-11-04 6:11:30', '2012-11-07 11:14:30'), '<br>';

// Week
echo TimeAgo::ago('2012-10-31 6:11:30', '2012-11-07 11:14:30'), '<br>';

// Weeks
echo TimeAgo::ago('2012-10-24 6:11:30', '2012-11-07 11:14:30'), '<br>';

// Month 
echo TimeAgo::ago('2012-10-6 6:11:30', '2012-11-07 11:14:30'), '<br>';

// Months 
echo TimeAgo::ago('2012-04-6 6:11:30', '2012-11-07 11:14:30'), '<br>';

// Year  
echo TimeAgo::ago('2011-04-6 6:11:30', '2012-11-07 11:14:30'), '<br>';

// Years   
echo TimeAgo::ago('2008-04-6 6:11:30', '2012-11-07 11:14:30'), '<br>';

// From now
echo "I was born ", TimeAgo::ago('1988-04-26'), ".";
