<?php /*
    These variables are magically populated from the options declared in mml-simple-weather.php. Each option is loaded
    with the prefix (mml_weather_) stripped

    $conditions, $days and $terms are extracted from the language file and finally the $feed, and $windDirection variables
    are also set prior to render.
*/ ?>
<div class="weather-shortcode-expanded">
    <div class="weather-now">
        <img src="<?php echo $imageset . $feed['item']['condition']['code']; ?>.png">
        <p>
            <?php echo $city; ?>
        </p>

        <?php echo $feed['item']['condition']['temp']; ?><sup>°</sup><?php echo strtoupper($unit); ?>

        <?php echo $conditions[$feed['item']['condition']['code']]; ?>

        <?php echo $terms[0]; ?>: <?php echo round($feed['wind']['speed'],1); ?> k/h

        <?php echo $terms[1] . ':' . $windDirection; ?>

        <?php echo $terms[7] . " : " . $feed['astronomy']['sunrise'] . " | " . $terms[8] . " : " . $feed['astronomy']['sunset'];  ?>

        <?php echo $terms[9] . " : " . $feed['atmosphere']['humidity'] ." %  | " . $terms[10] . " : " . $feed['atmosphere']['visibility'] . " km | " . $terms[11] . " : " . round($feed['atmosphere']['pressure']/1000, 2) . " bar"; ?>
    </div>

    <?php foreach ($feed['item']['forecast'] as $i => $day) : ?>
        <?php if ($i > 2) { break; } ?>
        <div class="day-summary">
            <img src="<?php echo $imageset . $day['code']; ?>.png" alt="Weather icon">

            <?php echo $terms[$days[$day['day']]]; ?>

            <span>
                <?php echo $day['high']; ?><sup>°</sup><?php echo $unit; ?>
            </span>
            <span>
                <?php echo $day['low']; ?><sup>°</sup><?php echo $unit; ?>
            </span>
        </div>

    <?php endforeach;?>

    <a href="https://www.yahoo.com/?ilc=401" target="_blank"> <img src="https://poweredby.yahoo.com/purple.png" width="134" height="29"/> </a>

</div>
