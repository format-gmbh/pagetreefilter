<?php

declare(strict_types=1);

namespace Lemming\PageTreeFilter\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class BuildFilterViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('wizardInformation', 'array', '', true);
    }

    public function render(): string
    {
        $wizardInformation = $this->arguments['wizardInformation'];
        if (isset($wizardInformation['filter'])) {
            return $wizardInformation['filter'];
        }

        $filter = 'table=tt_content';
        if (isset($wizardInformation['tt_content_defValues'])) {
            foreach ($wizardInformation['tt_content_defValues'] as $field => $value) {
                if (in_array($field, ['CType', 'tx_gridelements_backend_layout'])) {
                    $filter = sprintf('%s %s=%s', $filter, $field, $value);
                }
            }
        }

        return htmlspecialchars($filter, ENT_QUOTES);
    }
}
