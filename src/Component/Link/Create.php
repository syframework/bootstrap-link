<?php
namespace Sy\Bootstrap\Component\Link;

class Create extends \Sy\Bootstrap\Component\Form {

	private $id;

	public function __construct($id) {
		parent::__construct();
		$this->id = $id;
	}

	public function init() {
		$this->addCsrfField();

		$this->addUrl([
			'name'        => 'url',
			'required'    => 'required',
			'maxlength'   => 255,
			'placeholder' => 'https://...',
		], [
			'validator' => [
				function($value) {
					if (strlen($value) <= 255) return true;
					$this->setError($this->_('URL is too long'));
					return false;
				},
			],
			'btn-after' => [
				'label' => 'Add',
				'attributes' => ['type' => 'submit'],
				'options' => [
					'color' => 'primary',
					'icon'  => 'plus',
				],
			],
		]);

		// js
		$this->addJsCode(__DIR__ . '/Create.js');
	}

	public function submitAction() {
		try {
			$this->validatePost();
			$service = \Project\Service\Container::getInstance();
			$user = $service->user->getCurrentUser();
			if (!$user->isConnected()) return $this->jsonError(options: ['redirection' => WEB_ROOT . '/']);
			$url = trim($this->post('url'), '/');
			$service->link->change(['tag' => $this->id, 'icon' => $this->getIcon($url), 'url' => $url], ['url' => $url]);
			return $this->jsonSuccess('Link added', ['redirection' => $_SERVER['REQUEST_URI']]);
		} catch (\Sy\Component\Html\Form\Exception $e) {
			$this->logWarning($e);
			return $this->jsonError($this->getOption('error') ?? 'Please fill the form correctly');
		} catch (\Sy\Db\MySql\Exception $e) {
			$this->logWarning($e->getMessage());
			return $this->jsonError('Error');
		}
	}

	private function getIcon($url) {
		$host = parse_url($url, PHP_URL_HOST);
		$icon = 'website';
		$domains = [
			'facebook' => 'facebook',
			'instagram' => 'instagram',
			'twitter' => 'twitter',
			'youtube' => 'youtube',
			'vine' => 'vine',
			'tumblr' => 'tumblr',
			'play.google' => 'android',
			'apple' => 'apple',
			'tripadvisor' => 'tripadvisor',
			'yelp' => 'yelp',
			'pinterest' => 'pinterest',
			'amazon' => 'amazon',
			'etsy' => 'etsy',
			'foursquare' => 'foursquare',
			'linkedin' => 'linkedin',
			'snapchat' => 'snapchat',
			'twitch' => 'twitch',
			'viadeo' => 'viadeo',
			'vimeo' => 'vimeo',
			'airbnb' => 'airbnb',
			'blogger' => 'blogger',
			'discord' => 'discord',
			'github' => 'github',
			'whatsapp' => 'whatsapp',
			't.me' => 'telegram',
			'tiktok' => 'tiktok',
		];
		foreach ($domains as $key => $value) {
			if (strpos($host, $key) === false) continue;
			$icon = $value;
			break;
		}
		return $icon;
	}

}