# sy/bootstrap-link

[sy/bootstrap](https://github.com/syframework/bootstrap) plugin for adding social media link component in your [sy/project](https://github.com/syframework/project) based application.

## Installation

```bash
$ composer require sy/bootstrap-link
```

## Database

Use the database installation script: ```sql/install.sql```

## CSS

Copy the scss file ```scss/_bootstrap-link.scss``` into your project scss directory: ```protected/scss```

Import it in your ```app.scss``` file and rebuild the css file.

## Add link section in the user account panel

Got to the file: ```protected\src\Component\User\AccountPanel.php```

And add this method in the class:

```php
	public function linkAction() {
		$service = \Project\Service\Container::getInstance();
		$user = $service->user->getCurrentUser();
		$p = new \Sy\Component\Html\Element('p');
		$p->addText($this->_('You can display on your page your web site or social media links'));
		$this->setComponent('NORTH', $p);
		$this->setComponent('CENTER', new \Sy\Bootstrap\Component\Link\Div('user-' . $user->id, true));
		$this->setComponent('SOUTH', new \Sy\Bootstrap\Component\Link\Create('user-' . $user->id));
	}
```