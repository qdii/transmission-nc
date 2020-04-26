<?php

namespace OCA\Transmission\Settings;

use OCP\IL10N;
use OCP\Settings\ISettings;

class Admin implements ISettings {
	/** @var IL10N */
	private $l;

	/**
	 * @param IL10N $l
	 */
	public function __construct(IL10N $l) {
		$this->l = $l;
	}

	/**
	 * @return TemplateResponse
	 */
	public function getForm() {
        $parameters = [];
		return new TemplateResponse('transmission', 'settings', $parameters);
	}

	public function getSection() {
		return 'server';
	}

	public function getPriority() {
		return 100;
	}
}
