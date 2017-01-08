<?php
class SaleTerminal {

	private $product_prices;
	private $offer_prices = array();
	private $product_count = array('A'=>0, 'B'=>0, 'C'=>0, 'D'=>0);
	private $free_products;
	
	public function setPricing() {
		$this->product_prices['A'] = 2;
		$this->product_prices['B'] = 12;
		$this->product_prices['C'] = 1.25;
		$this->product_prices['D'] = 0.15;

		$this->offer_prices['A'] = array('qty'=>4, 'price'=>7);
		$this->offer_prices['C'] = array('qty'=>6, 'price'=>6);
	}

	/*
	 *  Increments the count of respective product
	 *  In case product is not on list, we put it in free product array
	 */
	public function scan($pcode) {
		if(in_array($pcode, array_keys($this->product_count))) {
			$this->product_count[$pcode]++;
		}else {
			$this->free_products[] = $pcode;
		}
	}

	/*
	 *  Returns: array consisting individual product cost, free products and net total price of scanned products.
	 */
	public function total() {
		$net_total = 0;
		$product_total = array();
		
		foreach($this->product_count AS $code=>$count) {
			if($count == 0) continue;
			
			if(in_array($code, array_keys($this->offer_prices)) AND $count >= $this->offer_prices[$code]['qty']) {
				$offer_cost = $this->offer_prices[$code]['price']*floor($count/$this->offer_prices[$code]['qty']); // offer price X number of offers applicable
				$rest_cost  = $this->product_prices[$code]*($count%$this->offer_prices[$code]['qty']); // price of product not coming under offer
				
				$product_total[$code] = number_format($offer_cost + $rest_cost, 2);
			}else {
				$product_total[$code] = number_format($this->product_prices[$code]*$count, 2); // non offer product price
			}
			$net_total += $product_total[$code]; // total price
		}

		return array($product_total, number_format($net_total, 2), $this->free_products);
	}
}