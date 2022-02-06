<?php
namespace Sy\Bootstrap\Component\Link;

class Div extends \Sy\Component\WebComponent {

	private $links;
	private $isEdition;

	public function __construct($id, $isEdition = false) {
		parent::__construct();
		$service = \Project\Service\Container::getInstance();
		$this->links = $service->link->retrieveAll(['WHERE' => ['tag' => $id]]);
		$this->isEdition = $isEdition;
	}

	public function __toString() {
		$this->addTranslator(LANG_DIR);
		$this->init();
		return parent::__toString();
	}

	public function isEmpty() {
		return empty($this->links);
	}

	private function init() {
		$this->setTemplateFile(__DIR__ . '/Div.html');

		$fa = [
			'website'      => ['title' => $this->_('Website'), 'icon' => 'fas fa-globe'],
			'facebook'     => ['title' => 'Facebook',          'icon' => 'fab fa-facebook-f'],
			'instagram'    => ['title' => 'Instagram',         'icon' => 'fab fa-instagram'],
			'twitter'      => ['title' => 'Twitter',           'icon' => 'fab fa-twitter'],
			'youtube'      => ['title' => 'Youtube',           'icon' => 'fab fa-youtube'],
			'vine'         => ['title' => 'Vine',              'icon' => 'fab fa-vine'],
			'tumblr'       => ['title' => 'Tumblr',            'icon' => 'fab fa-tumblr'],
			'android'      => ['title' => 'Android',           'icon' => 'fab fa-android'],
			'apple'        => ['title' => 'Apple',             'icon' => 'fab fa-apple'],
			'tripadvisor'  => ['title' => 'Tripadvisor',       'icon' => 'fab fa-tripadvisor'],
			'yelp'         => ['title' => 'Yelp',              'icon' => 'fab fa-yelp'],
			'pinterest'    => ['title' => 'Pinterest',         'icon' => 'fab fa-pinterest'],
			'amazon'       => ['title' => 'Amazon',            'icon' => 'fab fa-amazon'],
			'etsy'         => ['title' => 'Etsy',              'icon' => 'fab fa-etsy'],
			'foursquare'   => ['title' => 'Foursquare',        'icon' => 'fab fa-foursquare'],
			'linkedin'     => ['title' => 'LinkedIn',          'icon' => 'fab fa-linkedin'],
			'snapchat'     => ['title' => 'Snapchat',          'icon' => 'fab fa-snapchat'],
			'twitch'       => ['title' => 'Twitch',            'icon' => 'fab fa-twitch'],
			'viadeo'       => ['title' => 'Viadeo',            'icon' => 'fab fa-viadeo'],
			'vimeo'        => ['title' => 'Vimeo',             'icon' => 'fab fa-vimeo'],
			'airbnb'       => ['title' => 'Airbnb',            'icon' => 'fab fa-airbnb'],
			'blogger'      => ['title' => 'Blogger',           'icon' => 'fab fa-blogger'],
			'discord'      => ['title' => 'Discord',           'icon' => 'fab fa-discord'],
			'github'       => ['title' => 'Github',            'icon' => 'fab fa-github'],
			'whatsapp'     => ['title' => 'Whatsapp',          'icon' => 'fab fa-whatsapp'],
			'telegram'     => ['title' => 'Telegram',          'icon' => 'fab fa-telegram'],
			'tiktok'       => ['title' => 'Tik Tok',           'icon' => 'fab fa-tiktok'],
		];

		foreach ($this->links as $link) {
			$this->setVars([
				'ID'    => $link['icon'],
				'ICON'  => $fa[$link['icon']]['icon'],
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