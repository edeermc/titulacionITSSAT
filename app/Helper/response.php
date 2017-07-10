<?php

function redirect( $val ) {
    $r = route($val);
    header( "Location: {$r}" );
}