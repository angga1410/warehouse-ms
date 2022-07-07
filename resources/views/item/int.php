$inventoryList = Inventory::all()->map(function ($i) {
			$i->products;
			$i->warehouse->warehouse;

			return $i;
		});
		$results = array();

		// dd($inventoryList);

		foreach ($inventoryList as $get) {
			$price = PODetail::where('product_id', $get->product_id)->orderBy('created_at', 'desc')->first();
			// dd($price->unit_price);
			if ($price == null) {
				$results[] = [
					'mfr' => $get->products->mfr,
					'part_name' => $get->products->part_name,
					'part_desc' => $get->products->part_desc,
					'part_num' => $get->products->part_num,
					'um' => $get->products->default_um,
					'alt_um' => $get->products->alt_um,
					'ProdID' => $get->products->ProdID,
					'price' => 0,
					'curr' => "",
					// 'do_num' => $qc->reference_do,
					// 'do_date' => date('d-m-Y', strtotime($do->created_at))
				];
			} else {
				$results[] = [
					'mfr' => $get->products->mfr,
					'part_name' => $get->products->part_name,
					'part_desc' => $get->products->part_desc,
					'part_num' => $get->products->part_num,
					'um' => $get->products->default_um,
					'alt_um' => $get->products->alt_um,
					'ProdID' => $get->products->ProdID,
					'price' => $price->unit_price,
					'curr' => $price->curr,
					// 'do_num' => $qc->reference_do,
					// 'do_date' => date('d-m-Y', strtotime($do->created_at))
				];
			}
		}
		// dd($results);

		$datatableRes = new DefaultResponse($results);

		return $datatableRes->getResponse();