<?php
namespace OCA\Transmission\Settings;

use OCA\Transmission\Collector;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\BackgroundJob\IJobList;
use OCP\IConfig;
use OCP\IDateTimeFormatter;
use OCP\IL10N;
use OCP\Settings\ISettings;

class Settings implements ISettings {

        /** @var Collector */
        private $collector;

        /** @var IConfig */
        private $config;

        /** @var IL10N */
        private $l;

        /** @var IDateTimeFormatter */
        private $dateTimeFormatter;

        /** @var IJobList */
        private $jobList;

        /**
         * Admin constructor.
         *
         * @param Collector $collector
         * @param IConfig $config
         * @param IL10N $l
         * @param IDateTimeFormatter $dateTimeFormatter
         * @param IJobList $jobList
         */
        public function __construct(Collector $collector,
                                                                IConfig $config,
                                                                IL10N $l,
                                                                IDateTimeFormatter $dateTimeFormatter,
                                                                IJobList $jobList
        ) {
                $this->collector = $collector;
                $this->config = $config;
                $this->l = $l;
                $this->dateTimeFormatter = $dateTimeFormatter;
                $this->jobList = $jobList;
        }

        /**
         * @return TemplateResponse
         */
        public function getForm() {
            $parameters = [];
            return new TemplateResponse('transmission', 'transmission', $parameters, '');
        }

        public function getSection() {
                return 'sharing';
        }

        /**
         * @return int whether the form should be rather on the top or bottom of
         * the admin section. The forms are arranged in ascending order of the
         * priority values. It is required to return a value between 0 and 100.
         */
        public function getPriority() {
                return 50;
        }

}
