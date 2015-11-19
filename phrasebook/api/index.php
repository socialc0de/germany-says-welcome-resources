<?php
require 'vendor/autoload.php';
require 'generated-conf/config.php'; 

$BASE = "de";

$app = new \Slim\Slim();
$app->get('/', function () use ($BASE, $app) {
	$langs = \Base\PhrasebookCategoriesQuery::create()
			->select(array('lang'))
			->distinct()
			->find();
	$body = array();
	foreach( $langs as $lang ) {
		if ( $lang == $BASE )	{ continue; }
		$url = $app->urlFor("lang", array( 'lang' => $lang));
		array_push($body, array($lang => $url));
	}
	
	$body = array('language' => $BASE, 'translations' => $body);
	$app->response->header("content-type", "application/json");
	$app->response->body(json_encode($body, JSON_UNESCAPED_SLASHES));
})->name("root");


$app->get('/:lang', function($lang) use ($BASE, $app) {
	$catsBase = Base\PhrasebookCategoriesQuery::create()
			->filterByLang($BASE)
			->orderBy("id")
			->find();
	$categories = array();
	foreach ($catsBase as $catBase ) {
		$id = $catBase->getId();
		$catLang = Base\PhrasebookCategoriesQuery::create()
				->findOneByIdAndLang($id, $lang);
		if ( $catLang === NULL ) {
			continue;
		}
		array_push($categories, array(
			'id' => $catLang->getId(),
			$BASE => $catBase->getLabel(),
			$lang => $catLang->getLabel(),
			'url' => $app->urlFor("category", array("lang" => $lang, "cat" => $catLang->getId()))
		));		
	}
	$body = array( 'categories' => $categories);
	$app->response->header("content-type", "application/json");
	$app->response->body(json_encode($body, JSON_UNESCAPED_SLASHES));
})->name('lang');

$app->get('/:lang/category/:cat', function($lang, $catId) use ($BASE, $app) {
	$category = Base\PhrasebookCategoriesQuery::create()
			->findOneByIdAndLang($catId, $BASE);
	if ( $category == NULL ) {
		$app->notFound();
		return;
	}
	$baseLabel = $category->getLabel();
	$category = \Base\PhrasebookCategoriesQuery::create()
			->findOneByIdAndLang($catId, $lang);
	if ( $category === NULL ) {
		$app->notFound();
		return;
	}
	$body = array( 'category' => array(
		'id' => $category->getId(),
		'lang' => $category->getLang(),
		'label' => array( $BASE => $baseLabel, $lang => $category->getLabel())
	));
	$app->response->header("content-type", "application/json");
	$app->response->body(json_encode($body, JSON_UNESCAPED_SLASHES));
	
	
})
->name('category');

$app->run();