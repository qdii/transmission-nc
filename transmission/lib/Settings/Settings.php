<?php
namespace OCA\Transmission\Settings;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\Settings\ISettings;

class Settings implements ISettings {

        public function __construct() {
        }

        public function getForm() {
            return new TemplateResponse('transmission', 'settings');
        }

        public function getSection() {
            return 'sharing';
        }

        public function getPriority() {
            return 50;
        }
}
