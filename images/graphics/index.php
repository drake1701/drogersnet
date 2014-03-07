<?
/*
 * Graphics Portfolio
 * Dennis Rogers
 * Jan 28, 2009
 */
require_once("../head.php");

$top = scandir(".");
array_shift($top);
array_shift($top);
rsort($top);
foreach($top as $cat){
	if(is_dir($cat)){
?>
	<div class="gallery">
		<h2><?=ucwords($cat)?></h2>
		
<?
		$files = scandir($cat);
		sort($files);
		foreach($files as $file){
			if(eregi("jpg|gif|png", $file)){
?>
		<img src="<?=$cat.'/'.$file?>" alt="<?=$file?>" />
<?
			}
		}
?>
	</div>
<?
	}
}
require_once("../foot.php");
?>
