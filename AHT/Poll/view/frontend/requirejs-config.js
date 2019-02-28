/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
	deps: [
        'AHT_Poll/js/vote'	//Khai báo file để viết js
    ],
  map: {
        "*": {
            "owlslider": "js/owlcarousel/owl.carousel.min"
        }
    },
    paths:  {
        "owlslider" : "js/owlcarousel/owl.carousel.min"    
    },
    "shim": {
		"js/owlcarousel/owl.carousel.min": ["jquery"],
	}
	// deps: [
 //        "Magento_Theme/js/legends",
 //    ]
  
};
 
