<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class SearchController extends Controller
{
	public function searchResult(Request $request){
		$keyword = $request->input('keyword');
		$pResult = null;
		$nResult = null;
		if($keyword != null){
			$pResult = Post::postSearch($keyword, 3);
		}
		return view('user.pages.search')->with(compact('pResult', 'nResult'));
	}
}
