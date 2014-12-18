<?php /*
    These variables are magically populated from the options declared in mml-simple-weather.php. Each option is loaded
    with the prefix (mml_weather_) stripped

    $conditions, $days and $terms are extracted from the language file and finally the $feed, and $windDirection variables
    are also set prior to render.
*/ ?>
<div class="weather-shortcode-expanded">
    <div class="weather-now">

        <?php if ($display_icon) : ?>
            <img src="<?php echo $imageset . $feed['item']['condition']['code']; ?>.png">
        <?php endif; ?>

        <?php if ($display_city) : ?>
            <p>
                <?php echo $city; ?>
            </p>
        <?php endif; ?>

        <?php if ($display_temp) : ?>
            <p>
                <?php echo $feed['item']['condition']['temp']; ?><sup>°</sup><?php echo strtoupper($unit); ?>
            </p>
        <?php endif; ?>


        <?php if ($display_description) : ?>
            <?php echo $conditions[$feed['item']['condition']['code']]; ?>
        <?php endif; ?>

        <dl class="weather-summary">

            <?php if ($display_wind_speed) : ?>
                <dt><?php echo $terms[0]; ?></dt>
                <dd><?php echo round($feed['wind']['speed'],1); ?> k/h</dd>
            <?php endif; ?>

            <?php if ($display_wind_direction) : ?>
                <dt><?php echo $terms[1] ?></dt>
                <dd><?php echo $windDirection; ?></dd>
            <?php endif; ?>

            <?php if ($display_sunrise) : ?>
                <dt><?php echo $terms[7]; ?></dt>
                <dd><?php echo $feed['astronomy']['sunrise']; ?></dd>
            <?php endif; ?>

            <?php if ($display_sunset) : ?>
                <dt><?php echo $terms[8]; ?></dt>
                <dd><?php echo $feed['astronomy']['sunset']; ?></dd>
            <?php endif; ?>

            <?php if ($display_humidity) : ?>
                <dt><?php echo $terms[9]; ?></dt>
                <dd><?php echo $feed['atmosphere']['humidity'] ." %"; ?></dd>
            <?php endif; ?>

            <?php if ($display_visibility) : ?>
                <dt><?php echo $terms[10]; ?></dt>
                <dd><?php echo $feed['atmosphere']['visibility'] . " km"; ?></dd>
            <?php endif; ?>

            <?php if ($display_pressure) : ?>
                <dt><?php echo $terms[11]; ?></dt>
                <dd><?php echo round($feed['atmosphere']['pressure']/1000, 2) . " bar"; ?></dd>
            <?php endif; ?>

        </dl>

    </div>

    <?php if ($display_forecast) :
        foreach ($feed['item']['forecast'] as $i => $day) : ?>
            <?php if ($i > 2) { break; } ?>

            <div class="day-summary">
                <?php if ($display_forecast_icon) : ?>
                    <img src="<?php echo $imageset . $day['code']; ?>.png" alt="Weather icon">
                <?php endif; ?>

                <?php echo $terms[$days[$day['day']]]; ?>

                <span>
                    <?php echo $day['high']; ?><sup>°</sup><?php echo $unit; ?>
                </span>
                <span>
                    <?php echo $day['low']; ?><sup>°</sup><?php echo $unit; ?>
                </span>
            </div>

        <?php endforeach;
    endif; ?>

    <a href="https://www.yahoo.com/?ilc=401" target="_blank"> <img src="https://poweredby.yahoo.com/purple.png" width="134" height="29"/> </a>

</div>
