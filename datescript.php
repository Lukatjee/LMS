<?php

	$limits = ['2022-09-01', '2023-06-30'];

	$periods = [

		['08:25', '09:15'],
		['09:15', '10:05'],
		['10:20', '11:10'],
		['11:10', '12:00'],
		['12:05', '12:55'],
		['13:00', '13:50'],
		['13:50', '14:40'],
		['14:55', '15:45']

	];

	$results = array();

	while ($limits[0] <= $limits[1]) {

		if (!is_weekend($limits[0])) {

			$blocks = array();

			foreach ($periods as $period) {
				$blocks[] = ['start' => $limits[0] . ' ' . $period[0], 'end' => $limits[0] . ' ' . $period[1]];
			}

			$results[] = ['id' => 1, 'periods' => $blocks];

		}

		$limits[0] = date('Y-m-d',
			strtotime('+1 day', strtotime($limits[0]))
		);

	}

	function is_weekend($timestamp = null) : bool
	{
		return $timestamp === null ? in_array(date('N'), ['6', '7']) : (in_array(date('N', strtotime($timestamp)), ['6', '7']));
	}

?>

<pre> <?php print_r($results) ?> </pre>

