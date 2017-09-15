<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/8/2017
 * Time: 3:27 PM
 */


/** Shows an alert message using JavaScript
 * @param $msg String the message to be alerted=
 */
function jsAlert($msg){
    ?>
    <script type="text/javascript">
    <!--
        alert("<?= htmlspecialchars($msg) ?>")

    -->
    </script>
    <?php
}

/** Refreshes the page.
 *
 */
function refresh(){
    echo '<META HTTP-EQUIV=REFRESH CONTENT="1;">';
}

/** Redirects to $url
 * @param $url \http\Url redirect to chosen http url
 */
function redirect($url){
    echo '<META HTTP-EQUIV=REFRESH CONTENT="1; url='. $url .'">';
}

/** Redirects to same page with query string appended
 * @param $query \http\Url|String redirect to chosen http url
 */
function redirectQuery($query){
    echo '<META HTTP-EQUIV=REFRESH CONTENT="1; url=?'. $query .'">';
}

/** Redirects to $url?$queryString
 * @param $url \http\Url redirect to chosen http url
 * @param $queryString \http\QueryString use http_build_query($params) to build a query string
 */
function redirectUrlQuery($url, $queryString){
    jsAlert($url .  $queryString);
    echo '<META HTTP-EQUIV=REFRESH CONTENT="1; url='. $url . '?' . $queryString . '">';
}

/** Checks whether valid SA ID. Currently only checks length
 * @param $id
 * @return bool
 */
function validSAID($id){
    if(strlen($id) === 13){
        return true;
    }
    return false;
}


/** echos a table row, generating an html5 input with the given parameters
 * @param $name
 * @param $value
 * @param string $placeholder
 * @param string $required
 * @param string $type
 */
function tableRowEditTD($name, $value, $placeholder = "", $required = "true", $type = "text"){
    echo "<td> 
            <input name='" . $name . "' value='" . htmlspecialchars($value) . "' placeholder='" . htmlspecialchars($placeholder) . "' type='" . $type . "' " . $required . ">
          </td>";
}

/** Generates a table row with the given value
 * @param $value
 */
function tableRowTD($value){
    echo "<td>" . htmlspecialchars($value) . "</td>";
}


/** Adds a script. Use scriptName for URL, defer defaults to none (''), otherwise use defer='true', default type is JS.
 * @param $scriptName
 * @param string $defer
 * @param string $type
 */
function addScript($scriptName, $defer = '', $type = "text/javascript"){
    ?>
    <script src="<?= htmlspecialchars($scriptName) ?>"
            type="<?= htmlspecialchars($type) ?>"<?= htmlspecialchars($defer) ?>>
    </script>

    <?php
}

/** json_encodes a string/object in a <script type='text/javascript'> echo using given variable name.
 * @param $variable string|array
 * @param $object string|array
 */
function jsonJSEcho($variable, $object){
    echo "<script type='text/javascript'>
";

    if(is_string($variable)){
        ?>
        var <?= htmlspecialchars($variable) ?> = <?= json_encode($object) ?>
        <?php
    }
    //then both are array
    else{
        $index = 0;
        foreach ($variable as $value){
            ?> var <?= htmlspecialchars($value) ?> = <?= json_encode($object[$index]) ?>;
            <?php
            $index++;
        }
    }

    echo "</script>
";

}

/** Returns the number of days between the given date and system date.
 *  Positive means that the date is in the future
 *  Zero means that it is within 24 hours
 *  Negative means that the date has passed
 * @param $date
 * @return float
 */
function getDayDifference($date)
{
    $now = time(); // or your date as well
    $your_date = strtotime($date);
    $datediff = $now - $your_date;

    return floor($datediff / (60 * 60 * 24));
}