<?php

/* draws a calendar */
function draw_calendar($month, $year){

	/* draw table */
	$calendar = '<div class="calendar-item">';

	/* table headings */
	$headings = array('S','M','T','W','T','F','S');
	$months = array('January','February','March','April','May','June','July', 'August', 'September', 'October', 'November', 'December');

	/* rows for month heading */
	$calendar .= '<div class="calendar-month">' . $months[$month - 1] . '</div>';
	
	$calendar .= '<div class="calendar-row">
									<span class="calendar-day-head">'.implode('</span><span class="calendar-day-head">',$headings).'</span>
								</div>';

	/* days and weeks vars now ... */
	$running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
	$days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar .= '<div class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar .= '<div class="calendar-day-np"> </div>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar .= '<div class="calendar-day">';
			/* add in the day number */
			$calendar .= '<span class="day-number">'.$list_day.'</span>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			
		$calendar .= '</div>';
		if($running_day == 6):
			$calendar .= '</div>';
			if($day_counter != $days_in_month):
				$calendar.= '<div class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; 
		$running_day++; 
		$day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<span class="calendar-day-np"> </span>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</div>';

	/* end the table */
	$calendar.= '</div>';
	
	/* all done, return result */
	return $calendar;
}