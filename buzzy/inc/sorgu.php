<?php
session_start();

$islem = $_GET["islem"];

$id = $_POST["id"];

if(!is_numeric($id) or !$islem) die("hatacik");

include("../fonksiyon.php");


if(_UYEDURUM == 1){	
	list($domain, $tip) = @mysql_fetch_row(@mysql_query("select domain, tip from sorgu where id='$id' and uye='"._UYEID."'"));
	
	if(!$domain) die("İşlem gerçekleştirilemiyor");

	if($islem == "crawled"){
	
		$sayfa = $_POST["sayfa"];
		$adet = $_POST["data"];
		
		$adet = intval($adet);
		$sayfa = intval($sayfa);
		if(!$sayfa) $sayfa = 1;
		$limit = 30;

		if(!is_numeric($sayfa) or !is_numeric($adet)) die("hatadir");
		
		$sayfa--;
		
		$offset = $sayfa * $limit;
		
		$toplamsayfa = ceil($adet/$limit);
		
		
	?>
                <div class="pagination clearfix">
                    <div class="paging left">
                        <span class="left"><?=($sayfa+1);?> - <?=$toplamsayfa?> Sayfa, <?=$adet?> adet taranan sayfa bulunuyor</span>
                        <ul class="right">
						<?php
							$pg = $sayfa + 1;	
							
							if($pg != 1) echo '<li><a href="javascript:void(0)" onclick="sorgu('.$id.', \'crawled\', 1, '.$adet.')"><<</a></li>';
								for($j = ($pg - 4); $j <= ($pg + 4); $j++){

									if($j >=1 and $j <= $toplamsayfa){
									
										if($j == $pg) echo '<li class="active"><a href="javascript:void(0)" onclick="sorgu('.$id.', \'crawled\', '.$j.', '.$adet.')">'.$j.'</a></li>';
										else echo '<li><a href="javascript:void(0)" onclick="sorgu('.$id.', \'crawled\', '.$j.', '.$adet.')">'.$j.'</a></li>';
								
									}
								}
							if($pg != $toplamsayfa) echo '<li><a href="javascript:void(0)" onclick="sorgu('.$id.', \'crawled\', '.$toplamsayfa.', '.$adet.')">>></a></li>';
						?>
                        </ul>
                    </div>
                    <div class="export right">
                        <a href="javascript:void(0)" class="green left">EXPORT</a>
                        <a href="javascript:void(0)" class="blue left">
                            <img src="Assets/Img/exportlink.png" /></a>
                    </div>
                </div>
               <div class="table-sort">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="brd_none"></td>
                                <td colspan="2" width="150">
                                    <div class="text">Başlık<br />Url</div>
                                </td>
                                <td>
                                    <div class="text">Rank</div>
                                </td>
                                <td>
                                    <div class="text">Int<br />Ext</div>
                                </td>
                                <td>
                                    <div class="text">Boyut<br />Http Code</div>
                                </td>
                                <td>
                                    <div class="text">Son Görülme</div>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
						<?php
						
						if(!$tip) $tip = "domain";
						
						$suan = @mktime();
												
						$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='crawled' and sayfa='$sayfa' and kayit > $suan");

						if(@mysql_num_rows($cache) >= 1){
													
							list($cek) = @mysql_fetch_row($cache);
							
							
						}
						else {

							$cachetime = $suan + (60*60*24*7);
							
							@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='crawled' and sayfa='$sayfa' and kayit < $suan");
							
							$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=pages&target=".$domain."&mode=".$tip."&offset=".$offset."&limit=30&output=json");
							
							$result = @mysql_query("insert into cache values('$domain', '$tip', 'crawled', '$sayfa', '".addslashes($cek)."', '$cachetime')");
							
										
						}
						
						// $cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=pages&target=".$domain."&mode=".$tip."&offset=".$offset."&limit=30&output=json");
						$don = json_decode($cek);
						$i = $offset;
						
						$i++;
						
						foreach($don->pages as $aktar){
						
							
						
						?>
                            <tr>
                                <td class="number brd_none"><?=$i?></td>
                                <td class="clearfix brd_none">
                                    <div>
                                        <div class="text"><?=kisaltma($aktar->title);?></div>
                                        <div class="link clearfix">
                                            <a href="<?=$aktar->url;?>" target="_blank" title="<?=$aktar->url;?>" class="left"><?=$aktar->url;?></a>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="link align-center">&nbsp;</div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->ahrefs_rank;?></div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->links_internal;?><br /><?=$aktar->links_internal;?></div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->size;?><br /><?=$aktar->http_code;?></div>
                                </td>
                                <td class="brd_none">
                                    <div class="text bold align-right">
                                        <?=ahrefstarih($aktar->last_visited);?>
                                    </div>
                                </td>
                            </tr>
						<?php
							
							$i++;
						}
						
						?>

                        </tbody>
                    </table>
                </div>
	<?php
	
	} // end crawled	

	if($islem == "anchors"){
	
		$sayfa = $_POST["sayfa"];
		$adet = $_POST["data"];
		
		$adet = intval($adet);
		$sayfa = intval($sayfa);
		if(!$sayfa) $sayfa = 1;
		$limit = 30;
		
		if(!is_numeric($sayfa) or !is_numeric($adet)) die("hatadir");
		
		$sayfa--;
		
		$offset = $sayfa * $limit;
		
		$toplamsayfa = ceil($adet/$limit);
		
		$sayfa = $sayfa + 2;
		
		$i = $adet;
		
		$goster = 1;
		
		
		if($i < 2){
		
			
	?>
	
               <div class="table-sort">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="brd_none"></td>
                                <td colspan="2" width="150">
                                    <div class="text">Kelime</div>
                                </td>
                                <td>
                                    <div class="text">Backlinks</div>
                                </td>
                                <td>
                                    <div class="text">Ref Pages</div>
                                </td>
                                <td>
                                    <div class="text">Ref Domain</div>
                                </td>
                                <td>
                                    <div class="text">Son Görülme</div>
                                </td>
                            </tr>
                        </thead>
						<tbody id="devaminiyukle">
		<?php
			}
			else {
				$goster = 0;
			}
		?>
                        
						<?php
						
						if(!$tip) $tip = "domain";
						
						$suan = @mktime();
												
						$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='anchors' and sayfa='$sayfa' and kayit > $suan");

						if(@mysql_num_rows($cache) >= 1){
													
							list($cek) = @mysql_fetch_row($cache);
							
						}
						else {

							$cachetime = $suan + (60*60*24*7);
							
							@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='anchors' and sayfa='$sayfa' and kayit < $suan");
							
							$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=anchors&target=".$domain."&mode=".$tip."&offset=".$offset."&limit=30&order_by=backlinks%3Adesc&output=json");
							
							@mysql_query("insert into cache values('$domain', '$tip', 'anchors', '$sayfa', '".addslashes($cek)."', '$cachetime')");
													
						}	
						
						$don = json_decode($cek);
						
						
						foreach($don->anchors as $aktar){
						
							
						
						?>
                            <tr>
                                <td class="number brd_none"><?=$i?></td>
                                <td class="clearfix brd_none">
                                    <div>
                                        <div class="text"><?php
										if($aktar->anchor) echo $aktar->anchor;
										else echo "no-text";
										
										?></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="link align-center">&nbsp;</div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->backlinks;?></div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->refpages;?></div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->refdomains;?></div>
                                </td>
                                <td class="brd_none">
                                    <div class="text bold align-right">
                                        <?=ahrefstarih($aktar->last_visited);?>
                                    </div>
                                </td>
                            </tr>
						<?php
							
							$i++;
						}
					
				if($goster == 1){
						?>

                        </tbody>
					
                </table>
                </div>
				
                <div class="pagination clearfix">
                    <div class="export right">
                        <a href="javascript:void(0)" onclick="sorgu2(<?=$id?>, 'anchors', <?=$sayfa?>, <?=$i?>)" class="green left">DEVAMINI YÜKLE</a>
                    </div>
                </div>
	<?php
			} // end i
			
	} // end anchors	
	
	if($islem == "backlink"){
	
		$sayfa = $_POST["sayfa"];
		$adet = $_POST["data"];
		
		$adet = intval($adet);
		$sayfa = intval($sayfa);
		if(!$sayfa) $sayfa = 1;
		$limit = 30;
		
		if(!is_numeric($sayfa) or !is_numeric($adet)) die("hatadir");
		
		$sayfa--;
		
		$offset = $sayfa * $limit;
		
		$toplamsayfa = ceil($adet/$limit);
		
		
		
	?>
                <div class="pagination clearfix">
                    <div class="paging left">
                        <span class="left"><?=($sayfa+1);?> - <?=$toplamsayfa?> Sayfa, <?=$adet?> adet backlink bulunuyor</span>
                        <ul class="right">
						<?php
							$pg = $sayfa + 1;	
							
							if($pg != 1) echo '<li><a href="javascript:void(0)" onclick="sorgu('.$id.', \'backlink\', 1, '.$adet.')"><<</a></li>';
								for($j = ($pg - 4); $j <= ($pg + 4); $j++){

									if($j >=1 and $j <= $toplamsayfa){
									
										if($j == $pg) echo '<li class="active"><a href="javascript:void(0)" onclick="sorgu('.$id.', \'backlink\', '.$j.', '.$adet.')">'.$j.'</a></li>';
										else echo '<li><a href="javascript:void(0)" onclick="sorgu('.$id.', \'backlink\', '.$j.', '.$adet.')">'.$j.'</a></li>';
								
									}
								}
							if($pg != $toplamsayfa) echo '<li><a href="javascript:void(0)" onclick="sorgu('.$id.', \'backlink\', '.$toplamsayfa.', '.$adet.')">>></a></li>';
						?>
                        </ul>
                    </div>
                    <div class="export right">
                        <a href="javascript:void(0)" class="green left">EXPORT</a>
                        <a href="javascript:void(0)" class="blue left">
                            <img src="Assets/Img/exportlink.png" /></a>
                    </div>
                </div>
               <div class="table-sort">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="brd_none"></td>
                                <td colspan="2">
                                    <div class="text">Domain Başlık<br />Domain Url</div>
                                </td>
                                <td>
                                    <div class="text">Yeni/Eski<br />Rank<br />Rating</div>
                                </td>
                                <td>
                                    <div class="text">Int<br />Ext</div>
                                </td>
                                <td>
                                    <div class="text">Link Url<br />Link Anchor</div>
                                </td>
                                <td>
                                    <div class="text">İlk Görülme<br />Son Görülme</div>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
						<?php
						
						if(!$tip) $tip = "domain";
						$suan = @mktime();
												
						$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='backlink' and sayfa='$sayfa' and kayit > $suan");

						if(@mysql_num_rows($cache) >= 1){
													
							list($cek) = @mysql_fetch_row($cache);
								
						}
						else {

							$cachetime = $suan + (60*60*24*7);
							
							@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='backlink' and sayfa='$sayfa' and kayit < $suan");
							
							$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=backlinks_new_lost&target=".$domain."&mode=".$tip."&offset=".$offset."&limit=30&order_by=date%3Adesc&output=json");
							
							@mysql_query("insert into cache values('$domain', '$tip', 'backlink', '$sayfa', '".addslashes($cek)."', '$cachetime')");
													
						}	
						
						$don = json_decode($cek);
						$i = $offset;
						
						$i++;
						
						foreach($don->refpages as $aktar){
						
							
						
						?>
                            <tr>
                                <td class="number brd_none"><?=$i?></td>
                                <td class="clearfix brd_none">
                                    <div>
                                        <div class="text"><?=kisaltma($aktar->title);?></div>
                                        <div class="link clearfix">
                                            <a href="<?=$aktar->url_from;?>" target="_blank" title="<?=$aktar->url_from;?>" class="left"><?=$aktar->url_from;?></a>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="link align-center">&nbsp;</div>
                                </td>
                                <td>
                                    <div class="link align-center"><?php
											
											if($aktar->type == "lost") echo "<font color=red>Eski</font>";
											if($aktar->type == "new") echo "<font color=green>Yeni</font>";
											
											?><br /><?=$aktar->ahrefs_rank;?> Rank<br /><?=$aktar->domain_rating;?> Rating</div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->links_internal;?><br /><?=$aktar->links_internal;?></div>
                                </td>
                                <td>
                                    <div class="link clearfix">
                                        <a href="<?=$aktar->url_to;?>" target="_blank" class="left"><?=$aktar->url_to;?></a>
                                        <br />
										<?=$aktar->anchor;?>
                                    </div>
                                </td>
                                <td class="brd_none">
                                    <div class="text align-right"><?=ahrefstarih($aktar->first_seen);?></div>
                                    <div class="text bold align-right">
                                        <?=ahrefstarih($aktar->last_visited);?>
                                    </div>
                                </td>
                            </tr>
						<?php
							
							$i++;
						}
						
						?>

                        </tbody>
                    </table>
                </div>
	<?php
	
	} // end backlink

	if($islem == "backlinkbroken"){
	
		$sayfa = $_POST["sayfa"];
		$adet = $_POST["data"];
		
		$adet = intval($adet);
		$sayfa = intval($sayfa);
		if(!$sayfa) $sayfa = 1;
		$limit = 30;
		
		if(!is_numeric($sayfa) or !is_numeric($adet)) die("hatadir");
		
		$sayfa--;
		
		$offset = $sayfa * $limit;
		
		$toplamsayfa = ceil($adet/$limit);
		
		$sayfa = $sayfa + 2;
		
		$i = $adet;
		
		$goster = 1;
		
		
		if($i < 2){
		
		
	?>
               <div class="table-sort">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="brd_none"></td>
                                <td colspan="2" width="480">
                                    <div class="text">Domain Başlık<br />Domain Url</div>
                                </td>
                                <td>
                                    <div class="text">Link Url<br />Link Anchor</div>
                                </td>
                                <td>
                                    <div class="text">İlk Görülme<br />Son Görülme</div>
                                </td>
                            </tr>
                        </thead>
						<tbody id="devaminiyukle">
		<?php
			}
			else {
				$goster = 0;
			}
		?>
						<?php
						
						if(!$tip) $tip = "domain";
						$suan = @mktime();
												
						$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='backlinkbroken' and sayfa='$sayfa' and kayit > $suan");

						if(@mysql_num_rows($cache) >= 1){
													
							list($cek) = @mysql_fetch_row($cache);

						}
						else {

							$cachetime = $suan + (60*60*24*7);
							
							@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='backlinkbroken' and sayfa='$sayfa' and kayit < $suan");
							
							$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=backlinks_new_lost&target=".$domain."&mode=".$tip."&offset=".$offset."&where=http_code%3A404&limit=30&order_by=date%3Adesc&output=json");
							
							@mysql_query("insert into cache values('$domain', '$tip', 'backlinkbroken', '$sayfa', '".addslashes($cek)."', '$cachetime')");
													
						}
						
						$don = json_decode($cek);
						
						foreach($don->refpages as $aktar){
						
							
						
						?>
                            <tr>
                                <td class="number brd_none"><?=$i?></td>
                                <td class="clearfix brd_none">
                                    <div>
                                        <div class="text"><?=kisaltma($aktar->title);?></div>
                                        <div class="link clearfix">
                                            <a href="<?=$aktar->url_from;?>" target="_blank" title="<?=$aktar->url_from;?>" class="left"><?=$aktar->url_from;?></a>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="link align-center">&nbsp;</div>
                                </td>
                                <td>
                                    <div class="link clearfix">
                                        <a href="<?=$aktar->url_to;?>" target="_blank" class="left"><?=$aktar->url_to;?></a>
                                        <br />
										<?=$aktar->anchor;?>
                                    </div>
                                </td>
                                <td class="brd_none">
                                    <div class="text align-right"><?=ahrefstarih($aktar->first_seen);?></div>
                                    <div class="text bold align-right">
                                        <?=ahrefstarih($aktar->last_visited);?>
                                    </div>
                                </td>
                            </tr>
						<?php
							
							$i++;
						}
					
				if($goster == 1){
						?>

                        </tbody>
					
                </table>
                </div>
				
                <div class="pagination clearfix">
                    <div class="export right">
                        <a href="javascript:void(0)" onclick="sorgu2(<?=$id?>, 'backlinkbroken', <?=$sayfa?>, <?=$i?>)" class="green left">DEVAMINI YÜKLE</a>
                    </div>
                </div>
	<?php
			} // end i
	
	} // end backlinkbroken

	if($islem == "backlinknew"){
	
		$sayfa = $_POST["sayfa"];
		$adet = $_POST["data"];
		
		$adet = intval($adet);
		$sayfa = intval($sayfa);
		if(!$sayfa) $sayfa = 1;
		$limit = 30;
		
		if(!is_numeric($sayfa) or !is_numeric($adet)) die("hatadir");
		
		$sayfa--;
		
		$offset = $sayfa * $limit;
		
		$toplamsayfa = ceil($adet/$limit);
		
		$sayfa = $sayfa + 2;
		
		$i = $adet;
		
		$goster = 1;
		
		
		if($i < 2){
		
			
	?>

               <div class="table-sort">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="brd_none"></td>
                                <td colspan="2">
                                    <div class="text">Domain Başlık<br />Domain Url</div>
                                </td>
                                <td>
                                    <div class="text">Yeni/Eski<br />Rank<br />Rating</div>
                                </td>
                                <td>
                                    <div class="text">Int<br />Ext</div>
                                </td>
                                <td>
                                    <div class="text">Link Url<br />Link Anchor</div>
                                </td>
                                <td>
                                    <div class="text">İlk Görülme<br />Son Görülme</div>
                                </td>
                            </tr>
                        </thead>
						<tbody id="devaminiyukle">
		<?php
			}
			else {
				$goster = 0;
			}
		?>
                        
						<?php
						
						if(!$tip) $tip = "domain";
						$suan = @mktime();
												
						$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='backlinknew' and sayfa='$sayfa' and kayit > $suan");

						if(@mysql_num_rows($cache) >= 1){
													
							list($cek) = @mysql_fetch_row($cache);
								
						}
						else {

							$cachetime = $suan + (60*60*24*7);
							
							@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='backlinknew' and sayfa='$sayfa' and kayit < $suan");
							
							$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=backlinks_new_lost&target=".$domain."&mode=".$tip."&offset=".$offset."&where=type%3A%22new%22&limit=30&order_by=date%3Adesc&output=json");
							
							@mysql_query("insert into cache values('$domain', '$tip', 'backlinknew', '$sayfa', '".addslashes($cek)."', '$cachetime')");
													
						}	
						
						$don = json_decode($cek);
						
						foreach($don->refpages as $aktar){
						
							
						
						?>
                            <tr>
                                <td class="number brd_none"><?=$i?></td>
                                <td class="clearfix brd_none">
                                    <div>
                                        <div class="text"><?=kisaltma($aktar->title);?></div>
                                        <div class="link clearfix">
                                            <a href="<?=$aktar->url_from;?>" target="_blank" title="<?=$aktar->url_from;?>" class="left"><?=$aktar->url_from;?></a>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="link align-center">&nbsp;</div>
                                </td>
                                <td>
                                    <div class="link align-center"><?php
											
											if($aktar->type == "lost") echo "<font color=red>Eski</font>";
											if($aktar->type == "new") echo "<font color=green>Yeni</font>";
											
											?><br /><?=$aktar->ahrefs_rank;?> Rank<br /><?=$aktar->domain_rating;?> Rating</div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->links_internal;?><br /><?=$aktar->links_internal;?></div>
                                </td>
                                <td>
                                    <div class="link clearfix">
                                        <a href="<?=$aktar->url_to;?>" target="_blank" class="left"><?=$aktar->url_to;?></a>
                                        <br />
										<?=$aktar->anchor;?>
                                    </div>
                                </td>
                                <td class="brd_none">
                                    <div class="text align-right"><?=ahrefstarih($aktar->first_seen);?></div>
                                    <div class="text bold align-right">
                                        <?=ahrefstarih($aktar->last_visited);?>
                                    </div>
                                </td>
                            </tr>
						<?php
							
							$i++;
						}
					
				if($goster == 1){
						?>

                        </tbody>
					
                </table>
                </div>
				
                <div class="pagination clearfix">
                    <div class="export right">
                        <a href="javascript:void(0)" onclick="sorgu2(<?=$id?>, 'backlinknew', <?=$sayfa?>, <?=$i?>)" class="green left">DEVAMINI YÜKLE</a>
                    </div>
                </div>
	<?php
			} // end i
	
	} // end backlinknew

	if($islem == "backlinklost"){
	
		$sayfa = $_POST["sayfa"];
		$adet = $_POST["data"];
		
		$adet = intval($adet);
		$sayfa = intval($sayfa);
		if(!$sayfa) $sayfa = 1;
		$limit = 30;
		
		if(!is_numeric($sayfa) or !is_numeric($adet)) die("hatadir");
		
		$sayfa--;
		
		$offset = $sayfa * $limit;
		
		$toplamsayfa = ceil($adet/$limit);
		
		$sayfa = $sayfa + 2;
		
		$i = $adet;
		
		$goster = 1;
		
		
		if($i < 2){
		
			
	?>

               <div class="table-sort">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="brd_none"></td>
                                <td colspan="2">
                                    <div class="text">Domain Başlık<br />Domain Url</div>
                                </td>
                                <td>
                                    <div class="text">Yeni/Eski<br />Rank<br />Rating</div>
                                </td>
                                <td>
                                    <div class="text">Int<br />Ext</div>
                                </td>
                                <td>
                                    <div class="text">Link Url<br />Link Anchor</div>
                                </td>
                                <td>
                                    <div class="text">İlk Görülme<br />Son Görülme</div>
                                </td>
                            </tr>
                        </thead>
						<tbody id="devaminiyukle">
		<?php
			}
			else {
				$goster = 0;
			}
		?>
                        
						<?php
						
						if(!$tip) $tip = "domain";
						$suan = @mktime();
												
						$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='backlinklost' and sayfa='$sayfa' and kayit > $suan");

						if(@mysql_num_rows($cache) >= 1){
													
							list($cek) = @mysql_fetch_row($cache);
						}
						else {

							$cachetime = $suan + (60*60*24*7);
							
							@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='backlinklost' and sayfa='$sayfa' and kayit < $suan");
							
							$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=backlinks_new_lost&target=".$domain."&mode=".$tip."&offset=".$offset."&where=type%3A%22lost%22&limit=30&order_by=date%3Adesc&output=json");
							
							@mysql_query("insert into cache values('$domain', '$tip', 'backlinklost', '$sayfa', '".addslashes($cek)."', '$cachetime')");
													
						}	
						
						$don = json_decode($cek);
						
						foreach($don->refpages as $aktar){
						
							
						
						?>
                            <tr>
                                <td class="number brd_none"><?=$i?></td>
                                <td class="clearfix brd_none">
                                    <div>
                                        <div class="text"><?=kisaltma($aktar->title);?></div>
                                        <div class="link clearfix">
                                            <a href="<?=$aktar->url_from;?>" target="_blank" title="<?=$aktar->url_from;?>" class="left"><?=$aktar->url_from;?></a>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="link align-center">&nbsp;</div>
                                </td>
                                <td>
                                    <div class="link align-center"><?php
											
											if($aktar->type == "lost") echo "<font color=red>Eski</font>";
											if($aktar->type == "new") echo "<font color=green>Yeni</font>";
											
											?><br /><?=$aktar->ahrefs_rank;?> Rank<br /><?=$aktar->domain_rating;?> Rating</div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->links_internal;?><br /><?=$aktar->links_internal;?></div>
                                </td>
                                <td>
                                    <div class="link clearfix">
                                        <a href="<?=$aktar->url_to;?>" target="_blank" class="left"><?=$aktar->url_to;?></a>
                                        <br />
										<?=$aktar->anchor;?>
                                    </div>
                                </td>
                                <td class="brd_none">
                                    <div class="text align-right"><?=ahrefstarih($aktar->first_seen);?></div>
                                    <div class="text bold align-right">
                                        <?=ahrefstarih($aktar->last_visited);?>
                                    </div>
                                </td>
                            </tr>
						<?php
							
							$i++;
						}
					
				if($goster == 1){
						?>

                        </tbody>
					
                </table>
                </div>
				
                <div class="pagination clearfix">
                    <div class="export right">
                        <a href="javascript:void(0)" onclick="sorgu2(<?=$id?>, 'backlinklost', <?=$sayfa?>, <?=$i?>)" class="green left">DEVAMINI YÜKLE</a>
                    </div>
                </div>
	<?php
			} // end i
	
	} // end backlinklost


	if($islem == "referinglost"){
	
		$sayfa = $_POST["sayfa"];
		$adet = $_POST["data"];
		
		$adet = intval($adet);
		$sayfa = intval($sayfa);
		if(!$sayfa) $sayfa = 1;
		$limit = 30;
		
		if(!is_numeric($sayfa) or !is_numeric($adet)) die("hatadir");
		
		$sayfa--;
		
		$offset = $sayfa * $limit;
		
		$toplamsayfa = ceil($adet/$limit);
		
		$sayfa = $sayfa + 2;
		
		$i = $adet;
		
		$goster = 1;
		
		
		if($i < 2){
		
			
	?>
               <div class="table-sort">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="brd_none"></td>
                                <td colspan="2">
                                    <div class="text">Ref Domain</div>
                                </td>
                                <td>
                                    <div class="text">Ref Domain TOP</div>
                                </td>
                                <td>
                                    <div class="text">Domain Rating</div>
                                </td>
                                <td>
                                    <div class="text">Tarih</div>
                                </td>
                            </tr>
                        </thead>
						<tbody id="devaminiyukle">
		<?php
			}
			else {
				$goster = 0;
			}
		?>
                        
						<?php
						
						if(!$tip) $tip = "domain";
						$suan = @mktime();
												
						$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='referinglost' and sayfa='$sayfa' and kayit > $suan");

						if(@mysql_num_rows($cache) >= 1){
													
							list($cek) = @mysql_fetch_row($cache);

						}
						else {

							$cachetime = $suan + (60*60*24*7);
							
							@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='referinglost' and sayfa='$sayfa' and kayit < $suan");
							
							$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=refdomains_new_lost&target=".$domain."&mode=".$tip."&where=type%3A%22lost%22&limit=30&output=json");
							
							@mysql_query("insert into cache values('$domain', '$tip', 'referinglost', '$sayfa', '".addslashes($cek)."', '$cachetime')");
													
						}
						

						$don = json_decode($cek);

						foreach($don->refdomains as $aktar){
						
							
						
						?>
                            <tr>
                                <td class="number brd_none"><?=$i?></td>
                                <td class="clearfix brd_none">
                                    <div>
                                        <div class="link clearfix">
                                            <a href="http://<?=$aktar->refdomain;?>" target="_blank" title="<?=$aktar->refdomain;?>" class="left"><?=$aktar->refdomain;?></a>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="link align-center">&nbsp;</div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->refdomain_top;?></div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->domain_rating;?></div>
                                </td>
                                <td class="brd_none">
                                    <div class="text align-right"><?=$aktar->date;?></div>
                                </td>
                            </tr>
						<?php
							
							$i++;
						}
					
				if($goster == 1){
						?>

                        </tbody>
					
                </table>
                </div>
				
                <div class="pagination clearfix">
                    <div class="export right">
                        <a href="javascript:void(0)" onclick="sorgu2(<?=$id?>, 'referinglost', <?=$sayfa?>, <?=$i?>)" class="green left">DEVAMINI YÜKLE</a>
                    </div>
                </div>
	<?php
			} // end i
	
	} // end referinglost

	if($islem == "referingnew"){
	
		$sayfa = $_POST["sayfa"];
		$adet = $_POST["data"];
		
		$adet = intval($adet);
		$sayfa = intval($sayfa);
		if(!$sayfa) $sayfa = 1;
		$limit = 30;
		
		if(!is_numeric($sayfa) or !is_numeric($adet)) die("hatadir");
		
		$sayfa--;
		
		$offset = $sayfa * $limit;
		
		$toplamsayfa = ceil($adet/$limit);
		
		$sayfa = $sayfa + 2;
		
		$i = $adet;
		
		$goster = 1;
		
		
		if($i < 2){
		
			
	?>
               <div class="table-sort">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="brd_none"></td>
                                <td colspan="2">
                                    <div class="text">Ref Domain</div>
                                </td>
                                <td>
                                    <div class="text">Ref Domain TOP</div>
                                </td>
                                <td>
                                    <div class="text">Domain Rating</div>
                                </td>
                                <td>
                                    <div class="text">Tarih</div>
                                </td>
                            </tr>
                        </thead>
						<tbody id="devaminiyukle">
		<?php
			}
			else {
				$goster = 0;
			}
		?>
                        
						<?php
						
						if(!$tip) $tip = "domain";
						$suan = @mktime();
												
						$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='referingnew' and sayfa='$sayfa' and kayit > $suan");

						if(@mysql_num_rows($cache) >= 1){
													
							list($cek) = @mysql_fetch_row($cache);

						}
						else {

							$cachetime = $suan + (60*60*24*7);
							
							@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='referingnew' and sayfa='$sayfa' and kayit < $suan");
							
							$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=refdomains_new_lost&target=".$domain."&mode=".$tip."&where=type%3A%22new%22&limit=30&output=json");
							
							@mysql_query("insert into cache values('$domain', '$tip', 'referingnew', '$sayfa', '".addslashes($cek)."', '$cachetime')");
													
						}
						

						$don = json_decode($cek);

						foreach($don->refdomains as $aktar){
						
							
						
						?>
                            <tr>
                                <td class="number brd_none"><?=$i?></td>
                                <td class="clearfix brd_none">
                                    <div>
                                        <div class="link clearfix">
                                            <a href="http://<?=$aktar->refdomain;?>" target="_blank" title="<?=$aktar->refdomain;?>" class="left"><?=$aktar->refdomain;?></a>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="link align-center">&nbsp;</div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->refdomain_top;?></div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->domain_rating;?></div>
                                </td>
                                <td class="brd_none">
                                    <div class="text align-right"><?=$aktar->date;?></div>
                                </td>
                            </tr>
						<?php
							
							$i++;
						}
					
				if($goster == 1){
						?>

                        </tbody>
					
                </table>
                </div>
				
                <div class="pagination clearfix">
                    <div class="export right">
                        <a href="javascript:void(0)" onclick="sorgu2(<?=$id?>, 'referingnew', <?=$sayfa?>, <?=$i?>)" class="green left">DEVAMINI YÜKLE</a>
                    </div>
                </div>
	<?php
			} // end i
	
	} // end referingnew
	
	if($islem == "refering"){
	
		$sayfa = $_POST["sayfa"];
		$adet = $_POST["data"];
		
		$adet = intval($adet);
		$sayfa = intval($sayfa);
		if(!$sayfa) $sayfa = 1;
		$limit = 30;
		
		if(!is_numeric($sayfa) or !is_numeric($adet)) die("hatadir");
		
		$sayfa--;
		
		$offset = $sayfa * $limit;
		
		$toplamsayfa = ceil($adet/$limit);
		
		
	?>
                <div class="pagination clearfix">
                    <div class="paging left">
                        <span class="left"><?=($sayfa+1);?> - <?=$toplamsayfa?> Sayfa, <?=$adet?> adet ref domain bulunuyor</span>
                        <ul class="right">
						<?php
							$pg = $sayfa + 1;	
							
							if($pg != 1) echo '<li><a href="javascript:void(0)" onclick="sorgu('.$id.', \'refering\', 1, '.$adet.')"><<</a></li>';
								for($j = ($pg - 4); $j <= ($pg + 4); $j++){

									if($j >=1 and $j <= $toplamsayfa){
									
										if($j == $pg) echo '<li class="active"><a href="javascript:void(0)" onclick="sorgu('.$id.', \'refering\', '.$j.', '.$adet.')">'.$j.'</a></li>';
										else echo '<li><a href="javascript:void(0)" onclick="sorgu('.$id.', \'refering\', '.$j.', '.$adet.')">'.$j.'</a></li>';
								
									}
								}
							if($pg != $toplamsayfa) echo '<li><a href="javascript:void(0)" onclick="sorgu('.$id.', \'refering\', '.$toplamsayfa.', '.$adet.')">>></a></li>';
						?>
                        </ul>
                    </div>
                    <div class="export right">
                        <a href="javascript:void(0)" class="green left">EXPORT</a>
                        <a href="javascript:void(0)" class="blue left">
                            <img src="Assets/Img/exportlink.png" /></a>
                    </div>
                </div>
               <div class="table-sort">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="brd_none"></td>
                                <td colspan="2">
                                    <div class="text">Ref Domain</div>
                                </td>
                                <td>
                                    <div class="text">Backlink</div>
                                </td>
                                <td>
                                    <div class="text">Ref Pages</div>
                                </td>
                                <td>
                                    <div class="text">Domain Rating</div>
                                </td>
                                <td>
                                    <div class="text">İlk Görülme<br />Son Görülme</div>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
						<?php
						
						if(!$tip) $tip = "domain";
						$suan = @mktime();
												
						$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='refering' and sayfa='$sayfa' and kayit > $suan");

						if(@mysql_num_rows($cache) >= 1){
													
							list($cek) = @mysql_fetch_row($cache);
								
						}
						else {

							$cachetime = $suan + (60*60*24*7);
							
							@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='refering' and sayfa='$sayfa' and kayit < $suan");
							
							$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=refdomains&target=".$domain."&mode=".$tip."&limit=30&output=json");
							
							@mysql_query("insert into cache values('$domain', '$tip', 'refering', '$sayfa', '".addslashes($cek)."', '$cachetime')");
													
						}
						

						$don = json_decode($cek);
						$i = $offset;
						$i++;
						foreach($don->refdomains as $aktar){
						
							
						
						?>
                            <tr>
                                <td class="number brd_none"><?=$i?></td>
                                <td class="clearfix brd_none">
                                    <div>
                                        <div class="link clearfix">
                                            <a href="http://<?=$aktar->refdomain;?>" target="_blank" title="<?=$aktar->refdomain;?>" class="left"><?=$aktar->refdomain;?></a>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="link align-center">&nbsp;</div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->backlinks;?></div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->refpages;?></div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->domain_rating;?></div>
                                </td>
                                <td class="brd_none">
                                    <div class="text align-right"><?=ahrefstarih($aktar->first_seen);?></div>
                                    <div class="text bold align-right">
                                        <?=ahrefstarih($aktar->last_visited);?>
                                    </div>
                                </td>
                            </tr>
						<?php
							
							$i++;
						}
						
						?>

                        </tbody>
                    </table>
                </div>
	<?php
	
	} // end refering

	if($islem == "refips"){
	
		$sayfa = $_POST["sayfa"];
		$adet = $_POST["data"];
		
		$adet = intval($adet);
		$sayfa = intval($sayfa);
		if(!$sayfa) $sayfa = 1;
		$limit = 30;
		
		if(!is_numeric($sayfa) or !is_numeric($adet)) die("hatadir");
		
		$sayfa--;
		
		$offset = $sayfa * $limit;
		
		$toplamsayfa = ceil($adet/$limit);
		
		
		
	?>
                <div class="pagination clearfix">
                    <div class="paging left">
                        <span class="left"><?=($sayfa+1);?> - <?=$toplamsayfa?> Sayfa, <?=$adet?> adet ref IPs bulunuyor</span>
                        <ul class="right">
						<?php
							$pg = $sayfa + 1;	
							
							if($pg != 1) echo '<li><a href="javascript:void(0)" onclick="sorgu('.$id.', \'refips\', 1, '.$adet.')"><<</a></li>';
								for($j = ($pg - 4); $j <= ($pg + 4); $j++){

									if($j >=1 and $j <= $toplamsayfa){
									
										if($j == $pg) echo '<li class="active"><a href="javascript:void(0)" onclick="sorgu('.$id.', \'refips\', '.$j.', '.$adet.')">'.$j.'</a></li>';
										else echo '<li><a href="javascript:void(0)" onclick="sorgu('.$id.', \'refips\', '.$j.', '.$adet.')">'.$j.'</a></li>';
								
									}
								}
							if($pg != $toplamsayfa) echo '<li><a href="javascript:void(0)" onclick="sorgu('.$id.', \'refips\', '.$toplamsayfa.', '.$adet.')">>></a></li>';
						?>
                        </ul>
                    </div>
                    <div class="export right">
                        <a href="javascript:void(0)" class="green left">EXPORT</a>
                        <a href="javascript:void(0)" class="blue left">
                            <img src="Assets/Img/exportlink.png" /></a>
                    </div>
                </div>
               <div class="table-sort">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="brd_none"></td>
                                <td colspan="2">
                                    <div class="text">Ref Domain</div>
                                </td>
                                <td>
                                    <div class="text">Ref IP</div>
                                </td>
                                <td>
                                    <div class="text">Backlinks</div>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
						<?php
						
						if(!$tip) $tip = "domain";
						$suan = @mktime();
												
						$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='refips' and sayfa='$sayfa' and kayit > $suan");

						if(@mysql_num_rows($cache) >= 1){
													
							list($cek) = @mysql_fetch_row($cache);

						}
						else {

							$cachetime = $suan + (60*60*24*7);
							
							@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='refips' and sayfa='$sayfa' and kayit < $suan");
							
							$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=refips&target=".$domain."&mode=".$tip."&limit=30&output=json");
							
							@mysql_query("insert into cache values('$domain', '$tip', 'refips', '$sayfa', '".addslashes($cek)."', '$cachetime')");
													
						}
						

						$don = json_decode($cek);
						$i = $offset;
						$i++;
						foreach($don->refips as $aktar){
						
							
						
						?>
                            <tr>
                                <td class="number brd_none"><?=$i?></td>
                                <td class="clearfix brd_none">
                                    <div>
                                        <div class="link clearfix">
                                            <a href="http://<?=$aktar->refdomain;?>" target="_blank" title="<?=$aktar->refdomain;?>" class="left"><?=$aktar->refdomain;?></a>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="link align-center">&nbsp;</div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->refip;?></div>
                                </td>
                                <td class="brd_none">
                                    <div class="text align-right"><?=$aktar->backlinks;?></div>
                                </td>
                            </tr>
						<?php
							
							$i++;
						}
						
						?>

                        </tbody>
                    </table>
                </div>
	<?php
	
	} // end refips

	if($islem == "linkeddomain"){
	
		$sayfa = $_POST["sayfa"];
		$adet = $_POST["data"];
		
		$adet = intval($adet);
		$sayfa = intval($sayfa);
		if(!$sayfa) $sayfa = 1;
		$limit = 30;
		
		if(!is_numeric($sayfa) or !is_numeric($adet)) die("hatadir");
		
		$sayfa--;
		
		$offset = $sayfa * $limit;
		
		$toplamsayfa = ceil($adet/$limit);
		
		$sayfa = $sayfa + 2;
		
		$i = $adet;
		
		$goster = 1;
		
		
		if($i < 2){
		
			
	?>
               <div class="table-sort">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="brd_none"></td>
                                <td colspan="2">
                                    <div class="text">Domain</div>
                                </td>
                                <td>
                                    <div class="text">Domain Rating</div>
                                </td>
                                <td>
                                    <div class="text">Link Adet</div>
                                </td>
                                <td>
                                    <div class="text">Unique Pages</div>
                                </td>
                            </tr>
                        </thead>
						<tbody id="devaminiyukle">
		<?php
			}
			else {
				$goster = 0;
			}
		?>
                        
						<?php
						if(!$tip) $tip = "domain";
						$suan = @mktime();
												
						$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='linkeddomain' and sayfa='$sayfa' and kayit > $suan");

						if(@mysql_num_rows($cache) >= 1){
													
							list($cek) = @mysql_fetch_row($cache);

						}
						else {

							$cachetime = $suan + (60*60*24*7);
							
							@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='linkeddomain' and sayfa='$sayfa' and kayit < $suan");
							
							$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=linked_domains&target=".$domain."&mode=".$tip."&offset=".$offset."&order_by=domain_from%3Adesc&limit=30&output=json");
							
							@mysql_query("insert into cache values('$domain', '$tip', 'linkeddomain', '$sayfa', '".addslashes($cek)."', '$cachetime')");
													
						}	
						

						$don = json_decode($cek);

						foreach($don->domains as $aktar){
						
							
						
						?>
                            <tr>
                                <td class="number brd_none"><?=$i?></td>
                                <td class="clearfix brd_none">
                                    <div>
                                        <div class="link clearfix">
                                            <a href="http://<?=$aktar->domain_to;?>" target="_blank" title="<?=$aktar->domain_to;?>" class="left"><?=$aktar->domain_to;?></a>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="link align-center">&nbsp;</div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->domain_to_rating;?></div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->links;?></div>
                                </td>
                                <td class="brd_none">
                                    <div class="text align-right"><?=$aktar->unique_pages;?></div>
                                </td>
                            </tr>
						<?php
							
							$i++;
						}
					
				if($goster == 1){
						?>

                        </tbody>
					
                </table>
                </div>
				
                <div class="pagination clearfix">
                    <div class="export right">
                        <a href="javascript:void(0)" onclick="sorgu2(<?=$id?>, 'linkeddomain', <?=$sayfa?>, <?=$i?>)" class="green left">DEVAMINI YÜKLE</a>
                    </div>
                </div>
	<?php
			} // end i
	
	} // end linkeddomain

	if($islem == "linkedanchor"){
	
		$sayfa = $_POST["sayfa"];
		$adet = $_POST["data"];
		
		$adet = intval($adet);
		$sayfa = intval($sayfa);
		if(!$sayfa) $sayfa = 1;
		$limit = 30;
		
		if(!is_numeric($sayfa) or !is_numeric($adet)) die("hatadir");
		
		$sayfa--;
		
		$offset = $sayfa * $limit;
		
		$toplamsayfa = ceil($adet/$limit);
		
		$sayfa = $sayfa + 2;
		
		$i = $adet;
		
		$goster = 1;
		
		
		if($i < 2){
		
			
	?>
	
               <div class="table-sort">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="brd_none"></td>
                                <td colspan="2">
                                    <div class="text">Anchor</div>
                                </td>
                                <td>
                                    <div class="text">External Link</div>
                                </td>
                                <td>
                                    <div class="text">Internal Link</div>
                                </td>
                            </tr>
                        </thead>
						<tbody id="devaminiyukle">
		<?php
			}
			else {
				$goster = 0;
			}
		?>
                        
						<?php
						
						if(!$tip) $tip = "domain";
						$suan = @mktime();
												
						$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='linkedanchor' and sayfa='$sayfa' and kayit > $suan");

						if(@mysql_num_rows($cache) >= 1){
													
							list($cek) = @mysql_fetch_row($cache);
								
						}
						else {

							$cachetime = $suan + (60*60*24*7);
							
							@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='linkedanchor' and sayfa='$sayfa' and kayit < $suan");
							
							$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=linked_anchors&target=".$domain."&mode=".$tip."&offset=".$offset."&order_by=links_external%3Adesc&limit=30&output=json");
							
							@mysql_query("insert into cache values('$domain', '$tip', 'linkedanchor', '$sayfa', '".addslashes($cek)."', '$cachetime')");
													
						}	
						

						$don = json_decode($cek);

						foreach($don->anchors as $aktar){
						
							
						
						?>
                            <tr>
                                <td class="number brd_none"><?=$i?></td>
                                <td class="clearfix brd_none">
                                    <div>
                                        <div class="link clearfix">
                                            <?php
												if($aktar->anchor) echo $aktar->anchor;
												else echo "no-text";
											?>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="link align-center">&nbsp;</div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->links_external;?></div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->links_internal;?></div>
                                </td>
                            </tr>
						<?php
							
							$i++;
						}
					
				if($goster == 1){
						?>

                        </tbody>
					
                </table>
                </div>
				
                <div class="pagination clearfix">
                    <div class="export right">
                        <a href="javascript:void(0)" onclick="sorgu2(<?=$id?>, 'linkedanchor', <?=$sayfa?>, <?=$i?>)" class="green left">DEVAMINI YÜKLE</a>
                    </div>
                </div>
	<?php
			} // end i
	
	} // end linkedanchor

	if($islem == "linkbroken"){
	
		$sayfa = $_POST["sayfa"];
		$adet = $_POST["data"];
		
		$adet = intval($adet);
		$sayfa = intval($sayfa);
		if(!$sayfa) $sayfa = 1;
		$limit = 30;
		
		if(!is_numeric($sayfa) or !is_numeric($adet)) die("hatadir");
		
		$sayfa--;
		
		$offset = $sayfa * $limit;
		
		$toplamsayfa = ceil($adet/$limit);
		
		$sayfa = $sayfa + 2;
		
		$i = $adet;
		
		$goster = 1;
		
		
		if($i < 2){
		
			
	?>
	
               <div class="table-sort">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="brd_none"></td>
                                <td colspan="2" width="250">
                                    <div class="text">Başlık<br />Url</div>
                                </td>
                                <td>
                                    <div class="text">Rank</div>
                                </td>
                                <td>
                                    <div class="text">Son Görülme</div>
                                </td>
                            </tr>
                        </thead>
						<tbody id="devaminiyukle">
		<?php
			}
			else {
				$goster = 0;
			}
		?>
                        
						<?php
						
						if(!$tip) $tip = "domain";
						$suan = @mktime();
												
						$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='linkbroken' and sayfa='$sayfa' and kayit > $suan");

						if(@mysql_num_rows($cache) >= 1){
													
							list($cek) = @mysql_fetch_row($cache);
								
						}
						else {

							$cachetime = $suan + (60*60*24*7);
							
							@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='linkbroken' and sayfa='$sayfa' and kayit < $suan");
							
							$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=pages&target=".$domain."&mode=".$tip."&offset=".$offset."&where=http_code%3A404&limit=30&output=json");
							
							@mysql_query("insert into cache values('$domain', '$tip', 'linkbroken', '$sayfa', '".addslashes($cek)."', '$cachetime')");
													
						}	
						
						$don = json_decode($cek);

						
						foreach($don->pages as $aktar){
						
							
						
						?>
                            <tr>
                                <td class="number brd_none"><?=$i?></td>
                                <td class="clearfix brd_none">
                                    <div>
                                        <div class="text"><?=kisaltma($aktar->title);?></div>
                                        <div class="link clearfix">
                                            <a href="<?=$aktar->url;?>" target="_blank" title="<?=$aktar->url;?>" class="left"><?=$aktar->url;?></a>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="link align-center">&nbsp;</div>
                                </td>
                                <td>
                                    <div class="link align-center"><?=$aktar->ahrefs_rank;?></div>
                                </td>
                                <td class="brd_none">
                                    <div class="text bold align-right">
                                        <?=ahrefstarih($aktar->last_visited);?>
                                    </div>
                                </td>
                            </tr>
						<?php
							
							$i++;
						}
					
				if($goster == 1){
						?>

                        </tbody>
					
                </table>
                </div>
				
                <div class="pagination clearfix">
                    <div class="export right">
                        <a href="javascript:void(0)" onclick="sorgu2(<?=$id?>, 'linkbroken', <?=$sayfa?>, <?=$i?>)" class="green left">DEVAMINI YÜKLE</a>
                    </div>
                </div>
	<?php
			} // end i
	
	} // end linkbroken	
	
} // end uyedurum
else {
	die("hata");
}
?>