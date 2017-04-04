<?php

/* draws a calendar */
function draw_calendar($month, $year, $pdf_date_month = 13, $pdf_date_day = 32){

	/* draw table */
	$calendar = '<div class="calendar-item" style="display: inline-block; vertical-align: top; width: 164px; padding: 5px; box-sizing: border-box;">';

	/* table headings */
	$headings = array('S','M','T','W','T','F','S');
	$months = array('January','February','March','April','May','June','July', 'August', 'September', 'October', 'November', 'December');

	/* rows for month heading */
	$calendar .= '<div class="calendar-month" style="display: block; font-size: 18px; font-weight: bold; border-bottom: 1px solid black; text-transform: uppercase; text-align: center; margin-bottom: 10px;">' . $months[$month - 1] . '</div>';

	$calendar .= '<div class="calendar-row" style="display: block; padding-left: 5px; text-align: center;">
									<span class="calendar-day-head" style="display: inline-block; text-align: center; width: 22px; font-weight: bold; font-size: 12px;">'.implode('</span><span class="calendar-day-head" style="display: inline-block; text-align: center; width: 22px; font-weight: bold; font-size: 12px;">',$headings).'</span>
								</div>';

	/* days and weeks vars now ... */
	$running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
	$days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar .= '<div class="calendar-row" style="display: block; padding-left: 5px; text-align: center;">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar .= '<div class="calendar-day-np" style="display: inline-block; width: 22px; text-align: center;"> </div>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		if($month >= $pdf_date_month && ($list_day == $pdf_date_day || ($pdf_date_day == 31 && $list_day == 30))) {
			$calendar .= '<div class="calendar-day day-' . $month . '-' . $list_day . '" style="display: inline-block; font-size: 12px; text-align: center; width: 22px; font-weight: light; background-color: #df2027; color: #ffffff;">';	
		} else {
			$calendar .= '<div class="calendar-day day-' . $month . '-' . $list_day . '" style="display: inline-block; font-size: 12px; text-align: center; width: 22px; font-weight: light;">';
		}
			/* add in the day number */
			$calendar .= '<span class="day-number" style="display: block; font-size: 12px; text-align: center;">'.$list_day.'</span>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			
		$calendar .= '</div>';
		if($running_day == 6):
			$calendar .= '</div>';
			if($day_counter != $days_in_month):
				$calendar.= '<div class="calendar-row" style="display: block; padding-left: 5px; text-align: center;">';
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
			$calendar.= '<span class="calendar-day-np" style="display: inline-block; font-size: 12px; text-align: center; width: 22px; font-weight: bold;"> </span>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</div>';

	/* end the table */
	$calendar.= '</div>';
	
	/* all done, return result */
	return $calendar;
}