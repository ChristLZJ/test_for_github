<?php
function getfoot(){
	if(of_get('footer')){
		echo ' - ';
	}
	echo '<a href="http://qzhai.net" target="_black"> 衫小寨</a> 出品';
}