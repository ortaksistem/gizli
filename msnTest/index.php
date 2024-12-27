<html>
<head>
    <title>Msn Liste Getir</title>
</head>
<body>
    <?php
        if(isset($_POST['us_name'])&&isset($_POST['us_pass']))
        {
            $name = addslashes($_POST['us_name']);
            $pass = addslashes($_POST['us_pass']);
            
            require('msnImportClass/msn.class.php');
            $msn = new MSN('', false);
            $ListeArray = array();
            
            if (!$msn->connect($name, $pass)) {
                echo "MSN network baðlantýsý saðlanamadý.\n";
                echo "$msn->error\n";
            } else {
                $aContactList = $msn->getMembershipList();
                
                foreach ($aContactList as $u_domain => $aUserList)
                {
                    foreach ($aUserList as $u_name => $aNetworks)
                    {
                        $toAddr = $u_name.'@'.$u_domain;
                        array_push($ListeArray, $toAddr);
                    }
                }
                
                if(count($ListeArray)<=0)
                {
                    echo "Kiþi bulunamadý";
                } else {
                    $done = 1;
                    echo "toplam kiþi = ".count($ListeArray)."<br /><br />";
                    Foreach($ListeArray as $ePosta)
                    {
                        echo "[".$done."] => ".$ePosta."<br />";
                        $done++;
                    }
                }
            }
        } else {
    ?>
    <strong>MSN Kiþi Listesi Getir</strong><br />
    <form method="post" target="_self" enctype="application/x-www-form-urlencoded">
        Eposta : <input type="text" style="width: 240px;" name="us_name" /><br />
        Þifres : <input type="password" style="width: 240px;" name="us_pass" /><br />
        <input type="submit" value="Listeyi Getir" />
    </form>
    <?php }
    
        function get_1($string, $start, $end)
        {
        	$string = " ".$string;
        	$ini = strpos($string,$start);
        	if ($ini == 0) return "";
        	$ini += strlen($start);
        	$len = strpos($string,$end,$ini) - $ini;
        	return substr($string,$ini,$len);
        }
        
        function get_all_strings_between($string,$start,$end)
        {
            //Returns an array of all values which are between two tags in a set of data
            $strings = array();
            $startPos = 0;
            $i = 0;
            //echo strlen($string)."\n";
            while($startPos < strlen($string) && $matched = get_string_between(substr($string,$startPos),$start,$end))
            {
            if ($matched == null || $matched[1] == null || $matched[1] == '') break;
            $startPos = $matched[0]+$startPos+1;
            array_push($strings,$matched[1]);
            $i++;
            }
            return $strings;
        }
        
        function get_string_between($string, $start, $end)
        {
            //$string = " ".$string;
            $ini = strpos($string,$start);
            if ($ini == 0) return null;
            $ini += strlen($start);
            $len = strpos($string,$end,$ini) - $ini;
            return array($ini+$len,substr($string,$ini,$len));
        }
    
    ?>
</body>
</html>