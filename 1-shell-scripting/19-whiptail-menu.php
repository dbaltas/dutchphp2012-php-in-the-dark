#!/usr/bin/php
<?php

$return = passthru("whiptail --menu \"Please choose the version to deploy\" 15 40 5 1.0.0-RC1 1 1.0.0-RC2 2 1.0.0-RC3 3");
