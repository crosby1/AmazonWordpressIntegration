<?php
    /**
     * Class to access Amazons Product Advertising API
     * @author Sameer Borate
     * @link http://www.codediesel.com
     * @version 1.0
     * All requests are not implemented here. You can easily
     * implement the others from the ones given below.
     */
    
    
    /*
    Permission is hereby granted, free of charge, to any person obtaining a
    copy of this software and associated documentation files (the "Software"),
    to deal in the Software without restriction, including without limitation
    the rights to use, copy, modify, merge, publish, distribute, sublicense,
    and/or sell copies of the Software, and to permit persons to whom the
    Software is furnished to do so, subject to the following conditions:
    
    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.
    
    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
    THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
    FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
    DEALINGS IN THE SOFTWARE.
    */
    
    require_once 'aws_signed_request.php';
		
    class AmazonProductAPI
    {
	
		private $options;
		
		private $publicKey;
		private $secretKey;
		private $associateKey;
		
		function __construct()
		{
			$this->options 			= get_option('wonderfullstores_aws_options');
			
			$this->publicKey 		= $this->options['wonderfullstores_access_key'];
			$this->secretKey 		= $this->options['wonderfullstores_secret_key'];
			$this->associateKey 	= $this->options['wonderfullstores_associate_key'];
			
		}
        
        /*
            Only three categories are listed here. 
            More categories can be found here:
            http://docs.amazonwebservices.com/AWSECommerceService/latest/DG/APPNDX_SearchIndexValues.html
        */
        public function getAssTag()
		{
			return $this->associateKey;
		}
		
		const MUSIC 				= "Music";
        const DVD   				= "DVD";
        const GAMES 				= "VideoGames";
		const BOOKS 				= "Books";
		const APPAREL 				= "Apparel";
		const AUTOMOTIVE 			= "Automotive";
		const ELECTRONICS		 	= "Electronics";
		const GOURMETFOOD 			= "GourmetFood";
		const KITCHEN 				= "Kitchen";
		const PCHARDWARE 			= "PCHardware";
		const PETSUPPLIES 			= "PetSupplies";
		const SOFTWARE 				= "Software";
		const SOFTWAREVIDEOGAMES 	= "SoftwareVideogames";
		const SPORTINGGOODS 		= "SportingGoods";
		const TOOLS 				= "Tools";
		const TOYS 					= "Toys";
		const VHS 					= "VHS";
                
        private function verifyXmlResponse($response)
        {
            if ($response === False)
            {
                throw new Exception("Could not connect to Amazon");
            }
            else
            {
                if (isset($response))
                {
                    return ($response);
                }
                else
                {
                    throw new Exception("Invalid, Please check your Access Key, Security Key and Associate Key.");
                }
            }
        }
        
        
        /**
         * Query Amazon with the issued parameters
         * 
         * @param array $parameters parameters to query around
         * @return simpleXmlObject xml query response
         */

        private function queryAmazon($parameters)
        {
            return aws_signed_request("com", $parameters, $this->publicKey, $this->secretKey, $this->associateKey);
        }
        
        
        public function getItemByKeyword($keyword, $product_type)
        {
            $parameters = array("Operation"  	 	=> "ItemSearch",
                                "Keywords"    		=> $keyword,
                                "SearchIndex" 		=> $product_type,
								"ResponseGroup" 	=> "Large");
                                
            $xml_response = $this->queryAmazon($parameters);
            
            return $this->verifyXmlResponse($xml_response);
        }

		/**
         * Return details of products searched by various types
         * 
         * @param string $search search term
         * @param string $category search category         
         * @param string $searchType type of search
         * @return mixed simpleXML object
         */
        public function searchProducts($search, $category, $searchType = "UPC")
        {
            $allowedTypes = array("UPC", "TITLE", "ARTIST", "KEYWORD");
            $allowedCategories = array("Music", "DVD", "VideoGames");
            
            switch($searchType) 
            {
                case "UPC" :    $parameters = array("Operation"     => "ItemLookup",
                                                    "ItemId"        => $search,
                                                    "SearchIndex"   => $category,
                                                    "IdType"        => "UPC",
                                                    "ResponseGroup" => "Large");
                                break;
                
                case "TITLE" :  $parameters = array("Operation"     => "ItemSearch",
                                                    "Title"         => $search,
                                                    "SearchIndex"   => $category,
                                                    "ResponseGroup" => "Large");
                                break;
            
            }
            
            $xml_response = $this->queryAmazon($parameters);
            
            return $this->verifyXmlResponse($xml_response);

        }
        
        
        /**
         * Return details of a product searched by UPC
         * 
         * @param int $upc_code UPC code of the product to search
         * @param string $product_type type of the product
         * @return mixed simpleXML object
         */
        public function getItemByUpc($upc_code, $product_type)
        {
            $parameters = array("Operation"     => "ItemLookup",
                                "ItemId"        => $upc_code,
                                "SearchIndex"   => $product_type,
                                "IdType"        => "UPC",
                                "ResponseGroup" => "Medium");
                                
            $xml_response = $this->queryAmazon($parameters);
            
            return $this->verifyXmlResponse($xml_response);

        }
        
        
        /**
         * Return details of a product searched by ASIN
         * 
         * @param int $asin_code ASIN code of the product to search
         * @return mixed simpleXML object
         */
        public function getItemByAsin($asin_code)
        {
            $parameters = array("Operation"     => "ItemLookup",
                                "ItemId"        => $asin_code,
                                "ResponseGroup" => "Large");
                                
            $xml_response = $this->queryAmazon($parameters);
            
            return $this->verifyXmlResponse($xml_response);
        }
        
    }

?>
