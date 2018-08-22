<?php

// Make sure data was actually received from the form
if (isset($_POST['settingsData'])) {
    saveConfig();
}else{
    echo "error";
}

// Create and save the config file
function saveConfig(){

    // Make sure number boxes aren't below 0
    if ($_POST['refreshtime'] < 0) {
        $refreshtime = 0;
    }else{
        $refreshtime = $_POST['refreshtime'];
    }

    // Check the checkboxes and set them to 1 or 0
    if (isset($_POST['showErrors'])) {
        $showerrors = 1;
    }else{
        $showerrors = 0;
    }

    if (isset($_POST['debugMode'])) {
        $debugmode = 1;
    }else{
        $debugmode = 0;
    }

    if (isset($_POST['showHostname'])) {
        $hostname = 1;
    }else{
        $hostname = 0;
    }

    if (isset($_POST['showIP'])) {
        $ip = 1;
    }else{
        $ip = 0;
    }

    if (isset($_POST['showOS'])) {
        $os = 1;
    }else{
        $os = 0;
    }

    if (isset($_POST['showKernel'])) {
        $kernel = 1;
    }else{
        $kernel = 0;
    }

    if (isset($_POST['showUptime'])) {
        $uptime = 1;
    }else{
        $uptime = 0;
    }

    if (isset($_POST['showBootTime'])) {
        $boottime = 1;
    }else{
        $boottime = 0;
    }

    if (isset($_POST['showCPU'])) {
        $cpu = 1;
    }else{
        $cpu = 0;
    }

    if (isset($_POST['showTemp'])) {
        $temp = 1;
    }else{
        $temp = 0;
    }

    if (isset($_POST['showRAM'])) {
        $ram = 1;
    }else{
        $ram = 0;
    }

    if (isset($_POST['showSwap'])) {
        $swap = 1;
    }else{
        $swap = 0;
    }

    if (isset($_POST['show1min'])) {
        $onemin = 1;
    }else{
        $onemin = 0;
    }

    if (isset($_POST['show5min'])) {
        $fivemin = 1;
    }else{
        $fivemin = 0;
    }

    if (isset($_POST['show15min'])) {
        $fifteenmin = 1;
    }else{
        $fifteenmin = 0;
    }

    if (isset($_POST['showNet'])) {
        $net = 1;
    }else{
        $net = 0;
    }

    if (isset($_POST['showDisk'])) {
        $disk = 1;
    }else{
        $disk = 0;
    }


    // Generate the config file from the submitted form data
    $configHeader = '<?php
        /*************************************************************/
        /*  CHANGES TO THIS FILE WILL BE OVERWRITTEN BY THE WEB UI!  */
        /*************************************************************/
        //Generated by SWMP Settings at ' . date('Y-m-d H:i:s') . '
        return array
        (';

    $theConfig = '
            // General settings
            "lang" => "' . $_POST['language'] . '",
            "theme" => "' . $_POST['themeSelect'] . '",
            "showerrors" => ' . $showerrors . ',
            "windowtitle" => "' . $_POST['windowTitle'] . '",
            "reload" => ' . $refreshtime . ',
            "debug" => ' . $debugmode . ',

            // Hide Sections (1 is shown, 0 is hidden.)

            // System Information
            "hostname" => ' . $hostname . ',
            "ip" => ' . $ip . ',
            "os" => ' . $os . ',
            "kernel" => ' . $kernel . ',
            "uptime" => ' . $uptime . ',
            "boottime" => ' . $boottime . ',
            "cpuinfo" => ' . $cpu . ',
            "temp" => ' . $temp . ',
            // RAM & Swamp
            "ram" => ' . $ram . ',
            "swap" => ' . $swap . ',
            // CPU
            "1min" => ' . $onemin . ',
            "5min" => ' . $fivemin . ',
            "15min" => ' . $fifteenmin . ',
            // Network Information
            "netinfo" => ' . $net . ',
            // Disk Information
            "diskinfo" => ' . $disk . ',
        );
        ';



    // Save to the config file
    $configContents = array($configHeader, $theConfig);
	$saveConf = file_put_contents("../config.php", $configContents, LOCK_EX);

    if (($saveConf === false) || ($saveConf == -1)) {
        print "fileerror";
    }else{
        print "saveOK"; // Inform that the save was fine
    }
}


?>