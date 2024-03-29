<?php
namespace Sy\Bootstrap\Component\Link;

class Delete extends \Sy\Bootstrap\Component\Form\Crud\Delete {

	public function __construct($id) {
		parent::__construct('link', ['id' => $id]);
	}

	public function init() {
		parent::init();

		$this->setAttributes([
			'data-confirm' => $this->_('Are you sure to delete?'),
			'onsubmit'     => "return confirm($('<div />').html($(this).data('confirm')).text())",
		]);
	}

	protected function initButton() {
		$this->addButton('', [
			'type'              => 'submit',
			'title'             => $this->_('Delete link'),
			'data-bs-title'     => $this->_('Delete link'),
			'data-bs-placement' => 'auto right',
			'data-bs-container' => 'body',
			'data-bs-trigger'   => 'hover',
			'style'             => 'border-top-left-radius:0;border-bottom-left-radius:0',
		], [
			'icon'  => 'fas fa-trash-alt',
			'color' => 'danger',
			'size'  => 'sm'
		]);
	}

}
