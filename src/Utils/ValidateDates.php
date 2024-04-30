<?php
	namespace GpiPoligran\Utils;

	final class ValidateDates {
	      public static function secondGreaterOrEqualThanFirst(string $firstDate,string $secondDate) : bool{
                  $firstDateToTime = strtotime($firstDate);
                  $secondDateToTime = strtotime($secondDate);
                        
                  return $secondDateToTime >= $firstDateToTime;
		}

            public static function secondGreaterThanFirst(string $firstDate,string $secondDate) : bool{
                  $firstDateToTime = strtotime($firstDate);
                  $secondDateToTime = strtotime($secondDate);
                        
                  return $secondDateToTime > $firstDateToTime;
		}
	}