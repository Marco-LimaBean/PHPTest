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