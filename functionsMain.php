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
 * @param $query \http\Url redirect to chosen http url
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


/** Binary Search through array using given value
 * @param $needle string
 * @param $haystack array
 * @param $element string
 * @return bool|int
 */
function binary_search1D($needle, $haystack, $element) {
    $min = 0;
    $max = count($haystack);
    while ($max >= $min)
    {
        $mid = (int) (($min + $max) / 2);
        if ($haystack[$mid][$element] == $needle) return $mid;
        else if ($haystack[$mid][$element] < $needle) $min = $mid + 1;
        else $max = $mid - 1;
    }
    // $needle was not found
    return false;
}
