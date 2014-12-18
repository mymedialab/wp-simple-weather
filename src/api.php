<?php

class mml_simple_weather_api
{
    protected $url = 'https://query.yahooapis.com/v1/public/yql';
    protected $httpArgs = array( 'timeout' => 1 ); // for defaults see http://codex.wordpress.org/Function_Reference/wp_remote_get
    protected $cacheTime = 600; // 10 minutes

    /**
     *
     * @param  string $location A valid Yahoo! weather woeid
     * @param  string $degrees  should be 'c' or 'f'
     * @return [type]           [description]
     */
    public function getCityDetails($location, $degrees)
    {
        $cached = $this->retrieveCityFromCache($location, $degrees);
        if ($cached) {
            return $cached;
        }

        $query = "select * from weather.forecast where location = '$location' and u = '$unit'";
        $queryString = http_build_query(array(
            'q' => $query,
            'format' => 'json'
        ));

        $response = wp_remote_get($this->url . '?' . $queryString, $this->httpArgs);
        if ($response && is_array($response) && isset($response['response']['code']) &&
            $response['response']['code'] === 200 && isset($response['body'])) {
            $arr = json_decode($response['body'], true);
        } else {
            return null;
        }

        if ($arr && isset($arr['query']) && isset($arr['query']['results']) && isset($arr['query']['results']['channel'])) {

            $this->addCityToCache($location, $degrees, $arr['query']['results']['channel']);
            return $arr['query']['results']['channel'];

        } else {
            return null;
        }
    }

    protected function retrieveCityFromCache($location, $degrees)
    {
        $feed = get_transient($this->makeTransientKey($location, $degrees));
        return empty($feed) ? false : $feed;
    }

    protected function addCityToCache($location, $degrees, $info)
    {
        set_transient($this->makeTransientKey($location, $degrees), $info, $this->cacheTime);
    }

    protected function makeTransientKey($location, $degrees)
    {
        // WP requires key to be < 45 characters long
        return "mml_weather_feed_{$location}_{$degrees}";
    }
}
