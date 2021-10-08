<?php

namespace App\Helpers;

use Route;
use Request;

class UrlHelper {
	public static function activeNav($navs = []){
		$current = session('active_nav');
		if(!empty($current)){
			foreach ($navs as $nav) {
				if($current == $nav)
					return 'active';
			}
		} else {
			foreach ($navs as $nav) {
				if(Route::current()->uri == $nav)
					return 'active';
			}
		}

		return '';
	}

	public static function setActiveNav($nav){
		session('active_nav', $nav);
	}
}