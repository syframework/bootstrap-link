<?php
namespace Sy\Bootstrap\Component\Link;

use Sy\Bootstrap\Component\Icon;

class Div extends \Sy\Component\WebComponent {

	private $links;

	private $isEdition;

	public function __construct($id, $isEdition = false) {
		parent::__construct();
		$service = \Project\Service\Container::getInstance();
		$this->links = $service->link->retrieveAll(['WHERE' => ['tag' => $id]]);
		$this->isEdition = $isEdition;

		$this->mount(function () {
			$this->init();
		});
	}

	public function isEmpty() {
		return empty($this->links);
	}

	private function init() {
		$this->addTranslator(LANG_DIR);
		$this->setTemplateFile(__DIR__ . '/Div.html');

		$fa = [
			'website'      => ['title' => $this->_('Website'), 'icon' => 'globe'],
			'facebook'     => ['title' => 'Facebook',          'icon' => 'facebook-f'],
			'instagram'    => ['title' => 'Instagram',         'icon' => 'instagram'],
			'twitter'      => ['title' => 'Twitter',           'icon' => 'twitter'],
			'youtube'      => ['title' => 'Youtube',           'icon' => 'youtube'],
			'vine'         => ['title' => 'Vine',              'icon' => 'vine'],
			'tumblr'       => ['title' => 'Tumblr',            'icon' => 'tumblr'],
			'android'      => ['title' => 'Android',           'icon' => 'android'],
			'apple'        => ['title' => 'Apple',             'icon' => 'apple'],
			'tripadvisor'  => ['title' => 'Tripadvisor',       'icon' => 'tripadvisor'],
			'yelp'         => ['title' => 'Yelp',              'icon' => 'yelp'],
			'pinterest'    => ['title' => 'Pinterest',         'icon' => 'pinterest'],
			'amazon'       => ['title' => 'Amazon',            'icon' => 'amazon'],
			'etsy'         => ['title' => 'Etsy',              'icon' => 'etsy'],
			'foursquare'   => ['title' => 'Foursquare',        'icon' => 'foursquare'],
			'linkedin'     => ['title' => 'LinkedIn',          'icon' => 'linkedin'],
			'snapchat'     => ['title' => 'Snapchat',          'icon' => 'snapchat'],
			'twitch'       => ['title' => 'Twitch',            'icon' => 'twitch'],
			'viadeo'       => ['title' => 'Viadeo',            'icon' => 'viadeo'],
			'vimeo'        => ['title' => 'Vimeo',             'icon' => 'vimeo'],
			'airbnb'       => ['title' => 'Airbnb',            'icon' => 'airbnb'],
			'blogger'      => ['title' => 'Blogger',           'icon' => 'blogger'],
			'discord'      => ['title' => 'Discord',           'icon' => 'discord'],
			'github'       => ['title' => 'Github',            'icon' => 'github'],
			'whatsapp'     => ['title' => 'Whatsapp',          'icon' => 'whatsapp'],
			'telegram'     => ['title' => 'Telegram',          'icon' => 'telegram'],
			'tiktok'       => ['title' => 'Tik Tok',           'icon' => 'tiktok'],
		];

		foreach ($this->links as $link) {
			$this->setVars([
				'ID'    => $link['icon'],
				'ICON'  => new Icon($fa[$link['icon']]['icon'], ['icon-style' => 'brands']),
				'URL'   => $link['url'],
				'TITLE' => $fa[$link['icon']]['title'],
				'PROP'  => $link['icon'] === 'website' ? 'itemprop="url"' : '',
			]);
			if ($this->isEdition) {
				$this->setVars([
					'INPUT_GROUP' => 'input-group mb-1',
				]);
				$this->setComponent('DELETE', new Delete($link['id']));
				$this->setBlock('DELETE_BLOCK');
			}
			$this->setBlock('LINK_BLOCK');
		}
	}

}