<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<div class="wrap" >
    <h2>MML Simple Weather</h2>

    <?php echo $errors; ?>
    <?php if (isset($message)) :?>
        <div id="message" class="updated">
            <p><strong><?php echo $message  ?></strong></p>
        </div>
    <?php endif; ?>

    <form method="post" action="options.php">
        <?php settings_fields('mml-weather-settings-group'); ?>
        <?php do_settings_sections('mml-weather-settings-group'); ?>

        <table class="form-table">

            <tr>
                <th scope="row">
                    Select Your Language
                </th>
                <td>
                    <select name="mml_weather_lang">
                        <?php foreach ($languages as $lang => $formatted) : ?>
                            <?php if ($lang === $selectedLanguage) : ?>
                                <option selected="selected" value="<?php echo $lang ?>"><?php echo $formatted; ?></option>
                            <?php else: ?>
                                <option value="<?php echo $lang ?>"><?php echo $formatted; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    Name Your City
                </th>
                <td>
                    <input type="text" name="mml_weather_city" value="<?php echo esc_attr(get_option('mml_weather_city')); ?>" />
                </td>
            </tr>

            <tr>
                <th scope="row">
                    City WOEID
                </th>
                <td>
                    <input type="text" name="mml_weather_woeid" value="<?php echo esc_attr(get_option('mml_weather_woeid')); ?>" />
                </td>
            </tr>

            <tr>
                <th scope="row">
                    Temperature Unit
                </th>
                <td>
                    <select name="mml_weather_unit">
                        <option value="<?php echo esc_attr(get_option('mml_weather_unit')); ?>"><?php echo esc_attr(get_option('mml_weather_unit')); ?>
                        </option>
                        <option value="c">c</option>
                        <option value="f">f</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    CSS file
                </th>
                <td>
                    <input type="text" name="mml_weather_cssfile" value="<?php echo esc_attr(get_option('mml_weather_cssfile')); ?>" placeholder="Use default" />
                    <p class="description">
                        Enter a path for a css file to use here, which will be included in place of our default CSS.
                        We will assume the CSS file is in your stylesheet directory so make the path relative to that.
                        We recommend copying our CSS as an example. If weather appears on every page, you'll be better
                        off suppressing CSS (below) and concatenating the custom css into your theme style.
                    </p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    Don't include a CSS file; I can handle it.
                </th>
                <td>
                    <?php if (get_option('mml_weather_nocss') === 'suppress') : ?>
                        <input type="checkbox" name="mml_weather_nocss" value="suppress" checked="checked" />
                    <?php else: ?>
                        <input type="checkbox" name="mml_weather_nocss" value="suppress" />
                    <?php endif; ?>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    Select Weather Image-set
                </th>
                <td>
                    <select name="mml_weather_imageset">
                        <?php foreach ($imagesets as $setName => $formatted) : ?>
                            <?php if ($setName === $selectedImageset) : ?>
                                <option selected="selected" value="<?php echo $setName ?>"><?php echo $formatted; ?></option>
                            <?php else: ?>
                                <option value="<?php echo $setName ?>"><?php echo $formatted; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    Widget Should include
                </th>
                <td>
                    <?php foreach ($displayOptions as $option => $label) : ?>
                        <p>
                             <label>
                                <input type="checkbox" value="yes" name="<?php echo $option ?>" <?php if (get_option($option)) { echo "checked='checked'"; } ?>>
                                <?php echo $label ?>
                            </label>
                        </p>
                    <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    Shortcode
                </th>
                <td>
                     [mml-simple-weather]
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>

    <div dir="ltr" style="margin-top:10px; padding:10px; border:2px solid rgba(61, 87, 255, 0.69);">
        How can I find a city fips given a yahoo <b>WOEID</b>?
        <p>
            Yahoo uses weather.com as it's weather provider, so using the same steps as the above should work. However. If you would like to find your weather code through weather.yahoo.com, follow these steps.
        </p>
        <ol>
            <li>Go to http://weather.yahoo.com</li>
            <li>Search for your city. You will now see page with weather information.</li>
            <li>Click <b>'Extended forecast'</b>.</li>
            <li>http://www.weather.com/weather/extended/<b>IRXX0018</b>?par=yahoo...</li>
            <li><b>WOEID is:IRXX0018</b></li>
        </ol>
        <p class="description">
            Plugin Created By <a href="http://www.mymedialab.co.uk">MyMediaLab</a>
        </p>
        <p class="description">
            Plain weather icons by <b>~MerlinTheRed</b>
        </p>
        <p class="description">
            Original "Beautiful Yahoo Weather" plugin by <a href="http://www.wp-book.ir">Mohammad Pishdar</a>
        </p>
    </div>
</div>
