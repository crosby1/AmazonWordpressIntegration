<?php

// SETTINGS FOR OPTIONS AWS ACCOUNT
function wonderfullstores_aws_text(){

}
function wonderfullstores_access_key()
{
	$options = get_option('wonderfullstores_aws_options');
	echo "<input id='wonderfullstores_access_key' name='wonderfullstores_aws_options[wonderfullstores_access_key]' value='{$options['wonderfullstores_access_key']}' size='50'/>";
}

function wonderfullstores_secret_key()
{
	$options = get_option('wonderfullstores_aws_options');
	echo "<input id='wonderfullstores_secret_key' name='wonderfullstores_aws_options[wonderfullstores_secret_key]' value='{$options['wonderfullstores_secret_key']}' size='50'/>";
}

function wonderfullstores_associate_key()
{
	$options = get_option('wonderfullstores_aws_options');

	echo "<input id='wonderfullstores_associate_key' name='wonderfullstores_aws_options[wonderfullstores_associate_key]' value='{$options['wonderfullstores_associate_key']}' size='25'/>";
}

function wonderfullstores_aws_options_validate($input)
{
	$options = get_option('wonderfullstores_aws_options');
	
	$options['wonderfullstores_access_key']		= trim($input['wonderfullstores_access_key']);
	$options['wonderfullstores_secret_key']		= trim($input['wonderfullstores_secret_key']);
	$options['wonderfullstores_associate_key'] 	= trim($input['wonderfullstores_associate_key']);
	
	return $options;
	
}

// SETTINGS FOR GET ITEM BY KEYWORD

function wonderfullstores_aws_settings_text()
{


}

function wonderfullstores_aws_keyword()
{
	$options = get_option('wonderfullstores_aws_settings');
	echo "<input id='wonderfullstores_aws_keyword' name='wonderfullstores_aws_settings[wonderfullstores_aws_keyword]' value='{$options['wonderfullstores_aws_keyword']}' size='50'/>";
	
}

function wonderfullstores_aws_category()
{
	$options = get_option('wonderfullstores_aws_settings');
	
	echo "
	<select id='wonderfullstores_aws_settings[wonderfullstores_aws_category]' name='wonderfullstores_aws_settings[wonderfullstores_aws_category]'>
      <option value='Blended'>ALL</option>
      <option value='Books'>Books</option>
      <option value='DVD'>DVD</option>
      <option value='Apparel'>Apparel</option>
      <option value='Automotive'>Automotive</option>
      <option value='Electronics'>Electronics</option>
      <option value='GourmetFood'>GourmetFood</option>
      <option value='Kitchen'>Kitchen</option>
      <option value='Music'>Music</option>
      <option value='PCHardware'>PCHardware</option>
      <option value='PetSupplies'>PetSupplies</option>
      <option value='Software'>Software</option>
      <option value='SoftwareVideoGames'>SoftwareVideoGames</option>
      <option value='SportingGoods'>SportingGoods</option>
      <option value='Tools'>Tools</option>
      <option value='Toys'>Toys</option>
      <option value='VHS'>VHS</option>
      <option value='VideoGames'>VideoGames</option>
    </select>
	";

}
/*
function wonderfullstores_aws_country()
{
	$options = get_option('wonderfullstores_aws_settings');
	echo "
	<select id='wonderfullstores_aws_settings[wonderfullstores_aws_country]' name='wonderfullstores_aws_settings[wonderfullstores_aws_country]' >
      <option value='com'>USA</option>
      <option value='de'>DE</option>
	  <option value='co.uk'>ENG</option>
      <option value='ca'>CA</option>
      <option value='fr'>FR</option>
      <option value='co.jp'>JP</option>
      <option value='it'>IT</option>
      <option value='cn'>CN</option>
      <option value='es'>ES</option>
    </select>
	";
	
}
*/
function wonderfullstores_product_display(){
	
	$options = get_option('wonderfullstores_aws_settings');
	echo "
	<select id='wonderfullstores_aws_settings[wonderfullstores_product_display]' name='wonderfullstores_aws_settings[wonderfullstores_product_display]' >
      <option value='9'>1</option>
      <option value='8'>2</option>
	  <option value='7'>3</option>
      <option value='6'>4</option>
      <option value='5'>5</option>
      <option value='4'>6</option>
      <option value='3'>7</option>
      <option value='2'>8</option>
      <option value='1'>9</option>
	  <option value='0'>10</option>
    </select>
	";
}
function wonderfullstores_aws_poststatus(){
	$options = get_option('wonderfullstores_aws_settings');
		echo "
	<select id='wonderfullstores_aws_settings[wonderfullstores_aws_poststatus]' name='wonderfullstores_aws_settings[wonderfullstores_aws_poststatus]' >
      <option value='publish'>Publish</option>
      <option value='draft'>Draft</option>
	</select>
	";
}

function wonderfullstores_post_category(){
	$options = get_option('wonderfullstores_aws_settings');
	
	$args = array('hide_empty' => 0);
	$categories = get_categories($args);
	
	echo "<select id='wonderfullstores_aws_settings[wonderfullstores_post_category]' name='wonderfullstores_aws_settings[wonderfullstores_post_category]'>";
	foreach ($categories as $cat){
	$val = $cat->cat_ID;
	$ct	 = $cat->cat_name;
	echo "<option value='$val'>"."$ct"."</option>";
	}
	echo "</select>";
}

// function wonderfullstores_post_timer(){

	// $options = get_option('wonderfullstores_aws_settings');
	
	
// }

function wonderfullstores_aws_settings_validate($input)
{
	$options = get_option('wonderfullstores_aws_settings');
		
	$options['wonderfullstores_aws_keyword']		= ucwords(trim($input['wonderfullstores_aws_keyword']));
	$options['wonderfullstores_aws_category']		= $input['wonderfullstores_aws_category'];
	//$options['wonderfullstores_aws_country'] 		= $input['wonderfullstores_aws_country'];
	$options['wonderfullstores_aws_poststatus']		= $input['wonderfullstores_aws_poststatus'];
	$options['wonderfullstores_product_display'] 	= $input['wonderfullstores_product_display'];
	$options['wonderfullstores_post_category']		= $input['wonderfullstores_post_category'];
	
	$totalpost		= $options['wonderfullstores_product_display'];
	$poststatus		= $options['wonderfullstores_aws_poststatus'];
	$postcategory 	= $options['wonderfullstores_post_category'];
	
	include('amazon_api_class.php');
	
	$obj = new AmazonProductAPI();
	$assTag = $obj->getAssTag();
	
		try{
			$result = $obj->getItemByKeyword($options['wonderfullstores_aws_keyword'],$options['wonderfullstores_aws_category']);
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
		// var_dump($result);
		// exit();
					$a = $result->Items->Item;
					$b = count($a)-$totalpost;
					$i = 0;
					
			while($i < $b):
			$asin 			= $result->Items->Item[$i]->ASIN;
			$detailURL		= $result->Items->Item[$i]->DetailPageURL;
			$getTitle 		= $result->Items->Item[$i]->ItemAttributes->Title;
			//$titleShorten	= wonderfullstores_shorten_string($getTitle, 50);
			$imageURL		= $result->Items->Item[$i]->ImageSets->ImageSet->MediumImage->URL;
			$image			= "<img style='float: left; margin: 0 20px 10px 0;'src=$imageURL></img>";
			$price			= $result->Items->Item[$i]->Offers->Offer->OfferListing->Price->FormattedPrice;
//			$buyLink		= "http://www.amazon.com/gp/aws/cart/add.html?AssociateTag=$assTag&ASIN.1=$asin&Quantity.1=1";
//			$buttonLink		= get_template_directory_uri().'/images/buynow-big.gif';
//			$buyButton		= "<a href=$buyLink><img src=$buttonLink></a>";
			$er				= $result->Items->Item[$i]->EditorialReviews->EditorialReview->Content;
		
			if($er != null){
				$review 	= $result->Items->Item[$i]->EditorialReviews->EditorialReview->Content;
				}else{
					$review = 'No review available<p/>';			
					}
			
			
			$newPost = array('post_status' 	=> $poststatus, 
					'post_title' 	=> $getTitle, 
					'post_type' 	=> 'post',
					'post_category'	=> array($postcategory),
					'comment_status' => 'open',
					'post_content'	=> $image.'<strong>Price : '.$price.'</strong><p/>'.'<h4>Product Description</h4>'.$review);
			wp_insert_post($newPost);
			
			$i++;
			endwhile;
	// '<input type="hidden" name="assTag" value='.$assTag.'>'.
	// '<input type="hidden" name="asin" value='.$asin.'>'

	return $options;
}
?>